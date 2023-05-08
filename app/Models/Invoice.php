<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'invoice_number',
        'invoice_date',
        'due_date',
        'product',
        'section',
        'discount',
        'rate_vat',
        'section_id',
        'amount_collection',
        'amount_commission',
        'value_vate',
        'total',
        'status',
        'value_status',
        'note',
        'user',
    ];
    //aac
  
    
    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}
