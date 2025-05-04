<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use App\Models\RuangParkir;
use App\Http\Controllers\Admin\RuangParkirController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Database\Seeders\UserSeeder;
use Tests\TestCase;
use Livewire;

class RuangParkirTest extends TestCase
{
    use RefreshDatabase;

    private $admin;

    protected function setUp(): void 
    {
        parent::setUp();
        $this->seed(UserSeeder::class);
        $this->admin = User::where('role', 'Admin')->first();

        if (!$this->admin) {
            $this->fail('Admin user tidak ditemukan di database.');
        }
    }

    /**
     * Test Case 01 - Melihat Daftar Ruang Parkir yang Tersedia
     * 
     * Precondition:
     * 1. Login sebagai Admin
     * 2. Terdapat beberapa data ruang parkir di database
     */
    public function test_01_LihatDaftarRuangParkir_Tersedia_Berhasil()
    {
        // Arrange
        // Buat sample data ruang parkir untuk ditampilkan
        RuangParkir::StoreRuang('Lantai 1', 'A', 3);
        RuangParkir::StoreRuang('Lantai 2', 'B', 2);

        // Act
        // Login dan akses halaman ruang parkir
        $this->actingAs($this->admin);
        $res = Livewire::test(RuangParkirController::class)
                ->assertViewIs('admin.ruang-parkir');

        // Assert
        // Cek response dan tampilan tabel dengan format range kode yang sesuai
        $res->assertStatus(200)
            ->assertSet('ruang_parkir', RuangParkir::GetRuang())
            ->assertSee('Ruang Parkir')
            ->assertSee('Lantai 1')
            ->assertSee('A1 - A3')
            ->assertSee('3')
            ->assertSee('Lantai 2')
            ->assertSee('B1 - B2')
            ->assertSee('2');
    }

    /**
     * Test Case 02 - Tambah Ruang Parkir dengan Data Valid
     * 
     * Precondition:
     * 1. Login sebagai Admin
     * 2. Tidak ada ruang parkir dengan nama "Lantai 1" dan kode "A1", "A2", "A3" di dalam database
     */
    public function test_02_TambahRuangParkir_DataValid_Berhasil()
    {
        // Arrange - Tidak perlu setup karena mengharapkan database kosong

        // Act
        // Submit form dengan data ruang parkir valid
        $this->actingAs($this->admin);   
        $res = Livewire::test(RuangParkirController::class)
                    ->set('nama_ruang', 'Lantai 1')
                    ->set('kode_ruang', 'A')
                    ->set('kapasitas', 3)
                    ->call('store'); 

        // Assert
        // Cek notifikasi sukses dan data tersimpan di database
        $res->assertStatus(200)
            ->assertDispatchedBrowserEvent('notify', 
            [
                'type' => 'success',
                'message' => 'Ruang Berhasil Ditambahkan',
            ]);
        
        $this->assertDatabaseCount('ruang_parkir', 3);
        $this->assertDatabaseHas('ruang_parkir', 
        [
            'nama_ruang' => 'Lantai 1',
            'kode_ruang' => 'A3',
            'status' => 'kosong'
        ]);
    }

    /**
     * Test Case 03 - Tambah Ruang Parkir dengan Data Kosong
     * 
     * Precondition:
     * 1. Login sebagai Admin
     */
    public function test_03_TambahRuangParkir_DataKosong_Gagal()
    {
        // Act 
        // Submit form dengan data kosong
        $this->actingAs($this->admin);
        $res = Livewire::test(RuangParkirController::class)
                ->set('nama_ruang', '')
                ->set('kode_ruang', '')
                ->set('kapasitas', '')
                ->call('store');

        // Assert
        // Cek pesan error validasi required
        $res->assertStatus(200)
            ->assertHasErrors([
                'nama_ruang' => ['required'],
                'kode_ruang' => ['required'], 
                'kapasitas' => ['required']
            ]);
    }

    /**
     * Test Case 04 - Tambah Ruang Parkir dengan Data Duplikat
     * 
     * Precondition:
     * 1. Login sebagai Admin
     * 2. Terdapat ruang parkir dengan nama "Lantai 1" dan kode "A1", "A2", "A3" di dalam database
     */
    public function test_04_TambahRuangParkir_DataDuplikat_Gagal()
    {
        // Arrange
        // Buat data ruang parkir awal yang akan diduplikat
        RuangParkir::StoreRuang('Lantai 1', 'A', 3);

        // Act
        // Submit form dengan data yang sudah ada
        $this->actingAs($this->admin);
        $res = Livewire::test(RuangParkirController::class)
                ->set('nama_ruang', 'Lantai 1')
                ->set('kode_ruang', 'A')
                ->set('kapasitas', 3)
                ->call('store');

        // Assert
        // Cek error unique validation
        $res->assertStatus(200)
            ->assertHasErrors(['nama_ruang' => 'unique']);
    }

