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

    public function  getPhotoAttribute($val){
        return ($val !== null) ? asset('assets/images/hadithImages/' . $val) : "";
    }
    public function  getAudioAttribute($val){
        return ($val !== null) ? asset('assets/audios/hadithAudio/' . $val) : "";
    }
}
