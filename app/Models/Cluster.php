<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cluster extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function hadiths()
    {
        return $this->hasMany(Hadith::class, 'cluster_id');
    }

    public function levels()
    {
        return $this->hasMany(Level::class, 'cluster_id');
    }
}