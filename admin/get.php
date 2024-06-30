<?php
  include '../koneksi.php';
  include '../config/initsoap.php';
  date_default_timezone_set('Asia/Jakarta');
  session_start();
  if($_SESSION['status'] != "administrator_logedin"){
    header("location:../login.php?alert=belum_login");
  }
///////////////////////////lihat/////////////////////////////////////////////
if($_GET['aksi']=='getmahasiswa'){
    $filter = "";
    $order = '';
    $limit = '';
    $offset = '';
    $data_aray = [
        'act' => 'GetListMahasiswa',
        'token' => $_token,
        'filter' => $filter, 
        'order' => $order, 
        'limit' => $limit, 
        'offset' => $offset
    ];
    $datajson = json_decode($_ws->execute($data_aray));
    $dataArray = $datajson->data;

    foreach ($dataArray as $d) {
        $nama_mahasiswa = $d->nama_mahasiswa;
        $jenis_kelamin = $d->jenis_kelamin;
        $tanggal_lahir = date('Y-m-d', strtotime($d->tanggal_lahir));
        $id_perguruan_tinggi = $d->id_perguruan_tinggi;
        $nipd = $d->nipd;
        $ipk = $d->ipk;
        $total_sks = $d->total_sks;
        $id_sms = $d->id_sms;
        $id_mahasiswa = $d->id_mahasiswa;
        $id_agama = $d->id_agama;
        $nama_agama = $d->nama_agama;
        $id_prodi = $d->id_prodi;
        $nama_program_studi = $d->nama_program_studi;
        $id_status_mahasiswa = $d->id_status_mahasiswa;
        $nama_status_mahasiswa = $d->nama_status_mahasiswa;
        $nim = $d->nim;
        $id_periode = $d->id_periode;
        $nama_periode_masuk = $d->nama_periode_masuk;
        $id_registrasi_mahasiswa = $d->id_registrasi_mahasiswa;
        $id_periode_keluar = $d->id_periode_keluar;
        $tanggal_keluar = date('Y-m-d', strtotime($d->tanggal_keluar));
        $last_update = date('Y-m-d', strtotime($d->last_update));
        $tgl_create = date('Y-m-d', strtotime($d->tgl_create));
        $status_sync = $d->status_sync;

        $sql_check = "SELECT COUNT(*) as count FROM mahasiswa WHERE id_mahasiswa = '$id_mahasiswa'";
        $result_check = $koneksi->query($sql_check);

        if ($result_check === false) {
            echo "Error in SQL query: " . $koneksi->error;
            die();
        }

        $row_check = $result_check->fetch_assoc();

        if ($row_check['count'] == 0) {
            $sql = "INSERT INTO mahasiswa (
                nama_mahasiswa,
                jenis_kelamin,
                tanggal_lahir,
                id_perguruan_tinggi,
                nipd,
                ipk,
                total_sks,
                id_sms,
                id_mahasiswa,
                id_agama,
                nama_agama,
                id_prodi,
                nama_program_studi,
                id_status_mahasiswa,
                nama_status_mahasiswa,
                nim,
                id_periode,
                nama_periode_masuk,
                id_registrasi_mahasiswa,
                id_periode_keluar,
                tanggal_keluar,
                last_update,
                tgl_create,
                status_sync
            ) VALUES (
                '$nama_mahasiswa',
                '$jenis_kelamin',
                '$tanggal_lahir',
                '$id_perguruan_tinggi',
                '$nipd',
                '$ipk',
                '$total_sks',
                '$id_sms',
                '$id_mahasiswa',
                '$id_agama',
                '$nama_agama',
                '$id_prodi',
                '$nama_program_studi',
                '$id_status_mahasiswa',
                '$nama_status_mahasiswa',
                '$nim',
                '$id_periode',
                '$nama_periode_masuk',
                '$id_registrasi_mahasiswa',
                '$id_periode_keluar',
                '$tanggal_keluar',
                '$last_update',
                '$tgl_create',
                '$status_sync'
            )";

            if ($koneksi->query($sql) === TRUE) {
                echo '
                <div class="alert alert-success" role="alert">
                Data berhasil disimpan ke dalam basis data.
                </div>
                <script>
                    setTimeout(function() {
                        window.location.href = "index.php?aksi=mahasiswa";
                    }, 3000); // Delay 3 detik sebelum mengalihkan
                </script>';
            } else {
                echo "Error: " . $sql . "<br>" . $koneksi->error;
            }
        } else {
            echo '
            <div class="alert alert-danger" role="alert">
            Data sudah ada dalam basis data, input gagal.
            </div>';
        }
    }
}
elseif($_GET['aksi']=='getmahasiswalulus'){
    $filter = "";
    $order = '';
    $limit = '';
    $offset = '';
    $data_aray = [
        'act' => 'GetListMahasiswaLulus',
        'token' => $_token,
        'filter' => $filter, 
        'order' => $order, 
        'limit' => $limit, 
        'offset' => $offset
    ];
    $datajson = json_decode($_ws->execute($data_aray));
    $dataArray = $datajson->data;

    foreach ($dataArray as $d) {
        $id_registrasi_mahasiswa = $d->id_registrasi_mahasiswa;
        $id_prodi = $d->id_prodi;
        $nama_program_studi = $d->nama_program_studi;
        $id_mahasiswa = $d->id_mahasiswa;
        $nim = $d->nim;
        $nama_mahasiswa = $d->nama_mahasiswa;
        $angkatan = $d->angkatan;
        $id_jenis_keluar = $d->id_jenis_keluar;
        $nama_jenis_keluar = $d->nama_jenis_keluar;
        $tanggal_keluar = date('Y-m-d', strtotime($d->tanggal_keluar));
        $keterangan = isset($d->keterangan) ? $d->keterangan : NULL;
        $nomor_sk_yudisium = isset($d->nomor_sk_yudisium) ? $d->nomor_sk_yudisium : NULL;
        $tanggal_sk_yudisium = isset($d->tanggal_sk_yudisium) ? date('Y-m-d', strtotime($d->tanggal_sk_yudisium)) : NULL;
        $ipk = $d->ipk;
        $nomor_ijazah = $d->nomor_ijazah;
        $jalur_skripsi = isset($d->jalur_skripsi) ? $d->jalur_skripsi : NULL;
        $judul_skripsi = isset($d->judul_skripsi) ? $d->judul_skripsi : NULL;
        $no_sertifikat_profesi = isset($d->no_sertifikat_profesi) ? $d->no_sertifikat_profesi : NULL;
        $bulan_awal_bimbingan = isset($d->bulan_awal_bimbingan) ? date('Y-m-d', strtotime($d->bulan_awal_bimbingan)) : NULL;
        $bulan_akhir_bimbingan = isset($d->bulan_akhir_bimbingan) ? date('Y-m-d', strtotime($d->bulan_akhir_bimbingan)) : NULL;
        $id_dosen = isset($d->id_dosen) ? $d->id_dosen : NULL;
        $nidn = isset($d->nidn) ? $d->nidn : NULL;
        $nama_dosen = isset($d->nama_dosen) ? $d->nama_dosen : NULL;
        $pembimbing_ke = isset($d->pembimbing_ke) ? $d->pembimbing_ke : NULL;
        $asal_ijazah = $d->asal_ijazah;
        $id_periode_keluar = isset($d->id_periode_keluar) ? $d->id_periode_keluar : NULL;

        $sql_check = "SELECT COUNT(*) as count FROM mahasiswalulus WHERE id_registrasi_mahasiswa = '$id_registrasi_mahasiswa'";
        $result_check = $koneksi->query($sql_check);

        if ($result_check === false) {
            echo "Error in SQL query: " . $koneksi->error;
            die();
        }

        $row_check = $result_check->fetch_assoc();

        if ($row_check['count'] == 0) {
            $sql = "INSERT INTO mahasiswalulus (
                id_registrasi_mahasiswa,
                id_prodi,
                nama_program_studi,
                id_mahasiswa,
                nim,
                nama_mahasiswa,
                angkatan,
                id_jenis_keluar,
                nama_jenis_keluar,
                tanggal_keluar,
                keterangan,
                nomor_sk_yudisium,
                tanggal_sk_yudisium,
                ipk,
                nomor_ijazah,
                jalur_skripsi,
                judul_skripsi,
                no_sertifikat_profesi,
                bulan_awal_bimbingan,
                bulan_akhir_bimbingan,
                id_dosen,
                nidn,
                nama_dosen,
                pembimbing_ke,
                asal_ijazah,
                id_periode_keluar
            ) VALUES (
                '$id_registrasi_mahasiswa',
                '$id_prodi',
                '$nama_program_studi',
                '$id_mahasiswa',
                '$nim',
                '$nama_mahasiswa',
                '$angkatan',
                '$id_jenis_keluar',
                '$nama_jenis_keluar',
                '$tanggal_keluar',
                '$keterangan',
                '$nomor_sk_yudisium',
                '$tanggal_sk_yudisium',
                '$ipk',
                '$nomor_ijazah',
                '$jalur_skripsi',
                '$judul_skripsi',
                '$no_sertifikat_profesi',
                '$bulan_awal_bimbingan',
                '$bulan_akhir_bimbingan',
                '$id_dosen',
                '$nidn',
                '$nama_dosen',
                '$pembimbing_ke',
                '$asal_ijazah',
                '$id_periode_keluar'
            )";

            if ($koneksi->query($sql) === TRUE) {
                echo '
                <div class="alert alert-success" role="alert">
                Data berhasil disimpan ke dalam basis data.
                </div>
                <script>
                    setTimeout(function() {
                        window.location.href = "index.php?aksi=mahasiswalulus";
                    }, 3000); // Delay 3 detik sebelum mengalihkan
                </script>';
            } else {
                echo "Error: " . $sql . "<br>" . $koneksi->error;
            }
        } else {
            echo '
            <div class="alert alert-danger" role="alert">
            Data sudah ada dalam basis data, input gagal.
            </div>';
        }
    }
}
elseif($_GET['aksi']=='getmatkul'){
	$filter = "";
	$order = '';
	$limit = '';
	$offset = '';
	$data_aray = [
	  'act' => 'GetDetailMataKuliah',
	  'token' => $_token,
	  'filter' => $filter, 
	  'order' => $order, 
	  'limit' => $limit, 
	  'offset' => $offset
	];
	$datajson = json_decode($_ws->execute($data_aray));
	$dataArray = $datajson->data;
	foreach ($dataArray as $d) {
			$id_matkul = $d->id_matkul;
			$kode_mata_kuliah = $d->kode_mata_kuliah;
			$nama_mata_kuliah = $d->nama_mata_kuliah;
			$id_prodi = $d->id_prodi;
			$nama_program_studi = $d-> nama_program_studi;
			$id_jenis_mata_kuliah = $d-> id_jenis_mata_kuliah;
			$id_kelompok_mata_kuliah = $d-> id_kelompok_mata_kuliah;
			$sks_mata_kuliah= $d->sks_mata_kuliah;
			$sks_tatap_muka= $d->sks_tatap_muka;
			$sks_praktek= $d->sks_praktek;
			$sks_praktek_lapangan= $d->sks_praktek_lapangan;
			$sks_simulasi= $d->sks_simulasi;
			$metode_kuliah= $d->metode_kuliah;
			$ada_sap= $d->ada_sap;
			$ada_silabus= $d->ada_silabus;
			$ada_bahan_ajar= $d->ada_bahan_ajar;
			$ada_acara_praktek= $d->ada_acara_praktek;
			$ada_diktat= $d->ada_diktat;
			$tanggal_mulai_efektif= $d->tanggal_mulai_efektif;
			$tanggal_selesai_efektif= $d->tanggal_selesai_efektif;
			if ($d->id_prodi === "be5768fc-b53c-40c2-9593-b8ecae11437f") { 
				$kode = "57201";
		   } elseif ($d->id_prodi === "9bd9cb24-db6e-467f-98d9-36e3c8668251") {
			    $kode = "57401";
		   } 
		   $sql_check = "SELECT COUNT(*) as count FROM matakuliah WHERE id_matkul = '$id_matkul' AND kode_mata_kuliah = '$kode_mata_kuliah' 
		   AND id_prodi = '$id_prodi' AND id_jenis_mata_kuliah = '$id_jenis_mata_kuliah' AND id_kelompok_mata_kuliah = '$id_kelompok_mata_kuliah'
		   AND sks_mata_kuliah = '$sks_mata_kuliah' AND sks_tatap_muka = '$sks_tatap_muka' AND sks_praktek = '$sks_praktek'
		   AND sks_praktek_lapangan = '$sks_praktek_lapangan' AND sks_simulasi = '$sks_simulasi' AND metode_kuliah = '$metode_kuliah'
		   AND ada_sap = '$ada_sap' AND ada_silabus = '$ada_silabus' AND ada_bahan_ajar = '$ada_bahan_ajar' AND ada_diktat = '$ada_diktat'
		   AND ada_acara_praktek = '$ada_acara_praktek' AND tanggal_mulai_efektif = '$tanggal_mulai_efektif' AND tanggal_selesai_efektif = '$tanggal_selesai_efektif'";
		   $result_check = $koneksi->query($sql_check);
		   
		   if ($result_check === false) {
			   echo "Error in SQL query: " . $koneksi->error;
			   die();
		   }
		   
		   $row_check = $result_check->fetch_assoc();
		   
		   if ($row_check['count'] == 0) {
			   // Data belum ada dalam database, lakukan INSERT
			   $sql = "INSERT INTO matakuliah (id_matkul,kode_mata_kuliah,nama_mata_kuliah,id_prodi,kode_jur,nama_program_studi,
			                                   id_jenis_mata_kuliah,id_kelompok_mata_kuliah,sks_mata_kuliah,sks_tatap_muka,
											   sks_praktek_lapangan,sks_simulasi,metode_kuliah,ada_sap,
											   ada_silabus,ada_bahan_ajar,ada_acara_praktek,ada_diktat,tanggal_mulai_efektif,tanggal_selesai_efektif) 
					   VALUES ('$id_matkul', '$kode_mata_kuliah', '$nama_mata_kuliah', '$id_prodi','$kode','$nama_program_studi',
					           '$id_jenis_mata_kuliah','$id_kelompok_mata_kuliah','$sks_mata_kuliah','$sks_tatap_muka',
							   '$sks_praktek_lapangan','$sks_simulasi','$metode_kuliah','$ada_sap',
							   '$ada_silabus','$ada_bahan_ajar','$ada_acara_praktek','$ada_diktat','$tanggal_mulai_efektif','$tanggal_selesai_efektif')";
		   
			   if ($koneksi->query($sql) === TRUE) {
				   echo '
				   <div class="alert alert-success" role="alert">
				   Data berhasil disimpan ke dalam basis data.
				   </div>
				   <script>
					   setTimeout(function() {
						   window.location.href = "index.php?aksi=matakuliahdb";
					   }, 3000); // Delay 3 detik sebelum mengalihkan
				   </script>';
			   } else {
				   echo "Error: " . $sql . "<br>" . $koneksi->error;
			   }
		   } else {
			   echo '
			   <div class="alert alert-danger" role="alert">
			   Data sudah ada dalam basis data, input gagal.
			   </div>';
		   }
		   
		}
	} 
