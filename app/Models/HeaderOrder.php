<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeaderOrder extends Model
{
    use HasFactory;

    static function create_header_order(){
      $data = Product::create([
        "tanggal_order" => date("Y-m-d"),
      ]);

      return $data-> id_header_order;
    }
}
