<?php
    session_start();
    require "../koneksi.php"
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
</head>

    <style>
        .main {
            height: 100vh;
        }
        .login-box {
            width: 500px;
            height: 300px;
            box-sizing: border-box;
            border-radius: 10px;
        }
        .size{
            font-size: 21px;
            font-weight: 800;
        }

        .warna {
            background-color: #3081D0;
        }
    </style>

<body>
    <div class="main d-flex flex-column justify-content-center align-items-center warna">
        <div class="login-box p-5 shadow bg-white">
            <form action="" method="post">
                <div class="text-center mb-3 size">
                    SELAMAT DATANG ADMIN
                </div>
                <div class="mb-2">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username"
                    id="username">
                </div>
                <div>
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password"
                    id="password">
                </div>
                <button class="btn btn-primary mt-3" type="submit" name="loginbtn">Login</button>
            </form>
        </div>
        
        <div class="mt-3" style="width: 500px;">
            <?php
                if(isset($_POST['loginbtn'])){
                    $username = htmlspecialchars($_POST['username']);
                    $password = htmlspecialchars($_POST['password']);

                    $query = mysqli_query($con, "SELECT * FROM users WHERE 
                    username = '$username'"); //melakukakan pengecekkan username dan password dengan query database
                    $countdata = mysqli_num_rows($query);
                    $data = mysqli_fetch_array($query);
                    
                    if($countdata>0) {
                        if (password_verify($password, $data['password'])){
                            $_SESSION['username'] = $data['username'];
                            $_SESSION['login'] = true;
                            header('location: ../adminpanel');
                        }else{
                            ?>
                            <div class="alert alert-warning" role="alert">
                            Password salah
                            </div>
                            <?php
                        }
                    }else{
                        ?>
                        <div class="alert alert-warning" role="alert">
                            Akun tidak tersedia
                        </div>
                        <?php
                    }
                }
            ?>
        </div>
    </div>
</body>    
</html>