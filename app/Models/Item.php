<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
  use HasFactory;

  protected $fillable = [
    'name',
    'description',
    'picture',
    'code',
    'lab_id',
  ];

  public function lab()
  {
    return $this->belongsTo(Lab::class);
  }

  public function loanItems()
  {
    return $this->hasMany(LoanItem::class);
  }
}
