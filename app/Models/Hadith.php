<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hadith extends Model
{
    use HasFactory;


    protected $fillable = [
        'sanad',
        'matn',
        'description',
        'source',
        'degree',
        'cluster_id',
    ];


    public function hadithQuestion()
    {
        return $this->hasOne(HadithQuestion::class, 'hadith_id');
    }

    public function cluster()
    {
        return $this->belongsTo(Cluster::class,'cluster_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_hadith');
    }

    public function users()
    {
        return $this->belongsToMany(User::class,'hadith_user')->withPivot('isFavorite');
    }
}
