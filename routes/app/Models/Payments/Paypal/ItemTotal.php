<?php

namespace App\Models\Payments\Paypal;

use JsonSerializable;

class ItemTotal implements JsonSerializable {
    protected $currency_code = 'USD';
    protected $value = .0;

    public function jsonSerialize()
    {
        return [
            'currency_code' => $this->currency_code,
            'value' => number_format($this->value, 2, '.', ''),
        ];
    }

    public function setCurrency(string $currency = 'USD') : self {
        $this->currency_code = $currency;

        return $this;
    }

    public function getCurrency() : string {
        return $this->currency_code;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setValue(float $value) : self
    {
        $this->value = $value;

        return $this;
    }
}
