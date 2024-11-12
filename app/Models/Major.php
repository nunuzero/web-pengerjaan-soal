<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Major extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'short_name',
    ];

    public function GroupClasses(): HasMany
    {
        return $this->hasMany(GroupClass::class);
    }
}
