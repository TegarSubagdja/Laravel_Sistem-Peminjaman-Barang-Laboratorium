<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
  use HasFactory, Notifiable;

  protected $fillable = [
    'name',
    'email',
    'nrp',
    'password',
    'role',
  ];

  protected $hidden = [
    'password',
    'remember_token',
  ];

  public function loans()
  {
    return $this->hasMany(Loan::class);
  }

  public function isAdmin()
  {
    return $this->role === 'admin'; // Asumsikan ada atribut 'role' pada tabel user
  }
}
