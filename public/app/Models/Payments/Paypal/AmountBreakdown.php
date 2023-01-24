<?php

namespace App\Models\Payments\Paypal;

use JsonSerializable;

class AmountBreakdown implements JsonSerializable {
    protected $item_total = null;

    public function __construct()
    {
        $this->item_total = new ItemTotal();
    }

    public function getItemTotal() : ItemTotal {
        return $this->item_total;
    }

    public function jsonSerialize(): array
    {
        return [
            'item_total' => $this->item_total,
        ];
    }
}
