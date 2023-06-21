<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quarterly_Changes extends Model
{
    use HasFactory;
    public $timestamps= false;
    protected $table = 'Quarterly_Changes';
    protected $primaryKey = 'Id';
    protected $fillable = ['Category','Category_Number', 'Count','Status'];
}
