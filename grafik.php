<!DOCTYPE html>
<html>
<head>
    <title>Grafik Mahasiswa Lulus</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <canvas id="myChart" width="400" height="200"></canvas>
    <script>
        // Mendapatkan data dari file PHP
        fetch('data.php')
            .then(response => response.json())
            .then(data => {
                const angkatan = [];
                const jenisKeluar = [];
                const prodi = [];
                const jumlah = [];

                data.forEach(d => {
                    angkatan.push(d.angkatan);
                    jenisKeluar.push(d.nama_jenis_keluar);
                    prodi.push(d.id_prodi);
                    jumlah.push(d.jumlah);
                });

                const ctx = document.getElementById('myChart').getContext('2d');
                const myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: angkatan,
                        datasets: [{
                            label: 'Jumlah Mahasiswa Lulus',
                            data: jumlah,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            })
            .catch(error => console.error('Error:', error));
    </script>
</body>
</html>
