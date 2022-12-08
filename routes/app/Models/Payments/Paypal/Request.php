<?php

namespace App\Models\Payments\Paypal;

use JsonSerializable;

class Request implements JsonSerializable {
    protected $data = [
        'intent' => 'CAPTURE',
        'purchase_units' => [],
        'application_context' => [
            'return_url' => '#',
            'cancel_url' => '#',
        ]
    ];
    protected $purchaseUnits = null;

    public function __construct()
    {
        $this->purchaseUnits = new PurchaseUnits();
    }

    public function jsonSerialize()
    {
        $this->data['purchase_units'][] = $this->purchaseUnits;

        return $this->data;
    }

    public function addItem(Item $item) : self {
        $this->purchaseUnits->addItem($item);

        return $this;
    }

    public function setReturnUrl(string $url) : self {
        $this->data['application_context']['return_url'] = $url;

        return $this;
    }

    public function setCancelUrl(string $url) : self {
        $this->data['application_context']['cancel_url'] = $url;

        return $this;
    }

    public function setIntent(string $intent = 'CAPTURE') : self {
        $this->data['intent'] = $intent;

        return $this;
    }
}
