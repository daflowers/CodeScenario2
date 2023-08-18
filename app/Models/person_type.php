<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class person_type extends Model
{
    use HasFactory;

    protected $fillable = [
        'foreign_id',
        'person_type',
    ];
}