    /**
     * Test Case 05 - Edit Ruang Parkir Ubah Nama dan Kode dengan Data Valid
     * 
     * Precondition:
     * 1. Login sebagai Admin
     * 2. Terdapat ruang parkir yang akan di-edit dengan nama "Lantai 1" dan kode "A1", "A2", "A3" di dalam database
     * 3. Data baru ruang parkir yang akan diinputkan Tidak Konflik dengan data yang sudah ada di database
     */
    public function test_05_EditRuangParkir_UbahNamaDanKode_DataValid_Berhasil()
    {
        // Arrange
        // Buat data ruang parkir yang akan diedit
        RuangParkir::StoreRuang('Lantai 1', 'A', 3);

        // Act
        // Submit form edit dengan data baru
        $this->actingAs($this->admin);
        $res = Livewire::test(RuangParkirController::class)
                ->set('target_ruang', 'Lantai 1')
                ->set('nama_ruang', 'Lantai 2')
                ->set('kode_ruang', 'B')
                ->set('kapasitas', 3)
                ->call('update');

        // Assert
        // Cek notifikasi sukses dan perubahan data di database
        $res->assertStatus(200)
            ->assertDispatchedBrowserEvent('notify', [
                'type' => 'success',
                'message' => 'Ruang Berhasil Diperbarui',
            ]);

        $this->assertDatabaseCount('ruang_parkir', 3);
        $this->assertDatabaseHas('ruang_parkir', [
            'nama_ruang' => 'Lantai 2',
            'kode_ruang' => 'B3'
        ]);
        $this->assertDatabaseMissing('ruang_parkir', [
            'nama_ruang' => 'Lantai 1',
            'kode_ruang' => 'A3'
        ]);
    }

    /**
     * Test Case 06 - Edit Ruang Parkir Ubah Nama dan Kode dengan Data Tidak Valid
     * 
     * Precondition:
     * 1. Login sebagai Admin
     * 2. Terdapat ruang parkir yang akan di-edit dengan nama "Lantai 1" dan kode "A1", "A2", "A3" di dalam database
     * 3. Terdapat ruang parkir lainnya dengan nama "Lantai 2" atau kode "B1", "B2", "B3" di dalam database
     */
    public function test_06_EditRuangParkir_UbahNamaDanKode_DataTidakValid_Gagal()
    {
        // Arrange
        // Buat dua data ruang parkir untuk pengujian konflik data
        RuangParkir::StoreRuang('Lantai 1', 'A', 3);
        RuangParkir::StoreRuang('Lantai 2', 'B', 3);

        // Act
        // Submit form edit dengan data yang konflik
        $this->actingAs($this->admin);
        $res = Livewire::test(RuangParkirController::class)
                ->set('target_ruang', 'Lantai 1')
                ->set('nama_ruang', 'Lantai 2') // Duplikat nama
                ->set('kode_ruang', 'B') // Duplikat kode
                ->set('kapasitas', 3)
                ->call('update');

        // Assert
        // Cek error validasi unique
        $res->assertStatus(200)
            ->assertHasErrors(['nama_ruang' => 'unique']);
    }

    /**
     * Test Case 07 - Edit Ruang Parkir Ubah Nama, Kode dan Tambah Kapasitas
     * 
     * Precondition:
     * 1. Login sebagai Admin
     * 2. Terdapat ruang parkir yang akan di-edit dengan nama "Lantai 1" dan kode "A1", "A2", "A3" di dalam database
     * 3. Data baru ruang parkir yang akan diinputkan Tidak Konflik dengan data yang sudah ada di database
     */
    public function test_07_EditRuangParkir_UbahNamaKodeDanTambahKapasitas_Berhasil()
    {
        // Arrange
        // Buat data ruang parkir awal untuk diedit
        RuangParkir::StoreRuang('Lantai 1', 'A', 3);

        // Act
        // Submit form edit dengan penambahan kapasitas
        $this->actingAs($this->admin);
        $res = Livewire::test(RuangParkirController::class)
                ->set('target_ruang', 'Lantai 1')
                ->set('nama_ruang', 'Lantai 2') 
                ->set('kode_ruang', 'B') 
                ->set('kapasitas', 6)
                ->call('update');

        // Assert
        // Cek notifikasi sukses dan penambahan record di database
        $res->assertStatus(200)
            ->assertDispatchedBrowserEvent('notify', [
                'type' => 'success',
                'message' => 'Ruang Berhasil Diperbarui',
            ]);
        
        $this->assertDatabaseCount('ruang_parkir', 6);
        $this->assertDatabaseHas('ruang_parkir', [
            'nama_ruang' => 'Lantai 2',
            'kode_ruang' => 'B6'
        ]);
    }

