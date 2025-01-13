<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\subject;
use Illuminate\Foundation\Auth\User;

class registration extends Model
{
    //
    protected $table = 'registrations';
    protected $fillable = [
        'user_id',
        'subject_id',
        'start_period',
        'end_period',
        'created_at',
        'updated_at',
    ];
    protected function user(){
        return $this->belongsTo(User::class);
    }
    public function subject(){
        return $this->belongsTo(subject::class);
    }
}
