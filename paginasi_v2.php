<!-- Dummy Style Start -->
<style>
	.pagination > li {
		display: inline-flex;
		padding: 5px 10px;
		border: 1px solid gainsboro;
		cursor: pointer;
	}

	.active {
		background-color: #15158c;
		color: white;
	}

	.disabled {
		background-color: #ececec;
		color: gray;
	}

</style>
<!-- Dummy Style End -->

<?php
	
	/* FUNGSI PAGINASI PHP SEDERHANA */

	function paginasi($data) {
		echo '<ul class="pagination">';

		$total_all 	= $data['total_all'];			// Total semua baris data, data bisa diambil melalui SELECT COUNT(id) FROM table
		$limit 		= $data['limit'];				// Jumlah baris data yang ingin ditampilkan per halaman
		$total_page	= ceil($total_all / $limit); 	// Pembulatan bilangan ke atas, misal 9.2 menjadi 10
		$page 		= $data['halaman'];				// Halaman aktif saat ini, data bisa diambil dari $_GET atau $_POST
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
				$i_sampai = $total_page;			// Link / button paginasi urutan terakhir adalah total halaman
			}
		}

		if ($page < 2) {
			echo '<li class="disabled">Sebelumnya</li>';	// Button halaman sebelumnya disabled jika di halaman 1
		}
		else {
			$page_sebelumnya = $page - 1;
			echo '<li onclick="paginasi(' . $page_sebelumnya . ')">Sebelumnya</li>';	// Button halaman sebelumnya, nilai attribute href = $page - 1
		}

		if ($i_mulai > $mulai_jalan_page) {				// Kondisi jika button awal dan button akhir tampil atau sembunyikan
			$batas_awal = TRUE;
			echo '<li onclick="paginasi(1)">1</li>';	// Button halaman awal
			echo '<li>...</li>';						// Pemisah antara button awal dengan paginasi berupa titik titik
		}

		$xy = 1;
		for ($i_mulai; $i_mulai <= $i_sampai; $i_mulai++) { 
			if ($i_mulai == $page) {
				echo '<li class="active" onclick="paginasi(' . $i_mulai . ')">' . $i_mulai . '</li>'; 	// Bisa ditambah attribute class untuk penandaan css untuk halaman yang aktif
			}
			else {
				echo '<li onclick="paginasi(' . $i_mulai . ')">' . $i_mulai . '</li>';	// Tampilkan link daftar paginasi halaman biasa
			}
		}

		if ($i_sampai < $total_page) {				// Kondisi jika button awal dan button akhir tampil atau sembunyikan
			$batas_akhir = TRUE;
			echo '<li>...</li>';					// Pemisah antara paginasi dengan button akhir berupa titik titik
			echo '<li onclick="paginasi(' . $total_page . ')">' . $total_page . '</li>';	// Button halaman akhir
		}

		if ($i_sampai == $total_page) {
			echo '<li class="disabled">Selanjutnya</li>';	// Button halaman selanjutnya, disabled ketika di terakhir
		}
		else {
			$page_selanjutnya = $page + 1;
			echo '<li onclick="paginasi(' . $page_selanjutnya . ')">Selanjutnya</li>';	// Button halaman sebelumnya, nilai attribute href = $page + 1
		}

		echo '</ul>';
	}

	// Mendapatkan URL parameter lengkap
	function getFullUrlParameters() {
	    $url = $_SERVER["REQUEST_URI"];
	    $parsed_url = parse_url($url);
	    $query = $parsed_url["query"];
	  
	    $params = array();
	    if ($query) {
	        parse_str($query, $params);
	    }
	  
	    return $params;
	}

	$halaman  	= (@$_GET['halaman'] && is_numeric(@$_GET['halaman'])) ? @$_GET['halaman'] : 1;
	$keywords 	= ''; 	// Opsional jika menggunakan query pencarian data
	
	$data_paginasi = [
		'total_all'	 => 1000,
		'limit'		 => 50,
		'halaman'	 => $halaman, 	// GET ?halaman=
		'url_params' => '', 		// Opsional
	];

	paginasi($data_paginasi);

?>

<script>
	function paginasi(fnumber) {
		var url_params = "http://localhost/draft/paginasi.php?halaman=" + fnumber;
		window.location.href = url_params;
	}
</script>
