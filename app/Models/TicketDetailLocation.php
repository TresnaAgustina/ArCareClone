<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketDetailLocation extends Model
{
    use HasFactory;

    protected $table = 'ticket_detail_locations';
    protected $primaryKey = 'id';
    protected $autoIncrement = true;
    public $timestamps = true;

    protected $fillable = [
        'id_tiket',
        'lokasi',
        'alamat',
    ];

    // many to one relationship with Ticket
    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'id_tiket', 'id');
    }

    // one to many relationship with TicketDetailProduct
    public function detail_products()
    {
        return $this->hasMany(TicketDetailProduct::class, 'id_lokasi', 'id');
    }
}
