<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Jurisdictionals extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'business_id',   
        'jurisdictional_office_code',
        'jurisdictional_office_name',
        'abbreviation',
        'prefecture_city',
        'postal_code',
        'address',
        'phone',
        'fax',
        'special_notes',
        'bill_to',
        'administrative_costs_invoice',
        'term_end_temporary_assistance',
        'first_decimal_place',
        'second_decimal_place',
        'one_yen_adjustment',
        'date_print_on_invoice',
        
    ];
}
