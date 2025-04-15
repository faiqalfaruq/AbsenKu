<?php
include '../config.php';
$nis = $_GET['nis'] ?? '';

$data = mysqli_query($koneksi, "
  SELECT a.*, s.nama, s.kelas FROM absen a
  JOIN siswa s ON a.nis = s.nis
  WHERE a.nis = '$nis'
  ORDER BY a.tanggal DESC
");
?>

<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }

        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>


    <h2 style="text-align:center;">Rekap Absen - NIS: <?= htmlspecialchars($nis) ?></h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            while ($row = mysqli_fetch_assoc($data)) {
                echo "<tr>";
                echo "<td>" . $no++ . "</td>";
                echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
                echo "<td>" . htmlspecialchars($row['kelas']) . "</td>";
                echo "<td>" . htmlspecialchars($row['tanggal']) . "</td>";
                echo "<td>" . ($row['waktu'] ?? '-') . "</td>";
                echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                echo "</tr>";
            }
            if ($no === 1) {
                echo "<tr><td colspan='6'>Data tidak ditemukan.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <script>
        window.onload = function () {
            window.print();
        };
    </script>

</body>

</html>