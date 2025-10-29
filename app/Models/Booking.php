<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_transaksi',
        'user_id',
        'dukun_id',
        'tanggal_mulai_sewa',
        'tanggal_selesai_sewa',
        'tanggal_pengajuan_pengembalian',
        'tanggal_pengembalian',
        'total_harga',
        'denda',
        'status',
    ];

    protected $casts = [
        'tanggal_mulai_sewa' => 'date',
        'tanggal_selesai_sewa' => 'date',
        'tanggal_pengajuan_pengembalian' => 'datetime',
        'tanggal_pengembalian' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function dukun(): BelongsTo
    {
        return $this->belongsTo(Dukun::class);
    }
}