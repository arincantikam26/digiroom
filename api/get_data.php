<?php 

include "../db_connection.php";

$sql = "SELECT * FROM sensor_data ORDER BY id DESC LIMIT 1";

$result = $conn->query($sql);

$data = [];
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $data['suhu'] = $row['suhu'];
    $data['kelembapan'] = $row['kelembapan'];
}  else {
    $data['suhu'] = "0";
    $data['kelembapan'] = "0";
}

echo json_encode($data);

$conn->close();

?>