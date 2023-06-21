<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email_Logs extends Model
{
    use HasFactory;
    
    protected $table = "Email_Logs";
    protected $primaryKey = 'Id';
    protected $fillable = ['Risk_Id','Sender_Name','Receiver_Name','Subject','Description'];
    public $timestamps = false;
}
