<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inventaris Barang</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        /* CSS Sederhana untuk meniru layout di referensi Anda */
        body {
            display: flex;
            min-height: 100vh;
            background-color: #f8f9fa; /* Warna latar belakang konten */
        }

        /* Sidebar */
        .sidebar {
            width: 280px;
            background-color: #343a40; /* Warna gelap sidebar */
            color: white;
            flex-shrink: 0; /* Mencegah sidebar menyusut */
        }
        .sidebar .nav-link {
            color: #ccc;
        }
        .sidebar .nav-link.active {
            color: #fff;
            background-color: #495057;
        }
        .sidebar .nav-link:hover {
            color: #fff;
            background-color: #495057;
        }
        
        /* Content Wrapper */
        .content-wrapper {
            flex-grow: 1; /* Mengisi sisa ruang */
            display: flex;
            flex-direction: column;
        }

        /* Topbar */
        .topbar {
            background-color: #ffffff;
            border-bottom: 1px solid #dee2e6;
            padding: 0.75rem 1.5rem;
        }
        
        /* Main Content */
        .main-content {
            padding: 1.5rem;
            flex-grow: 1;
        }
    </style>
</head>

<body>

    <aside class="sidebar p-3">
        <h3 class="h5 text-white text-center mb-3">Inventaris</h3>
        <ul class="nav nav-pills flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="#">
                    <i class="bi bi-box-seam me-2"></i> Master Barang
                </a>
            </li>
            </ul>
    </aside>

    <div class="content-wrapper">

        <header class="topbar d-flex justify-content-end shadow-sm">
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person-circle fs-4 me-2"></i>
                    <strong>Administrator</strong>
                </a>
                <ul class="dropdown-menu dropdown-menu-end text-small shadow">
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Sign out</a></li>
                </ul>
            </div>
        </header>

        <main class="main-content">
            <?= $this->renderSection('content') ?>
        </main>
        
    </div> <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?= $this->renderSection('scripts') ?>

</body>

</html>