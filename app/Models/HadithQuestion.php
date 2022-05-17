<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HadithQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'choiceA',
        'choiceB',
        'choiceC',
        'correct',
        'hadith_id',
    ];

    public function hadith()
    {
        return $this->belongsTo(Hadith::class, 'hadith_id');
    }
}
