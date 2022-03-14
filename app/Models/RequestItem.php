<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestItem extends Model
{
    use HasFactory;

    public $fillable = ['user_id', 'admin_id', 'name', 'description', 'qty', 'feedback'];

    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    
}
