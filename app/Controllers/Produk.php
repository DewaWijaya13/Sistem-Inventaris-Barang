<?php

namespace App\Controllers;

/**
 * Ini adalah Web Controller kita.
 * Tugasnya HANYA untuk memuat dan menampilkan file View (HTML).
 * Dia tidak menangani logika API.
 */
class Produk extends BaseController
{
    /**
     * Fungsi ini akan dipanggil saat seseorang
     * mengakses URL /produk
     */
    public function index()
    {
        // Kita hanya perlu me-return sebuah view.
        // Logika untuk mengambil data (fetch) akan kita
        // lakukan di sisi frontend (JavaScript).
        return view('produk/index');
    }
}