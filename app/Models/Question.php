<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'explanation',
        'answers',
    ];

    protected $casts = [
        'answers' => 'json'
    ];

    public function packages(): BelongsToMany
    {
        return $this->belongsToMany(Package::class, 'package_questions')->withTimestamps();
    }
}
