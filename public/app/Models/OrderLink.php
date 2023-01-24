<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderLink extends Model {
    protected $table = 'order_link';
    protected $primaryKey = 'id';
    protected $fillable = ['order_id', 'rel', 'href',];
    public $timestamps = false;

    protected $order;

    public function getOrder() : ?Order {
        return ($this->order) ?: $this->order = Order::where('id', '=', (int)$this->order_id)->first();
    }
}
