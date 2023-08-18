<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestHelp extends Model
{
    use HasFactory;

    protected $dates = [
        'required_before'
    ];
}
