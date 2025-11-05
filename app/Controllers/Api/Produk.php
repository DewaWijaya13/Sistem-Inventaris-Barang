<?php

namespace App\Controllers\Api;

// Kita menggunakan ResourceController
use CodeIgniter\RESTful\ResourceController;
// TAMBAHKAN BARIS INI untuk mengenali kelas IncomingRequest
use CodeIgniter\HTTP\IncomingRequest;

/**
 * Ini adalah Controller API kita untuk resource 'Produk'.
 * Dia akan menangani semua logika CRUD.
 */
class Produk extends ResourceController
{
    /**
     * TAMBAHKAN DUA BARIS DI BAWAH INI
     * Ini akan "memberi tahu" editor Anda bahwa $this->request
     * adalah object dari kelas IncomingRequest, sehingga error 'getJSON' hilang.
     * @var IncomingRequest
     */
    protected $request;

    /**
     * $modelName akan memberitahu CI4 untuk secara otomatis
     * memuat (load) Model yang kita tentukan ('ProdukModel')
     * dan menyiapkannya di $this->model.
     */
    protected $modelName = 'App\Models\ProdukModel';

    /**
     * $format akan memberitahu CI4 bahwa respon default dari
     * controller ini adalah JSON.
     */
    protected $format    = 'json';

    /**
     * Fungsi index()
     * Metode HTTP: GET
     * URL: /api/produk
     * Tugas: Mengambil SEMUA data produk.
     */
    public function index()
    {
        // Menggunakan Model untuk mengambil semua data
        return $this->respond($this->model->findAll());
    }

    /**
     * Fungsi show()
     * Metode HTTP: GET
     * URL: /api/produk/[id] (Contoh: /api/produk/5)
     * Tugas: Mengambil SATU data produk berdasarkan ID.
     */
    public function show($id = null)
    {
        $data = $this->model->find($id);
        if ($data) {
            return $this->respond($data);
        }
        
        // Kirim respon 404 Not Found jika data tidak ada
        return $this->failNotFound('Data produk tidak ditemukan.');
    }

    /**
     * Fungsi create()
     * Metode HTTP: POST
     * URL: /api/produk
     * Tugas: Membuat SATU data produk baru.
     */
    public function create()
    {
        // Mengambil data JSON yang dikirim di body request
        // 'true' berarti kita konversi jadi array, bukan object
        // Error di editor Anda SEHARUSNYA SUDAH HILANG
        $data = $this->request->getJSON(true);

        // Coba insert data menggunakan Model
        if ($this->model->insert($data)) {
            // Buat respon sukses (HTTP 201 Created)
            $response = [
                'status' => 201,
                'message' => 'Produk berhasil ditambahkan.'
            ];
            return $this->respondCreated($response);
        } 
        
        // Jika gagal (misal: validasi error), kirim error
        return $this->fail($this->model->errors());
    }

    /**
     * Fungsi update()
     * Metode HTTP: PUT (atau PATCH)
     * URL: /api/produk/[id] (Contoh: /api/produk/5)
     * Tugas: Mengupdate SATU data produk yang ada.
     */
    public function update($id = null)
    {
        // Cek dulu apakah produknya ada
        if (!$this->model->find($id)) {
            return $this->failNotFound('Data produk tidak ditemukan.');
        }

        // Error di editor Anda SEHARUSNYA SUDAH HILANG
        $data = $this->request->getJSON(true);

        // Coba update data
        if ($this->model->update($id, $data)) {
            // Buat respon sukses
            $response = [
                'status' => 200,
                'message' => 'Produk berhasil diperbarui.'
            ];
            return $this->respond($response); // respond() defaultnya 200 OK
        } 
        
        return $this->fail($this->model->errors());
    }

    /**
     * Fungsi delete()
     * Metode HTTP: DELETE
     * URL: /api/produk/[id] (Contoh: /api/produk/5)
     * Tugas: Menghapus SATU data produk.
     */
    public function delete($id = null)
    {
        // Cek dulu apakah produknya ada
        if (!$this->model->find($id)) {
            return $this->failNotFound('Data produk tidak ditemukan.');
        }

        // Coba hapus data
        if ($this->model->delete($id)) {
            // Buat respon sukses
            $response = [
                'status' => 200,
                'message' => 'Produk berhasil dihapus.'
            ];
            return $this->respondDeleted($response); // respondDeleted() juga 200 OK
        } 
        
        return $this->fail('Gagal menghapus produk.');
    }
}