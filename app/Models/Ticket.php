<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $table = 'tickets';
    protected $primaryKey = 'id';
    protected $autoIncrement = true;
    public $timestamps = true;

    protected $fillable = [
        'kode_tiket',
        'id_pelanggan',
        'nama_pelanggan',
        'tanggal_dibuat',
        'tanggal_perbaikan',
        'tanggal_selesai',
        'nama_pic_fakultas',
        'telepon_pic_fakultas',
        'nama_pic_ruangan',
        'telepon_pic_ruangan',
        'keterangan',
        'status',
        'kategori',
    ];

    // many to one relationship with User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_pelanggan', 'id');
    }

    // one to many relationship with TicketDetailLocation
    public function detail_tickets()
    {
        return $this->hasMany(TicketDetailLocation::class, 'id_tiket', 'id');
    }

    // one to many relationship with TicketLog
    public function logs()
    {
        return $this->hasMany(TicketLog::class, 'id_tiket', 'id');
    }

    // one to one relationship with Assigment
    public function assigment()
    {
        return $this->hasOne(Assigment::class, 'id_tiket', 'id');
    }
}
