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
                    // Menentukan status kelembapan berdasarkan nilai kelembapan
                    if ($row['kelembapan'] < 25) {
                        $status = 'Tingkat kelembapan terlalu rendah, memicu kekeringan udara.';
                    } elseif ($row['kelembapan'] >= 25 && $row['kelembapan'] < 30) {
                        $status = 'Tingkat kelembapan udara yang rendah, namun cukup wajar.';
                    } elseif ($row['kelembapan'] >= 30 && $row['kelembapan'] <= 60) {
                        $status = 'Tingkat kelembapan udara yang ideal.';
                    } elseif ($row['kelembapan'] > 60 && $row['kelembapan'] <= 70) {
                        $status = 'Tingkat kelembapan udara yang tinggi, namun cukup wajar.';
                    } else {
                        $status = 'Tingkat kelembapan terlalu tinggi, memicu perkembangan bakteri.';
                    }
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
