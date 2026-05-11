<?php

namespace App\Models\Demo\Finance;

use Illuminate\Database\Eloquent\Model;

class FinanceExpense extends \Illuminate\Database\Eloquent\Model
{
    protected $fillable = ['demo_session_id','category','description','amount','expense_date','notes'];
}
