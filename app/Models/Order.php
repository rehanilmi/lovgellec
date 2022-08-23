<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\User;
use App\Models\Product;

class Order extends Model
{
    use HasFactory;
    use Notifiable;


  public function user()
  {
     return $this->belongsTo(User::class);
  }
}
