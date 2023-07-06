<?php
include 'koneksi.php';

$id = $_GET['id'];

$sql = "DELETE FROM Listrik WHERE id=$id";

if ($koneksi->query($sql) === TRUE) {
    header("Location: index.php");
} else {
    echo "Error: " . $sql . "<br>" . $koneksi->error;
}

$koneksi->close();
?>
