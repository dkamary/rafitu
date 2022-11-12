<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicule extends Model
{
    protected $table = 'vehicle';
    protected $primaryKey = 'id';
    protected $fillable = ['owner_id', 'registration', 'country_id', 'vehicle_brand_id', 'vehicle_model_id', 'allow_animal', 'allow_smoker', 'seats_available', 'is_active'];
    public $timestamps = false;

    protected $country = null;
    protected $owner = null;
    protected $brand = null;
    protected $model = null;

    public function getName() : string {
        $brand = $this->getBrand();
        $model = $this->getModel();

        $name = ($brand ? $brand->name .' - ' : '') . ($model ? $model->label : '');

        return $name;
    }

    public function getOwner() : ?User {
        if($this->owner) return $this->owner;

        $this->owner = User::where('id', '=', (int)$this->owner_id)->first();

        return $this->owner;
    }

    public function getCountry() : ?Country {
        if($this->country) return $this->country;

        $this->country = Country::where('id', '=', (int)$this->country_id)->first();

        return $this->country;
    }

    public function getBrand() : ?VehiculeBrand {
        if($this->brand) return $this->brand;

        $this->brand = VehiculeBrand::where('id', '=', (int)$this->vehicle_brand_id)->first();

        return $this->brand;
    }

    public function getModel() : ?VehiculeModel {
        if($this->model) return $this->model;

        $this->model = VehiculeModel::where('id', '=', (int)$this->vehicle_model_id)->first();

        return $this->model;
    }
}
