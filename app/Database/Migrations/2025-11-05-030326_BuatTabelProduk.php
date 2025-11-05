<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BuatTabelProduk extends Migration
{
    /**
     * Ini adalah fungsi 'up()'. 
     * Fungsi ini akan dijalankan ketika kita menjalankan 'php spark migrate'.
     * Fungsi ini bertugas MEMBUAT tabel.
     */
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11, // constraint 11 (cukup untuk ID)
                'unsigned'       => true, // unsigned (tidak boleh negatif)
                'auto_increment' => true,
            ],
            'nama_produk' => [
                'type'       => 'VARCHAR',
                'constraint' => '100', // Batas 100 karakter
                'null'       => false, // 'null' => false (wajib diisi)
            ],
            'deskripsi' => [
                'type' => 'TEXT',
                'null' => true, // 'null' => true (boleh kosong)
            ],
            'harga' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true, // Harga tidak boleh negatif
                'null'       => false,
            ],
            'stok' => [
                'type'       => 'INT',
                'constraint' => 5,
                'unsigned'   => true, // Stok tidak boleh negatif
                'null'       => false,
            ],
            'created_at' => [ // Wajib ada untuk Model CI4 (useTimestamps)
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [ // Wajib ada untuk Model CI4 (useTimestamps)
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        // Menentukan 'id' sebagai Primary Key
        $this->forge->addKey('id', true);

        // Membuat tabel 'produk'
        $this->forge->createTable('produk');
    }

    /**
     * Ini adalah fungsi 'down()'.
     * Fungsi ini akan dijalankan jika kita perlu 'membatalkan' migrasi.
     * Fungsi ini bertugas MENGHAPUS tabel.
     */
    public function down()
    {
        $this->forge->dropTable('produk');
    }
}