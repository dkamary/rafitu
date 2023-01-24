<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleGallery extends Model
{
    protected $table = 'vehicle_gallery';
    protected $primaryKey = 'id';
    protected $fillable = ['vehicle_id', 'image_uri', 'title', 'description', 'alternate_text', 'rank', ];
    public $timestamps = false;

    protected $vehicle;

    public function getVehicle() : ?Vehicule {
        return $this->vehicle ?: $this->vehicle = Vehicule::where('id', '=', (int)$this->vehicle_id)->first();
    }
}
