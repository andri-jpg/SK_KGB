<?php
session_start();
if (isset($_SESSION['logged']) && !empty($_SESSION['logged'])) {
    include "./database.php";
    include '_header.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['hapus'])) {
        $id_to_delete = $_POST['hapus'];
        $query_delete = mysqli_query($db_conn, "DELETE FROM data_sk WHERE id = $id_to_delete");

        if ($query_delete) {
             header("Location: ./data_sk.php");
        } else {
            echo "Gagal menghapus data. Error: " . mysqli_error($db_conn);
        }
    }

} else {
    header('Location: ./login.php');
}
?>