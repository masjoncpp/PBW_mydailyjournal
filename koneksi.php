<?php
date_default_timezone_set('Asia/Jakarta');

$servername = "127.0.0.1";
$username = "jottie";
$password = "masjottie";
$db = "mydailyjournal";

//create connesction
$conn = new mysqli($servername, $username, $password, $db);

//check connection
if ($conn->connect_error) {
    die("Koneksi Gagal : " . $conn->connect_error);
}

?>