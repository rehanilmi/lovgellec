<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\User;
class HeaderOrder extends Model
{
    use HasFactory;
    use Notifiable;
    protected $table = 'header_orders';

    public function user()
    {
       return $this->belongsTo(User::class);
    }
}
