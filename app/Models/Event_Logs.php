<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event_Logs extends Model
{
    use HasFactory;
    protected $table = "Event_Logs";
    public $timestamps = false;
}
