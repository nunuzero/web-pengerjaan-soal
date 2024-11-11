<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupClass extends Model
{
    protected $fillable = [
        'name',
        'subject_id',
        'major_id',
    ];
}
