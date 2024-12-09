<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class subject_detail extends Model
{
    //
    protected $table = 'subject_detail';

    protected $fillable=[
        'credit',
        'date',
        'time',
    ];

    protected $casts = [
        'date'=> 'string'
    ];
    public function subjects(){
        return $this->hasMany(Subject::class,'detail_id');
    }
}
