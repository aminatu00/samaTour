<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    // On précise quels champs peuvent être remplis via create()
    protected $fillable = ['user_id', 'title', 'message'];
}
