<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Kendaraan
 *
 * @property int $id_kendaraan
 * @property string $plat_kendaraan
 * @property string|null $ruang_parkir
 * @property \Illuminate\Support\Carbon|null $waktu_masuk
 * @property \Illuminate\Support\Carbon|null $waktu_keluar
 * @property string $status
 * @property float $biaya
 * @method static \Illuminate\Database\Eloquent\Builder|Kendaraan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kendaraan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kendaraan query()
 * @method static \Illuminate\Database\Eloquent\Builder|Kendaraan whereBiaya($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kendaraan whereIdKendaraan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kendaraan wherePlatKendaraan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kendaraan whereRuangParkir($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kendaraan whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kendaraan whereWaktuKeluar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kendaraan whereWaktuMasuk($value)
 */
	class Kendaraan extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\RuangParkir
 *
 * @property int $id_ruang
 * @property string $nama_ruang
 * @property string $kode_ruang
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|RuangParkir newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RuangParkir newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RuangParkir query()
 * @method static \Illuminate\Database\Eloquent\Builder|RuangParkir whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RuangParkir whereIdRuang($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RuangParkir whereKodeRuang($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RuangParkir whereNamaRuang($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RuangParkir whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RuangParkir whereUpdatedAt($value)
 */
	class RuangParkir extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $password
 * @property string $role
 * @property string $no_telp
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereNoTelp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

