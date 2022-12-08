<?php

namespace App\Models\Payments\Paypal;

use JsonSerializable;

class Amount implements JsonSerializable
{
    protected $currency_code = 'USD';
    protected $value = .0;
    protected $breakdown = null;

    public function __construct()
    {
        $this->breakdown = new AmountBreakdown();
    }

    public function getBreakdown(): AmountBreakdown
    {
        return $this->breakdown;
    }

    public function jsonSerialize(): array
    {
        return [
            'currency_code' => $this->currency_code,
            'value' => number_format($this->value, 2, '.', ''),
            'breakdown' => $this->breakdown,
        ];
    }

    public function getCurrency_code(): string
    {
        return $this->currency_code;
    }

    public function setCurrency_code($currency_code): self
    {
        $this->currency_code = $currency_code;
        $this->breakdown
            ->getItemTotal()
            ->setCurrency($currency_code);

        return $this;
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function setValue($value): self
    {
        $this->value = $value;
        $this->breakdown
            ->getItemTotal()
            ->setValue($value);

        return $this;
    }
}
