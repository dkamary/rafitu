<?php

namespace App\Models\Payments\Paypal;

use JsonSerializable;

class UnitAmount implements JsonSerializable {
    protected $currency_code = 'USD';
    protected $value = .0;

    public function __construct(float $value = .0, string $currencyCode = 'USD')
    {
        $this->currency_code = $currencyCode;
        $this->value = $value;
    }

    public function jsonSerialize(): array
    {
        return [
            'currensy_code' => $this->currency_code,
            'value' => number_format($this->value, 2, '.', ''),
        ];
    }

    public function getCurrency_code() : string
    {
        return $this->currency_code;
    }

    public function setCurrency_code($currency_code) : self
    {
        $this->currency_code = $currency_code;

        return $this;
    }

    public function getValue() : float
    {
        return $this->value;
    }

    public function setValue($value) : self
    {
        $this->value = $value;

        return $this;
    }
}
