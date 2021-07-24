<?php
	
	/* FUNGSI PAGINASI PHP SEDERHANA */

	$total_all 	= 500;							// Total semua baris data, data bisa diambil melalui SELECT COUNT(id) FROM table
	$limit 		= 10;							// Jumlah baris data yang ingin ditampilkan per halaman
	$total_page	= ceil($total_all / $limit); 	// Pembulatan bilangan ke atas, misal 9.2 menjadi 10
	$page 		= 3;							// Halaman aktif saat ini, data bisa diambil dari $_GET atau $_POST
	if ($page >= 2) {
		$offset = $limit * $page;				// Offset baris data yang dipanggil, limit baris data x halaman saat ini
	}
	else {
		$offset = 0;							// Nilai offset 0
	}
	$limit_paginasi = 8;						// Batasi jumlah link / button paginasi yang ditampilkan
	$mulai_jalan_page = 3;						// Setelah halaman ini, paginasi yang ditampilkan berjalan
	if ($page <= $mulai_jalan_page) {
		$i_mulai = 1;							// Nomor halaman terendah yang ditampilkan
		$i_sampai = $limit_paginasi;			// Batas nomor halaman yang akan ditampilkan
	}
	else {
		$i_mulai = $page - 2;					// Nomor halaman terendah yang ditampilkan
		$i_sampai = $i_mulai + $limit_paginasi - 1;		// Batas nomor halaman yang akan ditampilkan
		if ($i_sampai >= $total_page) {			// Jika halaman aktif saat ini mendekati halaman terakhir, stop penambahan
			$i_mulai = $total_page - $limit_paginasi;	// Link / button paginasi yang ditampilkan dibalik, dari besar ke kecil
			$i_sampai = $total_page;				// Link / button paginasi urutan terakhir adalah total halaman
		}
	}

	echo 'Sebelumnya &nbsp; ';					// Button halaman sebelumnya, nilai attribute href = $page - 1

	if ($i_mulai > $mulai_jalan_page) {			// Kondisi jika button awal dan button akhir tampil atau sembunyikan
		$batas_awal = TRUE;
		echo '1 &nbsp; ';						// Button halaman awal
		echo '... &nbsp; ';						// Pemisah antara button awal dengan paginasi berupa titik titik
	}

	for ($i_mulai; $i_mulai <= $i_sampai; $i_mulai++) { 
		if ($i_mulai == $page) {
			echo '[' . $i_mulai . ']'. ' &nbsp; '; 	// Bisa ditambah attribute class untuk penandaan css untuk halaman yang aktif
		}
		else {
			echo $i_mulai . ' &nbsp; ';			// Tampilkan link daftar paginasi halaman biasa
		}
	}

	if ($i_sampai < $total_page) {				// Kondisi jika button awal dan button akhir tampil atau sembunyikan
		$batas_akhir = TRUE;
		echo '... &nbsp; ';						// Pemisah antara paginasi dengan button akhir berupa titik titik
		echo $total_page . ' &nbsp; ';			// Button halaman akhir
	}
	
	echo 'Selanjutnya &nbsp; ';					// Button halaman sebelumnya, nilai attribute href = $page + 1

?>

<br /><br />

Output : 

Sebelumnya   1   ...   5   6   [7]   8   9   10   11   12   ...   50   Selanjutnya  
