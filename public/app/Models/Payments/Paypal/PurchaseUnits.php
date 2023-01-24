<?php

namespace App\Models\Payments\Paypal;

use JsonSerializable;

class PurchaseUnits implements JsonSerializable {
    protected $items = [];
    protected $amount = null;

    public function __construct()
    {
        $this->amount = new Amount();
    }

    public function getAmount() : Amount {
        return $this->amount;
    }

    public function addItem(Item $item) : self {
        $this->items[] = $item;
        dump('Item added');
        $value = $this->getAmount()->getValue();
        $value += $item->getQuantity() * $item->getUnit_amount()->getValue();
        $this->getAmount()->setValue($value);
        $this->getAmount()->setCurrency_code($item->getUnit_amount()->getCurrency_code());

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'items' => $this->items,
            'amount' => $this->amount,
        ];
    }
}
