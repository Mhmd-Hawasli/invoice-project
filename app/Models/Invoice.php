<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Section;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'invoice_number',
        'invoice_date',
        'due_date',
        'user_id',
        'section_id',
        'product_id',
        'collected_amount',
        'commission_amount',
        'discount',
        'rate_vat',
        'value_vat',
        'total',
        'note',
        'status',
        'attachment',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function section()
    {
        return $this->belongsTo(Section::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