elseif($_GET['aksi']=='getkurma'){
	$id_k=$_GET['id_kurikulum'];
	$keterangan=$_GET['keterangan'];
	$filter ="id_kurikulum='$keterangan'";
	$order = '';
	$limit = '';
	$offset = '';
	$data_aray = [
	  'act' => 'GetMatkulKurikulum',
	  'token' => $_token,
	  'filter' => $filter, 
	  'order' => $order, 
	  'limit' => $limit, 
	  'offset' => $offset
	];
	$datajson = json_decode($_ws->execute($data_aray));
	$dataArray = $datajson->data;
	foreach ($dataArray as $d) {
		$fil= "id_matkul='$d->id_matkul'";
		$ord = '';
		$lim = '';
		$off = '';
		$data_ar = [
		  'act' => 'GetDetailMataKuliah',
		  'token' => $_token,
		  'filter' => $fil, 
		  'order' => $ord, 
		  'limit' => $lim, 
		  'offset' => $off
		];
		$datajs = json_decode($_ws->execute($data_ar));
		$dataAr = $datajs->data;
		foreach ($dataAr as $x);

			$id_matkul = $d->id_matkul;
			$id_kurikulum = $d->id_kurikulum;
			$kode_mata_kuliah = $d->kode_mata_kuliah;
			$nama_mata_kuliah = $d-> nama_mata_kuliah;
			$sks_tatap_muka = $d-> sks_tatap_muka;
			$sks_praktek = $d-> sks_praktek;
			$sks_praktek_lapangan = $d-> sks_praktek_lapangan;
			$sks_simulasi = $d-> sks_simulasi;
			$id_semester = $d-> id_semester;
			$id_prodi = $d-> id_prodi;
			$jnis = $x->id_kelompok_mata_kuliah;
			if ($d->id_prodi === "be5768fc-b53c-40c2-9593-b8ecae11437f") { 
				$kode = "57201";
		   } elseif ($d->id_prodi === "9bd9cb24-db6e-467f-98d9-36e3c8668251") {
			    $kode = "57401";
		   } 
		   $sql_check = "SELECT COUNT(*) as count FROM mat_kurikulum WHERE kode_mk = '$kode_mata_kuliah' AND jns_mk = '$jnis' AND  sks_prak = '$sks_praktek' AND  
		   sks_prak_lap = '$sks_praktek_lapangan' AND sks_tm = '$sks_tatap_muka' AND sks_sim = '$sks_simulasi' AND semester = '$id_semester' AND id_kurikulum = '$id_k'";
		   $result_check = $koneksi->query($sql_check);
		   
		   if ($result_check === false) {
			   echo "Error in SQL query: " . $koneksi->error;
			   die();
		   }
		   
		   $row_check = $result_check->fetch_assoc();
		   
		   if ($row_check['count'] == 0) {
			   // Data belum ada dalam database, lakukan INSERT
			   $sql = "INSERT INTO mat_kurikulum (id_kurikulum,kode_mk,nama_mk,jns_mk,sks_tm,sks_prak,sks_prak_lap,sks_sim,semester,kode_jurusan,status_error,keterangan,id_kur) 
					   VALUES ('$id_k', '$kode_mata_kuliah', '$nama_mata_kuliah','$jnis','$sks_tatap_muka','$sks_praktek','$sks_praktek_lapangan','$sks_simulasi','$id_semester','$kode','1','$id_matkul','$id_kurikulum')";
		   
			   if ($koneksi->query($sql) === TRUE) {
				echo "
				<div class='alert alert-success' role='alert'>
				Data berhasil disimpan ke dalam basis data.
				</div>
				<script>
					setTimeout(function() {
						window.location.href = 'index.php?aksi=detailkurikulumdb&id_kurikulum=$id_k&keterangan=$keterangan';
					}, 3000); // Delay 3 detik sebelum mengalihkan
				</script>";
			   } else {
				   echo "Error: " . $sql . "<br>" . $koneksi->error;
			   }
		   } else {
			   echo '
			   <div class="alert alert-danger" role="alert">
			   Data sudah ada dalam basis data, input gagal.
			   </div>';
		   }
		   
		}
	} 

?>

