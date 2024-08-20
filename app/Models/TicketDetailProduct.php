<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketDetailProduct extends Model
{
    use HasFactory;

    protected $table = 'ticket_detail_products';
    protected $primaryKey = 'id';
    protected $autoIncrement = true;
    public $timestamps = true;

    protected $fillable = [
        'id_lokasi',
        'merk_produk',
        'permasalahan',
    ];

    // many to one relationship with TicketDetailLocation
    public function detail_location()
    {
        return $this->belongsTo(TicketDetailLocation::class, 'id_lokasi', 'id');
    }
}
