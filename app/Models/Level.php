<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'grade',
        'cluster_id',
    ];



    public function cluster()
    {
        return $this->belongsTo(Cluster::class,'cluster_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class,'level_user');
    }
}
