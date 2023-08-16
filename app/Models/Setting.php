<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'currency',
        'phone',
        'email',
        'tax_number',
        'website_logo',
        'epilogue_logo',
        'tab_logo',
        'qr_code',
        'invoice_stamp'
    ];
}
