<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class teacher extends Model
{
    //
    protected $table = 'teachers';

    protected $fillable =[
        'name',
    ];

    public function subjects(){
        return $this->hasMany(hasMany(subject::class));    
    }
}
