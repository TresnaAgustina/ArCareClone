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

    // format tanggal created_at menjadi d F Y
    public function getCreatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->translatedFormat('d F Y');
    }

    // get jenis kendala, 1: Perlengkapan kurang, 2: Perbaikan diluar Garansi, 3: Penggantian Sparepart
    public function getJenisKendalaAttribute($value)
    {
        switch ($value) {
            case 1:
                return 'Perlengkapan Kurang';
                break;
            case 2:
                return 'Perbaikan diluar Garansi';
                break;
            case 3:
                return 'Penggantian Sparepart';
                break;
            default:
                return 'Tidak Diketahui';
                break;
        }
    }
}
