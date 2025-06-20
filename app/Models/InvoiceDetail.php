<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceDetail  extends Model
{
    protected $fillable = [
        'invoice_id',
        'user_id',
        'note',
        'status',
    ];
}
