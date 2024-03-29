<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agent extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable=[
      'full_name',
      'country_code',
      'phone',
      'email',
      'password',
      'status',
      'image',
    ];
}
