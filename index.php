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
                <div class="col-4">
                    <div class="highlighted-kategori kategori-headset d-flex justify-content-center 
                    align-items-center">
                    <h4 class="text-white">Headset</h4>
                </div>
                </div>
                <div class="col-4">
                    <div class="highlighted-kategori kategori-mouse d-flex justify-content-center 
                    align-items-center">
                    <h4 class="text-white">Mouse</h4>
                </div>
                </div>
                <div class="col-4">
                    <div class="highlighted-kategori kategori-keyboard d-flex justify-content-center 
                    align-items-center">
                    <h4 class="text-white">Keyboard</h4>
                </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="fontawesome/js/all.min.js"></script>
</body>
</html>