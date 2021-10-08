<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Secret extends Model
{
    public $timestamps = false;
    protected $table = 'secret';

    protected $fillable = [
        'hash', 'secretText', 'createdAt', 'expiresAt', 'remainigViews'
    ];
}
