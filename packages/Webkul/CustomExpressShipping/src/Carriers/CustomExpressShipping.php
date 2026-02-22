<?php

namespace Webkul\CustomExpressShipping\Carriers;

use Webkul\Checkout\Facades\Cart;
use Webkul\Checkout\Models\CartShippingRate;
use Webkul\Shipping\Carriers\AbstractShipping;

class CustomExpressShipping extends AbstractShipping
{
    /**
     * Shipping method carrier code.
     */
    protected $code = 'customexpressshipping';

    /**
     * Shipping method code.
     */
    protected $method = 'customexpressshipping_customexpressshipping';

    /**
     * Calculate rate for shipping method.
     *
     * @return \Webkul\Checkout\Models\CartShippingRate|false
     */
    public function calculate()
    {
        if (! $this->isAvailable()) {
            return false;
        }

        $cart = Cart::getCart();

        $object = new CartShippingRate;

        $object->carrier = 'customexpressshipping';
        $object->carrier_title = $this->getConfigData('title');
        $object->method = 'customexpressshipping_customexpressshipping';
        $object->method_title = $this->getConfigData('title');
        $object->method_description = $this->getConfigData('description');
        $object->price = 0;
        $object->base_price = 0;

        // Add your shipping calculation logic here
        $price = $this->getConfigData('default_rate') ?? 0;
        
        $object->price = core()->convertPrice($price);
        $object->base_price = $price;

        return $object;
    }
}