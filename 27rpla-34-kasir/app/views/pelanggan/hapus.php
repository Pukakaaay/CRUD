<?php 

include 'config.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "DELETE FROM pelanggan WHERE id = '$id'";

    if(mysqli_query($koneksi, $query)) {
        header('Location: list.php');
        exit();
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }
}

?>