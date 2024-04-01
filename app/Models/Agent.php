<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Agent extends Authenticatable implements JWTSubject
{
    use HasFactory,SoftDeletes;

    protected $guard = "agent";

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
