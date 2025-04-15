<?php

include 'koneksi.php';

function query($query) {
    global $koneksi;
    $result = mysqli_query($koneksi, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function dollarFormat($angka) {
    $hasil_dollar = "$" . number_format($angka, 2, '.', ',');
    return $hasil_dollar;
}

?>