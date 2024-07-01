<?php
include 'koneksi.php';

// Query untuk mengambil data dari tabel mahasiswalulus
$query = "SELECT angkatan, nama_jenis_keluar, id_prodi, COUNT(*) as jumlah 
          FROM mahasiswalulus 
          GROUP BY angkatan, nama_jenis_keluar, id_prodi";
$result = $koneksi->query($query);

$data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Mengembalikan data sebagai JSON
echo json_encode($data);
?>
