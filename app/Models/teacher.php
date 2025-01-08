<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class teacher extends Model
{
    //
    protected $connection = 'subjects';
    protected $table = 'teachers';

    protected $fillable =[
        'name',
    ];

    public function subjects(){
        return $this->hasMany(hasMany(Subject::class));    
    }
}
