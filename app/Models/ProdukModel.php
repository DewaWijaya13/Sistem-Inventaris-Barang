<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukModel extends Model
{
    /**
     * $table memberitahu Model ini tabel mana yang harus digunakan.
     */
    protected $table = 'produk';

    /**
     * $primaryKey memberitahu Model apa nama kolom Primary Key kita.
     * Ini penting untuk fungsi find($id), update($id), delete($id).
     */
    protected $primaryKey = 'id';

    /**
     * $allowedFields adalah DAFTAR WAJIB.
     * Ini adalah "daftar putih" kolom mana saja yang BOLEH diisi
     * atau di-update melalui metode insert() dan update().
     * Ini adalah fitur keamanan CI4 untuk mencegah "Mass Assignment".
     */
    protected $allowedFields = [
        'nama_produk',
        'deskripsi',
        'harga',
        'stok'
    ];

    /**
     * $useTimestamps = true
     * Ini memberitahu CI4 untuk secara otomatis mengisi kolom
     * 'created_at' dan 'updated_at' setiap kali ada data baru (insert)
     * atau data yang di-update (update).
     */
    protected $useTimestamps = true;
}