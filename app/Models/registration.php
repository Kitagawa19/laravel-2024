<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class registration extends Model
{
    //
    protected $table = 'registraions';
    protected $fillable = [
        'user_id',
        'course_id',
        'registration_at',
    ];
    protected function user(){
        return $this->belongsTo(Usrs::class);
    }
    public function course(){
        return $this->belongsTo(Course::class);
    }
}
