<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Payment extends Model
{
    protected $fillable = [
        'user_id', 'amount','titulaire_nom','titulaire_prenom', 'card_number', 'expiration_date', 'cvv', 'transaction_id'
    ];

    // Relation avec l'utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function setCardNumberAttribute($value)
{
    $this->attributes['card_number'] = Crypt::encryptString($value);
}

public function getCardNumberAttribute($value)
{
    return Crypt::decryptString($value);
}
}

