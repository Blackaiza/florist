<?php

namespace Webkul\CustomStripePayment\Payment;

use Webkul\Payment\Payment\Payment;

class CustomStripePayment extends Payment
{
    /**
     * Payment method code
     *
     * @var string
     */
    protected $code  = 'customstripepayment';

    /**
     * Get redirect url.
     */
    public function getRedirectUrl()
    {
    }
}