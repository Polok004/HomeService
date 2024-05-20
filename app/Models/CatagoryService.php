<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatagoryService extends Model
{
    use HasFactory;
    protected $table="service_catagories";
    public function services(){
        return $this->hasMany(Service::class);
    }
}
