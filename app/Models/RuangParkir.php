<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Mavinoo\Batch\Traits\HasBatch;

class RuangParkir extends Model
{
    use HasFactory, HasBatch;

    protected $table = 'ruang_parkir';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_ruang',
        'kode_ruang',
        'status',
    ];

    public static function GetRuang()
    {
        // Get Unique nama_ruang Value and count
        $ruangan = self::all()->unique('nama_ruang');
        $jumlah = self::get()->countBy('nama_ruang');
        $ruang_parkir = [];
        
        foreach ($ruangan as $value) 
        {
            $ruang_parkir[] = [
                'nama_ruang' => $value['nama_ruang'],
                'kode_ruang' => $value['kode_ruang'][0],
                'kapasitas' => $jumlah[$value['nama_ruang']],
                'updated_at' => $value['updated_at'],
            ];
        }
        return collect($ruang_parkir)->sortBy('nama_ruang')->values()->all();
    }

    public static function StoreRuang($nama, $kode, $kapasitas) 
    {
        // Make Multiple Record of Ruang
        for ($i = 0; $i < $kapasitas; $i++) {
            $ruangParkir[] = [
                'nama_ruang' => $nama,
                'kode_ruang' => $kode . ($i + 1),
                'status' => 'kosong',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Check if validated
        $validatorFails = Validator::make($ruangParkir, [
            '*.nama_ruang' => 'required|unique:ruang_parkir,nama_ruang',
            '*.kode_ruang' => 'required|unique:ruang_parkir,kode_ruang',
        ])->fails();

        // Insert Ruang Parkir array to database
        if (!$validatorFails) 
            self::insert($ruangParkir);;

        return $validatorFails;
    }

    public static function UpdateRuang($target_ruang, $nama, $kode, $kapasitas)
    {
        $count = self::where('nama_ruang', $target_ruang)->count();

        // Make Multiple Record of Ruang
        $ruangParkir = array();
        for ($i = 0; $i < $kapasitas; $i++) {
            $ruangParkir[] = [
                'nama_ruang' => $nama,
                'kode_ruang' => $kode . ($i + 1),
                'updated_at' => now(),
            ];
        }

        // Check if validated
        $validatorFails = Validator::make($ruangParkir, [
            '*.nama_ruang' => ['required', Rule::unique('ruang_parkir', 'nama_ruang')->ignore($target_ruang, 'nama_ruang')],
            '*.kode_ruang' => ['required', Rule::unique('ruang_parkir', 'kode_ruang')->ignore($target_ruang, 'nama_ruang')],
        ])->fails();

        // Exeucte if validation pass
        if (!$validatorFails) 
        {
            if ($kapasitas > $count ) 
            {
                // Add Some Record   
                for ($i = $count; $i < $kapasitas; $i++) {
                    $ruangTambah[] = [
                        'nama_ruang' => $target_ruang,
                        'kode_ruang' => $i + 1,
                        'status' => 'kosong',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
                self::insert($ruangTambah);
            } 
            else if ($kapasitas < $count) 
            {
                // Delete Some Record
                self::where('nama_ruang', $target_ruang)->limit($count - $kapasitas)->delete();
            }
    
            $ruang_id = self::where('nama_ruang', $target_ruang)->pluck('id_ruang')->toArray();
            $ruang_parkir = array();

            // Make Final Array with ruang_id
            foreach ($ruangParkir as $key => $ruang) {
                $ruang_parkir[] = [
                    'id_ruang' => $ruang_id[$key],
                    'nama_ruang' => $ruang['nama_ruang'],
                    'kode_ruang' => $ruang['kode_ruang'],
                    'updated_at' => $ruang['updated_at'],
                ];
            }

            // Update Ruang Database
            self::batchUpdate($ruang_parkir, 'id_ruang');   
        }
        return $validatorFails;
    }

    public static function DeleteRuang($nama_ruang)
    {
        self::where('nama_ruang', $nama_ruang)->delete();
    }
}
