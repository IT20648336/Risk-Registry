<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Risk_Category extends Model
{
    use HasFactory;

    protected $table = "Risk_Category";
    protected $primaryKey = 'Id';
    protected $fillable = ['Category','Sub_Category','Category_Id'];
    public $timestamps = false;
}
