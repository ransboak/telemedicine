<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'field'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function appointments(){
        return $this->hasMany(Appointment::class, 'doctor_id');
    }


}
