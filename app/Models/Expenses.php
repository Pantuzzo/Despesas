<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    public $timestamps = false;
    protected $fillable = ['description', 'user_name', 'transaction_at', 'value'];
}
