<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parameter extends Model
{
    const COMMISSION_LONG_TRAJET = 'Long Trajet';
    const COMMISSION_TRAJET_QUOTIDIEN = 'Trajet Quotidien';

    protected $table = 'parameters';
    protected $primaryKey = 'id';
    protected $fillable = [
        'com_longtrajet', 'com_quotidien', 'dist_longtrajet', 'heure_execution',
        'paypal_mode', 'paypal_account', 'paypal_client_id', 'paypal_secret', 'paypal_bn_code', 'paypal_plateform_partner_app', 'paypal_entry_live', 'paypal_entry_sandbox',
        'cinetpay_mode', 'cinetpay_api', 'cinetpay_site_id', 'cinetpay_secret', 'cinetpay_currency', 'cinetpay_lang', 'cinetpay_entry_live',
    ];
    public $timestamps = false;

    public function getCommissionLongTrajet() : float {
        return (float)$this->com_longtrajet;
    }

    public function getCommissionQuotidien() : float {
        return (float)$this->com_quotidien;
    }

    public function getDistanceLongTrajet() : float {
        return (float)$this->dist_longtrajet;
    }
}
