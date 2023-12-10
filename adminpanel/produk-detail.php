<?php
    require "session.php";
    require "../koneksi.php";

    $id = $_GET['p'];

    $query = mysqli_query($con, "SELECT a.*, b.nama AS nama_kategori FROM produk a JOIN kategori b ON a.
    kategori_id=b.id WHERE a.id='$id'");
    $data = mysqli_fetch_array($query);

    $queryKategori = mysqli_query($con, "SELECT * FROM kategori WHERE id!='$data[kategori_id]'");

    function generateRandomString($length = 10){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++){
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <title>Produk Detail</title>
</head>
<body>
    <?php  require "navbar.php" ?>
        <div class="container mt-2">
            <h2>Detail Produk</h2>

            <div class="col-12 col-md-6 mb-5">
                <form action="" method="post" enctype="multipart/form-data">
                <div>
                    <label for="nama" class="mb-2">Nama</label>
                    <input type="text" name="nama" id="nama" value="<?php echo $data['nama']?>" class="form-control" autocomplete="off"
                    required>
                </div>
                <div>
                    <label for="kategori" class="my-2">Produk</label>
                    <select name="kategori" id="kategori" class="form-control" required>
                    <option value="<?php echo $data['kategori_id']; ?>"><?php echo $data['nama_kategori']; ?></option>
                        <?php
                            while($dataKategori=mysqli_fetch_array($queryKategori)){
                        ?>
                            <option value="<?php echo $dataKategori['id']; ?>"><?php echo $dataKategori['nama']; ?></option>
                        <?php        
                            }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="harga" class="my-2">Harga</label>
                    <input type="number" name="harga" class="form-control" value="<?php echo $data['harga'] ?>" required>
                </div>
                <div>
                    <label for="currentFoto" class="m-2">Foto Produk Sekarang</label> <br>
                    <img src="../image/<?php echo $data['foto'] ?>" alt="" width="300px">
                </div>
                <div>
                    <label for="foto" class="my-2">Foto</label>
                    <input type="file" name="foto" id="foto" class="form-control">
                </div>
                <div>
                    <label for="detail" class="my-2">Detail</label>
                    <textarea name="detail" id="detail" cols="30" rows="10" class="form-control">
                        <?php echo $data['detail']; ?>
                    </textarea>
                </div>
                <div>
                    <label for="ketersediaan_stok" class="my-2">Ketersediaan Stok</label>
                    <select name="ketersediaan_stok" id="ketersediaan_stok" class="form-control">
                        <option value="<?php echo $data['ketersediaan_stok'] ?>"> <?php echo $data
                        ['ketersediaan_stok'] ?></option>
                        <?php
                            if($data['ketersediaan_stok']=='tersedia'){
                        ?>
                            <option value="habis">habis</option>
                        <?php
                            }else{
                        ?>
                            <option value="tersedia">tersedia</option>
                        <?php
                            }
                        ?>
                    </select>
                </div>  
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary my-3" name="update">Simpan</button>
                    <button type="submit" class="btn btn-danger my-3" name="hapus">Hapus</button>
                </div>
                </form>

                <?php
                    if(isset($_POST['update'])){
                        $nama = htmlspecialchars($_POST['nama']);
                        $kategori = htmlspecialchars($_POST['kategori']);
                        $harga = htmlspecialchars($_POST['harga']);
                        $detail = htmlspecialchars($_POST['detail']);
                        $ketersediaan_stok = htmlspecialchars($_POST['ketersediaan_stok']);

                        $target_dir = "../image/";
                        $nama_file = basename($_FILES["foto"]["name"]);
                        $target_file = $target_dir . $nama_file;
                        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                        $image_size = $_FILES["foto"]["size"];
                        $randomName = generateRandomString(20);
                        $newName = $randomName . "." . $imageFileType;

                        if($nama=='' || $kategori=='' || $harga==''){
                ?>
                            <div class="alert alert-warning mt-3" role="alert">
                                Nama, Kategori, dan harga wajib diisi
                            </div>
                <?php
                        }else{
                            $queryUpdate = mysqli_query($con, "UPDATE produk SET kategori_id='$kategori',
                            nama='$nama', harga='$harga', detail='$detail', 
                            ketersediaan_stok='$ketersediaan_stok' WHERE id=$id");

                            if($nama_file!=''){
                                if($image_size > 500000){
                ?>
                                    <div class="alert alert-warning mt-3" role="alert">
                                        Ukuran gambar tidak boleh lebih dari 500kb
                                    </div>
                <?php
                                }else{
                                    if($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg'){
                 ?>
                                    <div class="alert alert-warning mt-3" role="alert">
                                        Gambar wajib bertipe jpg atau png atau gif
                                    </div>
                 <?php                       
                                    }else{
                                        move_uploaded_file($_FILES["foto"]["tmp_name"], $target_dir .
                                        $newName);

                                        $queryUpdate = mysqli_query($con, "UPDATE produk SET foto='$newName' WHERE id=$id");
                                    
                                        if($queryUpdate){
                ?>
                                             <div class="alert alert-primary mt-3" role="alert">
                                                Produk Berhasil Diupdate
                                            </div>
                                            <meta http-equiv="refresh" content="2; url=produk.php"/>
                <?php
                                        }else{
                                            echo mysqli_error($con);
                                        }
                                    }
                                }
                            }
                        }
                    }

                    if(isset($_POST['hapus'])){
                        $queryHapus = mysqli_query($con, "DELETE FROM produk WHERE id='$id'");

                        if($queryHapus){
                ?>
                            <div class="alert alert-primary mt-3" role="alert">
                                Produk Berhasil Dihapus
                            </div>
                            <meta http-equiv="refresh" content="2; url=produk.php">
                <?php
                        }
                    }
                ?>
            </div>
        </div>
    
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>