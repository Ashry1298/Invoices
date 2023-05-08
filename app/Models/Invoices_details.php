<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoices_details extends Model
{
    use HasFactory;
    protected $fillable = [
        'invoice_number',
        'product',
        'section',
        'invoice_id',
        'status',
        'payment_date',
        'note',
        'user',
    ];
}
