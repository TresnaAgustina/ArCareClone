<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assigment extends Model
{
    use HasFactory;

    protected $table = 'assigments';
    protected $primaryKey = 'id';
    protected $autoIncrement = true;
    public $timestamps = true;

    protected $fillable = [
        'id_tiket',
        'id_teknisi',
        'nama_teknisi',
        'tanggal_perbaikan',
        'tanggal_selesai',
        'status',
    ];

    // one to one relationship with Ticket
    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'id_tiket', 'id');
    }

    // many to one relationship with User
    public function teknisi()
    {
        return $this->belongsTo(User::class, 'id_teknisi', 'id');
    }
}
