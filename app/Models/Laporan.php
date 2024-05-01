<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $table = 'laporan';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'tgl_laporan',
        'jumlah_kendaraan',
        'pendapatan_rp',
    ];

    /**
    * The attributes that should be cast to native types.
    *
    * @var array
    */
    protected $casts = [
        'tgl_laporan' => 'datetime',
    ];

    public static function GenerateReport()
    {
        $jumlah_kendaraan = Kendaraan::where('status', 'Finished')
                                    ->whereDate('waktu_keluar', Carbon::today())
                                    ->count();
                                    
        $jumlah_biaya_rp = Kendaraan::where('status', 'Finished')
                                    ->whereDate('waktu_keluar', Carbon::today())
                                    ->sum('biaya');

        self::create([
            'tgl_laporan' => Carbon::now(),
            'jumlah_kendaraan' => $jumlah_kendaraan,
            'pendapatan_rp' => $jumlah_biaya_rp,
        ]);
    }
}
