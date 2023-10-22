<?php

namespace Modules\Cart\Entities;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;

class CartItem implements Arrayable, Jsonable
{
    /**
     * The ID of the cart item.
     *
     * @var int
     */
    public $id;

    /**
     * The quantity for this cart item.
     *
     * @var int
     */
    public $qty;

    /**
     * The name of the cart item.
     *
     * @var string
     */
    public $name;

    /**
     * The price without TAX of the cart item.
     *
     * @var float
     */
    public $price;

    /**
     * The tax rate for the cart item.
     *
     * @var float
     */
    public $taxRate = 0;

    /**
     * The options for this cart item.
     *
     * @var array
     */
    public $options;

    /**
     * CartItem constructor.
     *
     * @param  int  $id
     * @param  string  $name
     * @param  float  $price
     * @param  float  $taxRate
     */
    public function __construct($id, $name, $price, $taxRate, array $options = [])
    {
        if (empty($id)) {
            throw new \InvalidArgumentException('Please supply a valid identifier.');
        }
        if (empty($name)) {
            throw new \InvalidArgumentException('Please supply a valid name.');
        }
        if (strlen($price) < 0 || ! is_numeric($price)) {
            throw new \InvalidArgumentException('Please supply a valid price.');
        }
        if (strlen($taxRate) < 0 || ! is_numeric($taxRate)) {
            throw new \InvalidArgumentException('Please supply a valid taxRate.');
        }
        $this->id = $id;
        $this->name = $name;
        $this->price = floatval($price);
        $this->taxRate = floatval($taxRate);
        $this->options = new CartItemOptions($options);
    }

    /**
     * Returns the formatted price without TAX.
     *
     * @param  int  $decimals
     * @param  string  $decimalSeparator
     * @param  string  $thousandSeperator
     * @return string
     */
    public function price($decimals = null, $decimalSeparator = null, $thousandSeperator = null)
    {
        return CartHelper::numberFormat($this->price, $decimals, $decimalSeparator, $thousandSeperator);
    }

    /**
     * Returns the formatted price with TAX.
     *
     * @param  int  $decimals
     * @param  string  $decimalSeparator
     * @param  string  $thousandSeperator
     * @return string
     */
    public function priceTax($decimals = null, $decimalSeparator = null, $thousandSeperator = null)
    {
        return CartHelper::numberFormat($this->priceTax, $decimals, $decimalSeparator, $thousandSeperator);
    }

    /**
     * Returns the formatted subtotal.
     * Subtotal is price for whole CartItem without TAX
     *
     * @param  int  $decimals
     * @param  string  $decimalSeparator
     * @param  string  $thousandSeperator
     * @return string
     */
    public function subtotal($decimals = null, $decimalSeparator = null, $thousandSeperator = null)
    {
        return CartHelper::numberFormat($this->subtotal, $decimals, $decimalSeparator, $thousandSeperator);
    }

    /**
     * Returns the formatted total.
     * Total is price for whole CartItem with TAX
     *
     * @param  int  $decimals
     * @param  string  $decimalSeparator
     * @param  string  $thousandSeperator
     * @return string
     */
    public function total($decimals = null, $decimalSeparator = null, $thousandSeperator = null)
    {
        return CartHelper::numberFormat($this->total, $decimals, $decimalSeparator, $thousandSeperator);
    }

    /**
     * Returns the formatted tax.
     *
     * @param  int  $decimals
     * @param  string  $decimalSeparator
     * @param  string  $thousandSeperator
     * @return string
     */
    public function tax($decimals = null, $decimalSeparator = null, $thousandSeperator = null)
    {
        return CartHelper::numberFormat($this->tax, $decimals, $decimalSeparator, $thousandSeperator);
    }

    /**
     * Returns the formatted tax.
     *
     * @param  int  $decimals
     * @param  string  $decimalSeparator
     * @param  string  $thousandSeperator
     * @return string
     */
    public function taxTotal($decimals = null, $decimalSeparator = null, $thousandSeperator = null)
    {
        return CartHelper::numberFormat($this->taxTotal, $decimals, $decimalSeparator, $thousandSeperator);
    }

    /**
     * Set the quantity for this cart item.
     *
     * @param  int  $qty
     */
    public function setQuantity($qty)
    {
        if (empty($qty) || ! is_int($qty)) {
            throw new \InvalidArgumentException('Please supply a valid quantity.');
        }
        $this->qty = $qty;
    }

    /**
     * Update the cart item from an array.
     *
     * @return void
     */
    public function updateFromArray(array $attributes)
    {
        $this->id = array_get($attributes, 'id', $this->id);
        $this->qty = array_get($attributes, 'qty', $this->qty);
        $this->name = array_get($attributes, 'name', $this->name);
        $this->price = array_get($attributes, 'price', $this->price);
        $this->taxRate = array_get($attributes, 'taxRate', $this->taxRate);
        $this->options = new CartItemOptions(array_get($attributes, 'options', $this->options));
    }

    /**
     * Get an attribute from the cart item or get the associated model.
     *
     * @param  string  $attribute
     * @return mixed
     */
    public function __get($attribute)
    {
        if (property_exists($this, $attribute)) {
            return $this->{$attribute};
        }

        switch ($attribute) {
            case 'priceTax':
                return $this->price + $this->tax;

            case 'subtotal':
                return $this->qty * $this->price;

            case 'total':
                return $this->qty * $this->priceTax;

            case 'tax':
                return $this->price * ($this->taxRate / 100);

            case 'taxTotal':
                return $this->qty * $this->tax;

            default:
                return null;
        }
    }

    /**
     * Create a new instance from the given array.
     *
     * @return Modules\Cart\Entities\CartItem
     */
    public static function fromArray(array $attributes)
    {
        $options = array_get($attributes, 'options', []);

        return new self($attributes['id'], $attributes['name'], $attributes['price'], $attributes['taxRate'], $options);
    }

    /**
     * Create a new instance from the given attributes.
     *
     * @param  int|string  $id
     * @param  string  $name
     * @param  float  $price
     * @param  float  $taxRate
     * @return Modules\Cart\Entities\CartItem
     */
    public static function fromAttributes($id, $name, $price, $taxRate, array $options = [])
    {
        return new self($id, $name, $price, $taxRate, $options);
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'qty' => $this->qty,
            'price' => $this->price,
            'priceTax' => $this->priceTax,
            'tax' => $this->tax,
            'taxRate' => $this->taxRate,
            'taxTotal' => $this->taxTotal,
            'subtotal' => $this->subtotal,
            'total' => $this->total,
            'options' => $this->options->toArray(),
        ];
    }

    /**
     * Convert the object to its JSON representation.
     *
     * @param  int  $options
     * @return string
     */
    public function toJson($options = 0)
    {
        return json_encode($this->toArray(), $options);
    }
}
