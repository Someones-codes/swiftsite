<?php

// app/Models/Demo/Finance/FinanceIncome.php
namespace App\Models\Demo\Finance;

use Illuminate\Database\Eloquent\Model;

class FinanceIncome extends Model
{
    protected $fillable = ['demo_session_id', 'source', 'amount', 'received_date', 'notes'];
}
