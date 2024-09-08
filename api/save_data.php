<?php

// Menyertakan file koneksi database
include '../db_connection.php';

// Periksa apakah data diterima dari metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data suhu dan kelembapan dari POST request
    $suhu = isset($_POST['temperature']) ? $_POST['temperature'] : null;
    $kelembapan = isset($_POST['humidity']) ? $_POST['humidity'] : null;

    // Validasi data (opsional, untuk memastikan data dalam format yang benar)
    if (is_numeric($suhu) && is_numeric($kelembapan)) {
        // Query untuk memasukkan data suhu dan kelembapan ke database
        $sql = "INSERT INTO sensor_data (suhu, kelembapan) VALUES ('$suhu', '$kelembapan')";

        if ($conn->query($sql) === TRUE) {
            echo "Data berhasil disimpan";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Data tidak valid.";
    }
} else {
    echo "Metode request tidak valid. Gunakan POST.";
}

// Tutup koneksi
$conn->close();
?>
