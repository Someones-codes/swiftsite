<?php

namespace App\Models\Demo\Water;

class WaterCustomer extends \Illuminate\Database\Eloquent\Model
{
    protected $fillable = ['demo_session_id','name','phone','area','drums_ordered','price_per_drum','is_active'];
 
    public function payments()
    {
        return $this->hasMany(WaterPayment::class);
    }
}
