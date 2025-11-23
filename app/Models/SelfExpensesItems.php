<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Fujimien;
use App\Models\SelfExpenses;

class SelfExpensesItems extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'm_fujimien_user_id',
        'm_fujimien_user_self_expense_id',
        'type',
        'self_expenses_name',
        'start_date',
        'end_date',
        'yearly_amount',
        'two_months_amount',
        'one_month_amount',
        'pension_number',
        'payment_method',
        'special_notes',
        'created_at',
        ];

    public function fujimien()
    {
        return $this->belongsTo(Fujimien::class);
    }

    public function selfExpenses()
    {
        return $this->belongsTo(SelfExpenses::class);
    }
}
