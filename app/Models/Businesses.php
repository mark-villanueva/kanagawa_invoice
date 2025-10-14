<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;


class Businesses extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'facility',
        'corporate',
        'phone',
        'fax',
        'representative',
        'postal_code',
        'address',
        'special_notes',
        'financial_institution',
        'branch_name',
        'deposit_type',
        'account_number',
        'payee_name',
        'payee_name_kana',
        'registration_category',
        'code_type',
        'number_code',
        'registration_number',
    ];
}
