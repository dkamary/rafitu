<?php

namespace App\Models\Payments\Paypal;

use JsonSerializable;

class Item implements JsonSerializable {
    protected $name;
    protected $description;
    protected $quantity;
    protected $unit_amount = null;

    public function __construct(UnitAmount $unitAmount = null)
    {
        $this->unit_amount = $unitAmount ?: new UnitAmount();
    }

    public function jsonSerialize(): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'quantity' => $this->quantity,
            'unit_amount' => $this->unit_amount,
        ];
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function setName(string $name) : self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription() : string
    {
        return $this->description;
    }

    public function setDescription(string $description) : self
    {
        $this->description = $description;

        return $this;
    }

    public function getQuantity() : int
    {
        return (int)$this->quantity;
    }

    public function setQuantity(int $quantity) : self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getUnit_amount() : UnitAmount
    {
        return $this->unit_amount;
    }

    public function setUnit_amount(UnitAmount $unitAmount) : self {
        $this->unit_amount = $unitAmount;

        return $this;
    }
}
