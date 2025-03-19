<?php

// Tambahkan header CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
// Konfigurasi database
$host = 'localhost';
$username = 'root'; // Ganti dengan username database Anda
$password = ''; // Ganti dengan password database Anda
$database = 'respons'; // Ganti dengan nama database Anda

// Koneksi ke database
$conn = new mysqli($host, $username, $password, $database);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mendapatkan data dari request
$response = isset($_POST['response']) ? $_POST['response'] : '';
$whatsapp = isset($_POST['whatsapp']) ? $_POST['whatsapp'] : null;

// Menyimpan data ke database
$stmt = $conn->prepare("INSERT INTO responses (response, whatsapp, created_at) VALUES (?, ?, NOW())");
$stmt->bind_param("ss", $response, $whatsapp);

if ($stmt->execute()) {
    echo "Data berhasil disimpan";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
