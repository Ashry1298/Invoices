<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Section extends Model
{
    use HasFactory;

    protected $fillable = [
        'section_name',
        'description',
        'created_by'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}