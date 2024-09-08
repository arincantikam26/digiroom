<?php
include "./db_connection.php";

$sql = "SELECT * FROM sensor_data ORDER BY id DESC";
$result = $conn->query($sql);
?>

<div class="table-responsive">
    <table id="table_data" class="table table-striped table-hover" style="width: 100%;">
        <thead>
            <tr>
                <th>No</th>
                <th>Waktu</th>
                <th>Suhu</th>
                <th>Kelembapan</th>
                <th>Status Kelembapan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                $no = 1;
                while ($row = $result->fetch_assoc()) {
                    $status = ($row['kelembapan'] > 50) ? 'Tinggi' : 'Baik';
            ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $row['waktu'] ?></td>
                        <td><?= $row['suhu'] ?>&deg;C</td>
                        <td><?= $row['kelembapan'] ?> %</td>
                        <td><?= $status ?></td>
                    </tr>
            <?php
                }
            } else {
                echo '<tr><td colspan="5">Tidak ada data yang tersedia</td></tr>';
            }
            ?>


        </tbody>

    </table>
</div>
<script>
    $(document).ready(function() {
        // $('#table_data').DataTable();
        $('#table_data').DataTable({
            "pageLength": 10,
            "ordering": true,
            "info": true,
            "searching": true
        });

    });
</script>

<?php
$conn->close();
?>