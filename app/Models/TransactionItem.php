<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionItem extends Model
{
    use HasFactory;

    public $fillable = ['transaction_id', 'item_id', 'qty'];

    public function item(){
        return $this->hasOne(Item::class, 'id', 'item_id');
    }

    public function transaction(){
        return $this->hasOne(Transaction::class, 'id', 'transaction_id');
    }
}
