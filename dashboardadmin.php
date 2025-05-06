<?php
session_start();
include 'koneksi.php';
if ($_SESSION['level'] != 'admin') {
    echo "<script>alert('Akses hanya untuk admin!'); window.location='loginadmin.php';</script>";
    exit;
}
$foto = isset($_SESSION['fotoprofil']) ? $_SESSION['fotoprofil'] : 'default.png';
$jumlah_kategori = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM kategori"));
$jumlah_produk = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM produk"));
$jumlah_admin = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM pengguna WHERE level='admin'"));
$jumlah_pelanggan = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM pengguna WHERE level='pelanggan'"));
$jumlah_transaksi = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM pembelian"));
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f0f2f5;
            display: flex;
        }

        /* Sidebar */
        .sidebar {
            width: 220px;
            background-color: #1b2e5a;
            color: white;
            min-height: 100vh;
            padding: 20px 0;
            position: fixed;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 40px;
            font-size: 20px;
        }

        .sidebar a {
            display: block;
            padding: 12px 30px;
            color: white;
            text-decoration: none;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background-color: #2e4a91;
        }

        .sidebar .footer {
            position: absolute;
            bottom: 20px;
            left: 0;
            width: 100%;
            text-align: center;
            font-size: 14px;
        }

        /* Main Content */
        .main {
            margin-left: 220px;
            padding: 40px;
            width: 100%;
        }

        .main h2 {
            margin-bottom: 20px;
        }

        .card-container {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .card {
            background: white;
            flex: 1 1 22%;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .card img {
            width: 40px;
            height: 40px;
            margin-bottom: 10px;
        }

        .card h3 {
            margin: 10px 0 5px;
            font-size: 24px;
            color: #333;
        }

        .card p {
            color: #777;
        }

        @media screen and (max-width: 768px) {
            .card-container {
                flex-direction: column;
            }

            .card {
                flex: 1 1 100%;
            }

            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
            }

            .main {
                margin-left: 0;
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Admin</h2>
        <a href="dashboardadmin.php">Dashboard</a>
        <a href="daftarproduk.php">Daftar Produk</a>
        <a href="daftartransaksi.php">Transaksi</a>
        <a href="daftarakun.php">Data Akun</a>
        <a href="kategoriproduk.php">Data Kategori</a>
        <a href="logoutadmin.php">Logout</a>
        <div class="footer">
            <img src="foto_pengguna/<?php echo $foto; ?>" alt="foto profil" style="width:90px; height:80px; border-radius:80%;">
            <p><br><?= $_SESSION['nama']; ?></p>
            <p><br><?= $_SESSION['level']; ?></p>
        </div>
    </div>

    <div class="main">
        <h2>Dashboard</h2>
        <div class="card-container">
            <div class="card">
                <img src="kategori.jpg" alt="Kategori">
                <h3><?= $jumlah_kategori ?></h3>
                <p>Jumlah Kategori</p>
            </div>
            <div class="card">
                <img src="produk.jpg" alt="Produk">
                <h3><?= $jumlah_produk ?></h3>
                <p>Jumlah Produk</p>
            </div>
            <div class="card">
                <img src="member.jpg" alt="Member">
                <h3><?= $jumlah_admin ?></h3>
                <p>Jumlah Admin</p>
            </div>
            <div class="card">
                <img src="member.jpg" alt="Member">
                <h3><?= $jumlah_pelanggan ?></h3>
                <p>Jumlah Pelanggan</p>
            </div>
            <div class="card">
                <img src="transaksi.jpg" alt="Transaksi">
                <h3><?= $jumlah_transaksi ?></h3>
                <p>Jumlah Transaksi</p>
            </div>
        </div>
    </div>
</body>
</html>
