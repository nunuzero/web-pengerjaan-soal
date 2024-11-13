<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'started_at',
        'ended_at',
        'group_class_id',
    ];

    public function questions(): BelongsToMany
    {
        return $this->belongsToMany(Question::class, 'package_questions')->withTimestamps();
    }

    public function groupClass(): BelongsTo
    {
        return $this->belongsTo(GroupClass::class);
    }

    public function countQuestions()
    {
        return $this->questions()->count();
    }
}
