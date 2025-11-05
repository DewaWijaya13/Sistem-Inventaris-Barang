<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Master Data Barang</h1>
        <button id="btn-tambah" class="btn btn-primary shadow-sm">
            <i class="bi bi-plus-lg me-1"></i> Tambah Produk Baru
        </button>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Produk</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="tabel-produk" width="100%" cellspacing="0">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Nama Produk</th>
                                    <th>Deskripsi</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div> <div class="modal fade" id="modalProduk" tabindex="-1" aria-labelledby="modalProdukLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modalProdukLabel">Formulir Produk</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <form id="form-produk">
        <div class="modal-body">
            
            <input type="hidden" id="id_produk">

            <div class="mb-3">
                <label for="nama_produk" class="form-label">Nama Produk</label>
                <input type="text" class="form-control" id="nama_produk" required>
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" class="form-control" id="harga" min="0" required>
            </div>
            <div class="mb-3">
                <label for="stok" class="form-label">Stok</label>
                <input type="number" class="form-control" id="stok" min="0" required>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
      
    </div>
  </div>
</div>

<?= $this->endSection() ?>


<?= $this->section('scripts') ?>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        

        const tabelBody = document.querySelector("#tabel-produk tbody");
        const btnTambah = document.querySelector("#btn-tambah");
        const modalElement = document.querySelector("#modalProduk");
        const modalProduk = new bootstrap.Modal(modalElement);
        const formProduk = document.querySelector("#form-produk");
        const apiUrl = '<?= base_url('api/produk/') ?>';

        

        const notif = (status, pesan) => {
            Swal.fire({
                icon: status,
                title: pesan,
                showConfirmButton: false,
                timer: 1500
            });
        }
        

        /**
         * 1. READ: Memuat data
         */
        async function loadDataProduk() {
            try {
                const response = await fetch(apiUrl);
                if (!response.ok) throw new Error('Gagal mengambil data dari API');
                
                const dataProduk = await response.json();
                tabelBody.innerHTML = '';
                let nomor = 1;

                if (dataProduk.length === 0) {
                     tabelBody.innerHTML = '<tr><td colspan="6" class="text-center">Belum ada data produk.</td></tr>';
                     return;
                }

                dataProduk.forEach(produk => {
                    const row = `
                        <tr>
                            <td>${nomor++}</td>
                            <td>${produk.nama_produk}</td>
                            <td>${produk.deskripsi}</td>
                            <td>${produk.harga}</td>
                            <td>${produk.stok}</td>
                            <td>
                                <button class="btn btn-sm btn-warning" onclick="editProduk(${produk.id})">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </button>
                                <button class="btn btn-sm btn-danger" onclick="hapusProduk(${produk.id})">
                                    <i class="bi bi-trash3-fill"></i> Hapus
                                </button>
                            </td>
                        </tr>
                    `;
                    tabelBody.innerHTML += row;
                });

            } catch (error) {
                console.error("Error memuat data:", error);
                tabelBody.innerHTML = '<tr><td colspan="6" class="text-center">Gagal memuat data.</td></tr>';
            }
        }
        
        /**
         * 2. CREATE (Handler): Menampilkan modal
         */
        btnTambah.addEventListener("click", function() {
            formProduk.reset(); 
            document.querySelector("#id_produk").value = ''; 
            modalProduk.show(); 
        });

        /**
         * 3. CREATE / UPDATE (Handler): Mengirim data form (POST atau PUT)
         */
        formProduk.addEventListener("submit", async function(e) {
            e.preventDefault(); 

            const id = document.querySelector("#id_produk").value;
            const data = {
                nama_produk: document.querySelector("#nama_produk").value,
                deskripsi: document.querySelector("#deskripsi").value,
                harga: document.querySelector("#harga").value,
                stok: document.querySelector("#stok").value,
            };

            let url = apiUrl;
            let method = 'POST';
            let pesanSukses = 'Data produk berhasil ditambahkan!';
            
            if (id) {
                url = `${apiUrl}${id}`;
                method = 'PUT';
                pesanSukses = 'Data produk berhasil diperbarui!';
            }

            try {
                const response = await fetch(url, {
                    method: method,
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(data)
                });

                if (!response.ok) {
                    const errorData = await response.json();
                    throw new Error(errorData.message || 'Gagal menyimpan data');
                }

                modalProduk.hide();
                loadDataProduk();



                notif('success', pesanSukses);
                
            } catch (error) {
                console.error("Error saat menyimpan data:", error);



                notif('error', error.message);
            }
        });

        /**
         * 4. UPDATE (Fungsi): Mengambil data & menampilkan di form untuk edit
         */
        window.editProduk = async function(id) {
            try {
                const response = await fetch(`${apiUrl}${id}`);
                if (!response.ok) throw new Error('Gagal mengambil data produk untuk diedit');
                
                const produk = await response.json();
                
                document.querySelector("#id_produk").value = produk.id;
                document.querySelector("#nama_produk").value = produk.nama_produk;
                document.querySelector("#deskripsi").value = produk.deskripsi;
                document.querySelector("#harga").value = produk.harga;
                document.querySelector("#stok").value = produk.stok;
                
                modalProduk.show();

            } catch (error) {
                console.error("Error saat edit data:", error);



                notif('error', error.message);
            }
        }

        /**
         * 5. DELETE (Fungsi): Menghapus data (DELETE)
         */
        window.hapusProduk = function(id) {



            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data produk ini akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then(async (result) => {

                if (result.isConfirmed) {
                    try {
                        const response = await fetch(`${apiUrl}${id}`, {
                            method: 'DELETE'
                        });

                        if (!response.ok) {
                            const errorData = await response.json();
                            throw new Error(errorData.message || 'Gagal menghapus data');
                        }
                        
                        loadDataProduk();

                        notif('success', 'Data produk berhasil dihapus.');

                    } catch (error) {
                        console.error("Error saat menghapus data:", error);
                        notif('error', error.message);
                    }
                }
            })
        }


        loadDataProduk(); 

    });
</script>
<?= $this->endSection() ?>