    /**
     * Test Case 08 - Edit Ruang Parkir Ubah Nama, Kode dan Kurangi Kapasitas
     * 
     * Precondition:
     * 1. Login sebagai Admin
     * 2. Terdapat ruang parkir yang akan di-edit dengan nama "Lantai 1" dan kode "A1", "A2", "A3" di dalam database
     * 3. Data baru ruang parkir yang akan diinputkan Tidak Konflik dengan data yang sudah ada di database
     */
    public function test_08_EditRuangParkir_UbahNamaKodeDanKurangiKapasitas_Berhasil()
    {
        // Arrange
        // Buat data ruang parkir awal untuk diedit
        RuangParkir::StoreRuang('Lantai 1', 'A', 3);

        // Act
        // Submit form edit dengan pengurangan kapasitas
        $this->actingAs($this->admin);
        $res = Livewire::test(RuangParkirController::class)
                ->set('target_ruang', 'Lantai 1')
                ->set('nama_ruang', 'Lantai 2') 
                ->set('kode_ruang', 'B') 
                ->set('kapasitas', 1)
                ->call('update');

        // Assert
        // Cek notifikasi sukses dan pengurangan record di database
        $res->assertStatus(200)
            ->assertDispatchedBrowserEvent('notify', [
                'type' => 'success',
                'message' => 'Ruang Berhasil Diperbarui',
            ]);
        
        $this->assertDatabaseCount('ruang_parkir', 1);
        $this->assertDatabaseHas('ruang_parkir', [
            'nama_ruang' => 'Lantai 2',
            'kode_ruang' => 'B1'
        ]);
    }

    /**
     * Test Case 09 - Edit Ruang Parkir dengan Kapasitas Negatif
     * 
     * Precondition:
     * 1. Login sebagai Admin
     * 2. Terdapat ruang parkir yang akan di-edit dengan nama "Lantai 1" dan kode "A1", "A2", "A3" di dalam database
     */
    public function test_09_EditRuangParkir_KapasitasNegatif_Gagal()
    {
        // Arrange
        // Buat data ruang parkir awal untuk diedit
        RuangParkir::StoreRuang('Lantai 1', 'A', 3);

        // Act
        // Submit form edit dengan kapasitas negatif
        $this->actingAs($this->admin);
        $res = Livewire::test(RuangParkirController::class)
                ->set('target_ruang', 'Lantai 1')
                ->set('nama_ruang', 'Lantai 2') 
                ->set('kode_ruang', 'B') 
                ->set('kapasitas', -8)
                ->call('update');

        // Assert
        // Cek error validasi kapasitas harus lebih dari 0
        $res->assertStatus(200)
            ->assertHasErrors(['kapasitas' => 'gt']);
    }

    /**
     * Test Case 10 - Hapus Ruang Parkir yang Terdaftar
     * 
     * Precondition:
     * 1. Login sebagai Admin
     * 2. Terdapat ruang parkir yang akan di-hapus dengan nama "Lantai 1" dan kode "A1", "A2", "A3" di dalam database
     */
    public function test_10_HapusRuangParkir_Terdaftar_Berhasil() 
    {
        // Arrange
        // Buat data ruang parkir untuk dihapus
        RuangParkir::StoreRuang('Lantai 1', 'A', 3);

        // Act
        // Submit form hapus ruang parkir
        $this->actingAs($this->admin);
        $res = Livewire::test(RuangParkirController::class)
                ->set('nama_ruang', 'Lantai 1')
                ->call('delete');

        // Assert
        // Cek notifikasi sukses dan data terhapus dari database
        $res->assertStatus(200)
            ->assertDispatchedBrowserEvent('notify', [
                'type' => 'success',
                'message' => 'Ruang Berhasil Dihapus',
            ]);
        
        $this->assertDatabaseCount('ruang_parkir', 0);
        $this->assertDatabaseMissing('ruang_parkir', [
            'nama_ruang' => 'Lantai 1',
            'kode_ruang' => 'A3'
        ]);
    }
}
