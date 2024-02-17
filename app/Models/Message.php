<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $fillable = [
   'fname',
   'lname',
   'email',
   'message',
    'unread_count',
  
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
