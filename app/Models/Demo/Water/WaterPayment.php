<?php

namespace App\Models\Demo\Water;

use Illuminate\Database\Eloquent\Model;

class WaterPayment extends \Illuminate\Database\Eloquent\Model{
    protected $fillable = ['demo_session_id','water_customer_id','amount_paid','payment_date','status','notes'];
 
    public function customer()
    {
        return $this->belongsTo(WaterCustomer::class, 'water_customer_id');
    }

}