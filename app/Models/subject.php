<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class subject extends Model
{
    //
    protected $table ='subjects';

    protected $fillable = [
        'teacher_id',
        'name',
        'detail_id',
    ];

    public function teacher(){
        return $this->belongsTo(Teacher::class);
    }

    public function detail(){
        return $this->belongsTo(SubjectDetail::class,'detail_id');
    }
}
