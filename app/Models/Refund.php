<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    protected $fillable = [
        'payment_id', 'amount',
    ];

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
