<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Activity_Logs extends Model
{
    use HasFactory;
    protected $table = "Activity_Logs";
    public $timestamps = false;
}
