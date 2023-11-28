<?php
    
    $con = mysqli_connect("localhost","root","","toko_online");

    //Check connection
    if (mysqli_connect_error()) {
        echo "Failed to connet to MySQL" . mysqli_connect_error();
        exit();
    }
?>