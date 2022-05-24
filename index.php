<?php
include("koneksi.php");
// query untuk menampilkan data
$sql = 'SELECT * FROM data_barang';
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
 <title>Data Barang</title>
</head>
<body>
 <div class="container">
 <h1>Data Barang</h1>
 <a href="tambah.php"><button class="btn btn-primary right mb-2 mt-2">Tambah Barang</button></a>
 <div class="main">
 <div class="table-responsive">
    <table class="table table-dark table-hover">
 <tr>
 <th>Gambar</th>
 <th>Nama Barang</th>
 <th>Katagori</th>
 <th>Harga Jual</th>
 <th>Harga Beli</th>
 <th>Stok</th>
 <th>Aksi</th>
 </tr>
 <?php if($result): ?>
 <?php while($row = mysqli_fetch_array($result)): ?>
 <tr>
 <td><img src="gambar/<?= $row['gambar'];?>" alt="<?=
$row['nama'];?>"></td>
 <td><?= $row['nama'];?></td>
 <td><?= $row['kategori'];?></td>
 <td><?= $row['harga_beli'];?></td>
 <td><?= $row['harga_jual'];?></td>
 <td><?= $row['stok'];?></td>
 <td>
    <a href="ubah.php" class="btn btn-success btn-sm">Update</a>
    <a href="hapus.php" class="btn btn-danger btn-sm" onclick="return confirm(\'Yakin untuk menghapus data ini?\')">Delete</a>
</td>
 </tr>
 <?php endwhile; else: ?>
 <tr>
 <td colspan="7">Belum ada data</td>
 </tr>
 <?php endif; ?>
 </table>
 </div>
 </div>
</body>
</html>
