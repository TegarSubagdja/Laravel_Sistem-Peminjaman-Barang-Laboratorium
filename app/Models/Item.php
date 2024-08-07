<?php

namespace App\Models;

use App\Models\Lab;
use App\Models\LoanItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Scout\Searchable;

class Item extends Model
{
  use HasFactory;
  use Searchable;

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
    return $this->hasMany(LoanItem::class, 'item_id', 'code');
  }

  public function toSearchableArray()
  {
    return [
      'name' => $this->name,
      'description' => $this->description,
      'code' => $this->code,
    ];
  }
}
