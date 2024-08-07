<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
  use HasFactory;

  protected $fillable = [
    'user_id',
    'item_id',
    'loan_date',
    'return_date',
    'status',
  ];

  public function isWaiting()
  {
    return $this->status === 'waiting';
  }

  public function isApprove()
  {
    return $this->status === 'approved';
  }

  public function isRejected()
  {
    return $this->status === 'rejected';
  }

  public function isCancelled()
  {
    return $this->status === 'cancelled';
  }

  public function user()
  {
    return $this->belongsTo(User::class, 'user_id', 'nrp');
  }

  public function item()
  {
    return $this->belongsTo(Item::class, 'item_id', 'code');
  }

  public function loanItems()
  {
    return $this->hasMany(LoanItem::class);
  }
}
