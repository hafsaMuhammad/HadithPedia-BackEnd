<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildHadith extends Model
{
    use HasFactory;
    protected $fillable = [
        'matn',
        'description',
        'image',
        'iamgePath',
        'audio',
        'audioPath',
    ];
}
