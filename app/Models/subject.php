<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\teacher;
use App\Models\subject_detail;

class subject extends Model
{
    //
    protected $connection = 'subjects';
    protected $table ='subject';

    protected $fillable = [
        'teacher_id',
        'name',
        'detail_id',
    ];

    public function teacher(){
        return $this->belongsTo(teacher::class);
    }

    public function detail(){
        return $this->belongsTo(subject_detail::class,'detail_id');
    }
}
