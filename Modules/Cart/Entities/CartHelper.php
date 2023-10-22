<?php

namespace Modules\Cart\Entities;

class CartHelper
{
    /**
     * Get the formatted number.
     *
     * @param  float  $value
     * @param  int  $decimals
     * @param  string  $decimalSeparator
     * @param  string  $thousandSeperator
     * @return string
     */
    public static function numberFormat($value, $decimals = null, $decimalSeparator = null, $thousandSeperator = null)
    {
        if (is_null($decimals)) {
            $decimals = ! is_null(config('cart.format.decimals')) ? config('cart.format.decimals') : 2;
        }
        if (is_null($decimalSeparator)) {
            $decimalSeparator = ! is_null(config('cart.format.decimal_separator')) ? config('cart.format.decimal_separator') : '.';
        }
        if (is_null($thousandSeperator)) {
            $thousandSeperator = ! is_null(config('cart.format.thousand_seperator')) ? config('cart.format.thousand_seperator') : ',';
        }

        return number_format($value, $decimals, $decimalSeparator, $thousandSeperator);
    }
}
