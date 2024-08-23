<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketLog extends Model
{
    use HasFactory;

    protected $table = 'ticket_logs';
    protected $prmaryKey = 'id';
    protected $autoincrement = true;
    public $timestamps = true;

    protected $fillable = [
        'id_tiket',
        'dibuat_oleh',
        'konteks',
        'status',
        'tanggal_jadwal',
        'deskripsi',
        'jenis_kendala',
        'aksi_diambil',
        'is_public',
    ];

    // Many to One Ticket
    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'id_tiket', 'id');
    }
}
