<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cars extends Model
{
    use HasFactory;

    protected $table = "cars";
    protected $fillable = [
        'title',
        'color',
        'm_date',
        'price',
        'transmission',
        'image'
    ];


    public function get_engine()
    {
        return $this->hasOne(Engine::class,'car_id');
    }

    public function models()
    {
        return $this->hasMany(CarModel::class, 'car_id');
    }
}
