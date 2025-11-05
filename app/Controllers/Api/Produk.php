<?php

namespace App\Controllers\Api;


use CodeIgniter\RESTful\ResourceController;

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



        $data = $this->request->getJSON(true);


        if ($this->model->insert($data)) {

            $response = [
                'status' => 201,
                'message' => 'Produk berhasil ditambahkan.'
            ];
            return $this->respondCreated($response);
        } 
        

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

        if (!$this->model->find($id)) {
            return $this->failNotFound('Data produk tidak ditemukan.');
        }


        $data = $this->request->getJSON(true);


        if ($this->model->update($id, $data)) {

            $response = [
                'status' => 200,
                'message' => 'Produk berhasil diperbarui.'
            ];
            return $this->respond($response);
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

        if (!$this->model->find($id)) {
            return $this->failNotFound('Data produk tidak ditemukan.');
        }


        if ($this->model->delete($id)) {

            $response = [
                'status' => 200,
                'message' => 'Produk berhasil dihapus.'
            ];
            return $this->respondDeleted($response);
        } 
        
        return $this->fail('Gagal menghapus produk.');
    }
}