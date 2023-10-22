<?php

namespace Modules\Cart\Entities;

use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Collection;

class Cart extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'orders';

    const DEFAULT_INSTANCE = 'default';

    /**
     * Instance of the session manager.
     *
     * @var \Illuminate\Session\SessionManager
     */
    private $session;

    /**
     * Instance of the event dispatcher.
     *
     * @var \Illuminate\Contracts\Events\Dispatcher
     */
    private $events;

    /**
     * Holds the current cart instance.
     *
     * @var string
     */
    private $instance;

    /**
     * Cart constructor.
     */
    public function __construct(SessionManager $session, Dispatcher $events)
    {
        $this->session = $session;
        $this->events = $events;

        $this->instance(self::DEFAULT_INSTANCE);
    }

    /**
     * Set the current cart instance.
     *
     * @param  string|null  $instance
     * @return Modules\Cart\Entities\Cart
     */
    public function instance($instance = null)
    {
        $instance = $instance ?: self::DEFAULT_INSTANCE;
        $this->instance = sprintf('%s.%s', 'cart', $instance);

        return $this;
    }

    /**
     * Get the current cart instance.
     *
     * @return string
     */
    public function currentInstance()
    {
        return str_replace('cart.', '', $this->instance);
    }

    /**
     * Add an item to the cart.
     *
     * @param  int  $id
     * @param  string  $name
     * @param  int  $qty
     * @param  float  $price
     * @return Modules\Cart\Entities\CartItem
     */
    public function addItem($id, $name, $qty, $price, $taxRate, array $options = [])
    {
        $cartItem = $this->createCartItem($id, $name, $qty, $price, $taxRate, $options);

        $content = $this->getContent();

        if ($content->has($cartItem->id)) {
            $cartItem->qty += $content->get($cartItem->id)->qty;
        }
        $content->put($cartItem->id, $cartItem);

        $this->events->fire('cart.added', $cartItem);
        $this->session->put($this->instance.'.items', $content);

        return $cartItem;
    }

    /**
     * Create a new CartItem from the supplied attributes.
     *
     * @param  int  $id
     * @param  string  $name
     * @param  int  $qty
     * @param  float  $price
     * @param  float  $taxRate
     * @return Modules\Cart\Entities\CartItem
     */
    private function createCartItem($id, $name, $qty, $price, $taxRate, array $options)
    {
        $cartItem = CartItem::fromAttributes($id, $name, $price, $taxRate, $options);
        $cartItem->setQuantity($qty);

        return $cartItem;
    }

    /**
     * Update the cart item with the given id.
     *
     * @param  int  $id
     * @param  int  $qty
     * @return Modules\Cart\Entities\CartItem
     */
    public function updateItem($id, $qty)
    {
        $cartItem = $this->getItem($id);
        $cartItem->qty = $qty;

        $content = $this->getContent();

        if ($cartItem->qty <= 0) {
            $this->removeItem($cartItem->id);

            return;
        } else {
            $content->put($cartItem->id, $cartItem);
        }

        $this->events->fire('cart.updated', $cartItem);
        $this->session->put($this->instance.'.items', $content);

        return $cartItem;
    }

    /**
     * Remove the cart item with the given id from the cart.
     *
     * @param  string  $id
     * @return void
     */
    public function removeItem($id)
    {
        $cartItem = $this->getItem($id);

        $content = $this->getContent();
        $content->pull($cartItem->id);

        $this->events->fire('cart.removed', $cartItem);
        $this->session->put($this->instanc.'.items', $content);
    }

    /**
     * Get a cart item from the cart by its id.
     *
     * @param  string  $id
     * @return Modules\Cart\Entities\CartItem
     *
     * @throws InvalidArgumentException if the cart does not contain id
     */
    public function getItem($id)
    {
        $content = $this->getContent();

        if (! $content->has($id)) {
            throw new \InvalidArgumentException("The cart does not contain id {$id}.");
        }

        return $content->get($id);
    }

    /**
     * Get the number of items in the cart.
     *
     * @return int
     */
    public function count()
    {
        $content = $this->getContent();

        return $content->sum('qty');
    }

    /**
     * Get the total price of the items in the cart.
     *
     * @param  int  $decimals
     * @param  string  $decimalPoint
     * @param  string  $thousandSeperator
     * @return string
     */
    public function total($decimals = null, $decimalPoint = null, $thousandSeperator = null)
    {
        $content = $this->getContent();

        $total = $content->reduce(function ($total, CartItem $cartItem) {
            return $total + ($cartItem->qty * $cartItem->priceTax);
        }, 0);

        return CartHelper::numberFormat($total, $decimals, $decimalPoint, $thousandSeperator);
    }

    /**
     * Get the subtotal (total - tax) of the items in the cart.
     *
     * @param  int  $decimals
     * @param  string  $decimalPoint
     * @param  string  $thousandSeperator
     * @return float
     */
    public function subtotal($decimals = null, $decimalPoint = null, $thousandSeperator = null)
    {
        $content = $this->getContent();

        $subTotal = $content->reduce(function ($subTotal, CartItem $cartItem) {
            return $subTotal + ($cartItem->qty * $cartItem->price);
        }, 0);

        return CartHelper::numberFormat($subTotal, $decimals, $decimalPoint, $thousandSeperator);
    }

    /**
     * Get the total tax of the items in the cart.
     *
     * @param  int  $decimals
     * @param  string  $decimalPoint
     * @param  string  $thousandSeperator
     * @return float
     */
    public function tax($decimals = null, $decimalPoint = null, $thousandSeperator = null)
    {
        $content = $this->getContent();

        $tax = $content->reduce(function ($tax, CartItem $cartItem) {
            return $tax + ($cartItem->qty * $cartItem->tax);
        }, 0);

        return CartHelper::numberFormat($tax, $decimals, $decimalPoint, $thousandSeperator);
    }

    /**
     * Get the carts content, if there is no cart content set yet, return a new empty Collection
     *
     * @return \Illuminate\Support\Collection
     */
    protected function getContent()
    {
        $content = $this->session->has($this->instance.'.items')
            ? $this->session->get($this->instance.'.items')
            : new Collection();

        return $content;
    }

    /**
     * Magic method to make accessing the total, tax and subtotal properties possible.
     *
     * @param  string  $attribute
     * @return float|null
     */
    public function __get($attribute)
    {
        switch ($attribute) {
            case 'total':
                return $this->total();

            case 'subtotal':
                return $this->subtotal();

            case 'tax':
                return $this->tax();

            default:
                return null;
        }
    }

    /**
     * Get the carts billing.
     *
     * @return array
     */
    public function getBilling()
    {
        $billing = $this->session->has($this->instance.'.billing')
            ? $this->session->get($this->instance.'.billing')
            : [];

        return $billing;
    }

    /**
     * Set the carts billing.
     *
     * @return void
     */
    public function setBilling($billing)
    {
        $this->session->put($this->instance.'.billing', $billing);
    }

    /**
     * Get the carts delivery.
     *
     * @return array
     */
    public function getDelivery()
    {
        $delivery = $this->session->has($this->instance.'.delivery')
            ? $this->session->get($this->instance.'.delivery')
            : [];

        return $delivery;
    }

    /**
     * Set the carts delivery.
     *
     * @return void
     */
    public function setDelivery($delivery)
    {
        $this->session->put($this->instance.'.delivery', $delivery);
    }

    /**
     * Get the carts shipping.
     *
     * @return array
     */
    public function getShipping()
    {
        $shipping = $this->session->has($this->instance.'.shipping')
            ? $this->session->get($this->instance.'.shipping')
            : [];

        return $shipping;
    }

    /**
     * Set the carts shipping.
     *
     * @return void
     */
    public function setShipping($shipping)
    {
        $this->session->put($this->instance.'.shipping', $shipping);
    }

    /**
     * Destroy the current cart instance.
     *
     * @return void
     */
    public function delete()
    {
        $this->session->remove($this->instance.'.items');
        $this->session->remove($this->instance.'.billing');
        $this->session->remove($this->instance.'.delivery');
        $this->session->remove($this->instance.'.shipping');
    }
}
