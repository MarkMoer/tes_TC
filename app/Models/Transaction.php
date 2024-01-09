<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TransactionDetail;

class Transaction extends Model
{
    use HasFactory;
    public function details()
    {
        return $this->hasMany(TransactionDetail::class);
    }
}
