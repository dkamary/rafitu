<?php

namespace App\Models\Payments\Paypal;

use stdClass;

class CreateOrderResponse {
    protected $id;
    protected $intent;
    protected $status;
    protected $purchase_units = [];
    protected $create_time;
    protected $links = [];

    public function __construct($data = null)
    {
        if(is_null($data)) return;
        if(is_object($data) && $data instanceof stdClass) $data = (array)$data;
        if(!is_array($data)) return;

        $this->id = $data['id'] ?? null;
        $this->intent = $data['intent'] ?? null;
        $this->status = $data['status'] ?? null;
        $this->purchase_units = $data['purchase_units'] ?? [];
        $this->create_time = $data['create_time'] ?? null;
        $this->links = $data['links'] ?? [];
    }

    public function getId() : ?string {
        return $this->id;
    }

    public function getIntent() : ?string {
        return $this->intent;
    }

    public function getStatus() : ?string {
        return $this->status;
    }

    public function getPurchaseUnis() : array {
        return $this->purchase_units;
    }

    public function getCreateTime() : ?string {
        return $this->create_time;
    }

    public function getLinks() : array {
        return $this->links;
    }

    public function getApprovalLink() : ?stdClass {

        return $this->getLink('approve');
    }

    public function getCaptureLink() : ?stdClass {

        return $this->getLink('capture');
    }

    public function getLink(string $rel) : ?stdClass {
        $link=  null;

        foreach($this->links as $lnk) {
            if($lnk->rel == $rel) {
                $link = $lnk;
                break;
            }
        }

        return $link;
    }
}
