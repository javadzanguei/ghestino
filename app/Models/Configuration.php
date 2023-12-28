<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    use HasFactory;

    protected $primaryKey = 'parameter';

    protected $fillable = [
        'parameter', 'value', 'label'
    ];
}
