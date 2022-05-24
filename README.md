# Lab8Web
## Nama   : Luthfi Al Ridwan
## NIM    : 312010112
## Kelas  : TI.20.A.1
## Matkul : Pemrograman Web

# Membuat Database
![ss-1](https://user-images.githubusercontent.com/73066008/170115264-9d8586ec-7af3-4594-a6eb-6ee06a0ef504.png)
# Membuat Tabel
![ss-2](https://user-images.githubusercontent.com/73066008/170115286-e18996b4-2526-4024-9f81-fb087009872b.png)
# Menambahkan Data
![ss-3](https://user-images.githubusercontent.com/73066008/170115307-33c1547c-53ee-4c63-867d-fb9d7f2fef1d.png)
# Membuat file koneksi database
Buat file baru dengan nama koneksi.php

    <?php
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "latihan1";
    $conn = mysqli_connect($host, $user, $pass, $db);
    if ($conn == false)
    {
     echo "Koneksi ke server gagal.";
     die();
    } else echo "Koneksi berhasil";
    ?>

![ss-4](https://user-images.githubusercontent.com/73066008/170117809-c9aab43f-f496-4943-bb47-3b6ad20ac2bc.png)

# Membuat file index untuk menampilkan data (Read)
Buat file baru dengan nama index.php

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
    
![ss-5](https://user-images.githubusercontent.com/73066008/170118857-ce903e6b-3620-4446-a185-064a9404f1cc.png)

# Menambah Data (Create)
Buat file baru dengan nama tambah.php

    <?php
    error_reporting(E_ALL);
    include_once 'koneksi.php';
    if (isset($_POST['submit']))
    {
     $nama = $_POST['nama'];
     $kategori = $_POST['kategori'];
     $harga_jual = $_POST['harga_jual'];
     $harga_beli = $_POST['harga_beli'];
     $stok = $_POST['stok'];
     $file_gambar = $_FILES['file_gambar'];
     $gambar = null;
     if ($file_gambar['error'] == 0)
     {
     $filename = str_replace(' ', '_',$file_gambar['name']);
     $destination = dirname(__FILE__) .'/gambar/' . $filename;
     if(move_uploaded_file($file_gambar['tmp_name'], $destination))
     {
     $gambar = 'gambar/' . $filename;;
     }
     }
     $sql = 'INSERT INTO data_barang (nama, kategori,harga_jual, harga_beli, 
    stok, gambar) ';
     $sql .= "VALUE ('{$nama}', '{$kategori}','{$harga_jual}', 
    '{$harga_beli}', '{$stok}', '{$gambar}')";
     $result = mysqli_query($conn, $sql);
     header('location: index.php');
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
     <meta charset="UTF-8">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
     <title>Tambah Barang</title>
    </head>
    <body>
    <div class="container">
     <h1>Tambah Barang</h1>
     <div class="main">
     <form method="post" action="tambah.php"
    enctype="multipart/form-data">
     <div class="input">
     <label>Nama Barang</label>
     <input type="text" name="nama" />
     </div>
     <div class="input">
     <label>Kategori</label>
     <select name="kategori">
     <option value="Laptop">Laptop</option>
     <option value="Elektronik">Elektronik</option>
     <option value="Hand Phone">Hand Phone</option>
     </select>
     </div>
     <div class="input">
     <label>Harga Jual</label>
     <input type="text" name="harga_jual" />
     </div>
     <div class="input">
     <label>Harga Beli</label>
     <input type="text" name="harga_beli" />
     </div>
     <div class="input">
     <label>Stok</label>
     <input type="text" name="stok" />
     </div>
     <div class="input">
     <label>File Gambar</label>
     <input type="file" name="file_gambar" />
     </div>
     <div class="submit">
     <input type="submit" name="submit" value="Simpan" />
     </div>
     </form>
     </div>
     </div>
    </body>
    </html>
    
![ss-6](https://user-images.githubusercontent.com/73066008/170118874-7af11a16-bc64-4ce6-a9dc-29dec470b207.png)

# Mengubah Data (Update)
Buat file baru dengan nama ubah.php

    <?php
    error_reporting(E_ALL);
    include_once 'koneksi.php';
    if (isset($_POST['submit']))
    {
     $id = $_POST['id'];
     $nama = $_POST['nama'];
     $kategori = $_POST['kategori'];
     $harga_jual = $_POST['harga_jual'];
     $harga_beli = $_POST['harga_beli'];
     $stok = $_POST['stok'];
     $file_gambar = $_FILES['file_gambar'];
     $gambar = null;

     if ($file_gambar['error'] == 0)
     {
     $filename = str_replace(' ', '_', $file_gambar['name']);
     $destination = dirname(__FILE__) . '/gambar/' . $filename;
     if (move_uploaded_file($file_gambar['tmp_name'], $destination))
     {
     $gambar = 'gambar/' . $filename;;
     }
    }
    $sql = 'UPDATE data_barang SET ';
    $sql .= "nama = '{$nama}', kategori = '{$kategori}', ";
    $sql .= "harga_jual = '{$harga_jual}', harga_beli = '{$harga_beli}', stok 
    = '{$stok}' ";
    if (!empty($gambar))
    $sql .= ", gambar = '{$gambar}' ";
    $sql .= "WHERE id_barang = '{$id}'";
    $result = mysqli_query($conn, $sql);
    header('location: index.php');
    }
    $id = (isset($_GET['id']));
    $sql = "SELECT * FROM data_barang WHERE id_barang = '{$id}'";
    $result = mysqli_query($conn, $sql);
    if (!$result) die('Error: Data tidak tersedia');
    $data = mysqli_fetch_array($result);
    function is_select($var, $val) {
    if ($var == $val) return 'selected="selected"';
    return false;
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Ubah Barang</title>
    </head>
    <body>
    <div class="container">
    <h1>Ubah Barang</h1>
    <div class="main">
    <form method="post" action="ubah.php"
    enctype="multipart/form-data">
    <div class="input">
    <label>Nama Barang</label>
    <input type="text" name="nama">
    </div>
    <div class="input">
    <label>Kategori</label>
    <select name="kategori">
    <option value="Komputer">Laptop</option>
    <option value="Elektronik">Elektronik</option>
    <option value="Hand Phone">Hand Phone</option>
     </select>
     </div>
     <div class="input">
     <label>Harga Jual</label>
     <input type="text" name="harga_jual">
     </div>
     <div class="input">
     <label>Harga Beli</label>
     <input type="text" name="harga_beli">
     </div>
     <div class="input">
     <label>Stok</label>
     <input type="text" name="stok">
     </div>
     <div class="input">
     <label>File Gambar</label>
     <input type="file" name="file_gambar" />
     </div>
     <div class="submit">
     <input type="hidden" name="id">
     <input type="submit" name="submit" value="Simpan" />
     </div>
     </form>
     </div>
    </div>
    </body>
    </html>
    
![ss-7](https://user-images.githubusercontent.com/73066008/170120201-7eafb673-e31f-4dd7-80d2-ee8d46a6cd2b.png)

# Menghapus Data (Delete)
Buat file baru dengan nama hapus.php

    <?php
    include_once 'koneksi.php';
    $id = $_GET['id'];
    $sql = "DELETE FROM data_barang WHERE id_barang = '{$id}'";
    $result = mysqli_query($conn, $sql);
    header('location: index.php');
    ?>

