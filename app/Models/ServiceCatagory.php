<?php
// app/Models/ServiceCategory.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; // Import HasFactory

class ServiceCategory extends Model
{
    use HasFactory; // Add use HasFactory statement

    protected $table = "service_catagories";

    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
