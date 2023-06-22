<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;
    protected $table = 'pemesanans';
    protected $guarded = [];

    public function kamars()
    {
        return $this->belongsTo(Kamar::class, 'kamar_id', 'id');
    }

    public function customers()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }


}
