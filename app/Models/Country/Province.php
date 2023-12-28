<?php

namespace App\Models\Country;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    public function counties(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(County::class);
    }

}
