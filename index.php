<?php
    require "koneksi.php";
    $queryProduk = mysqli_query($con, "SELECT id, nama, harga, foto, detail FROM produk LIMIT 6");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Gaming Store</title>
</head>
<body>
    <?php require "navbar.php"; ?>

    <!-- banner -->
    <div class="container-fluid banner d-flex align-items-center">
        <div class="container text-center text-white">
            <h1>Gaming Store</h1>
            <h3>Mau Cari Apa?</h3>
            <div class="col-8 offset-md-2">
                 <form method="get" action="produk.php">
                    <div class="input-group input-group-lg my-4">
                        <input type="text" class="form-control" placeholder="Nama Barang" 
                        aria-label="Recipient's username" aria-describedby="basic-addon2" name="keyword">
                        <button type="submit" class="btn warna2 text-white">Cari</button>
                    </div>
                 </form>
            </div>
        </div>
    </div>

    <!-- highlighted kategori -->
    <div class="container-fluid">
        <div class="container py-5 text-center">
            <h3>Kategori Terlaris</h3>

            <div class="row mt-4">
                <div class="col-md-4 mb-3">
                    <div class="highlighted-kategori kategori-headset d-flex justify-content-center 
                    align-items-center">
                    <h4 class="text-white"><a class="no-decoration" href="produk.php?kategori=Headset">Headset</a></h4>
                </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="highlighted-kategori kategori-mouse d-flex justify-content-center 
                    align-items-center">
                    <h4 class="text-white"><a class="no-decoration" href="produk.php?kategori=Mouse">Mouse</a></h4>
                </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="highlighted-kategori kategori-keyboard d-flex justify-content-center 
                    align-items-center">
                    <h4 class="text-white"><a class="no-decoration" href="produk.php?kategori=Keyboard">Keyboard</a></h4>
                </div>
                </div>
            </div>
        </div>
    </div>

    <!-- tentang kami -->
    <div class="container-fluid warna4 py-5">
        <div class="container text-center text-white">
            <h3>Produk Unggulan</h3>
        </div>
    </div>

    <!-- produk -->
    <div class="container-fluid py-5">
        <div class="container text-center">
            <h3>Produk</h3>

            <div class="row mt-5">
                <?php while ($data = mysqli_fetch_array($queryProduk)){  ?> 
                <div class="col-sm-6 col-md-4 mb-3">
                    <div class="card h-100">
                        <div class="image-box">
                        <img src="image/<?php echo $data['foto'];?>" class="card-img-top" alt="...">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $data['nama'];?></h5>
                            <p class="card-text text-truncate"><?php echo $data['nama'];?></p>
                            <p class="card-text text-size">Rp <?php echo $data['harga'];?></p>
                            <a href="produk-detail.php?nama=<?php echo $data['nama'];?>" class="btn warna3 text-white">Lihat Detail</a>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
            <a href="produk.php" class="btn warna3 text-white mt-3 fs-6">See More</a>
        </div>
    </div>
      
    <!-- footer -->
    <?php require "footer.php";?>

    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="fontawesome/js/all.min.js"></script>
</body>
</html>