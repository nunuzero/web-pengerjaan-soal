<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'started_at',
        'ended_at',
    ];

    public function questions(): BelongsToMany
    {
        return $this->belongsToMany(Question::class, 'package_questions')->withTimestamps();
    }
}
