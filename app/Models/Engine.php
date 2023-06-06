<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Engine extends Model
{
    use HasFactory;
    protected $table = "engines";
    protected $fillable = [
        'car_id',
        'engine_no',
    ];


    public function get_car()
    {
        return $this->belongsTo(Cars::class, 'car_id');
    }
}
