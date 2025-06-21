<?php

use Illuminate\Support\Facades\Hash;
use App\Models\TahapanPendaftaran;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Kontak;

if(!function_exists('getTitle')){
	function getTitle(){
		return 'L|KITA Bengkalis - Lembaga Kreasi Teknologi Informasi Anak Bengkalis';
	}
}

if(!function_exists('buatHash')){
	function buatHash($string)
	{
	    dd(Hash::make($string));
	}
}

if(!function_exists('tanggalIndonesia')){
	function tanggalIndonesia($tanggal, $denganHari = false)
    {
        $namaHari = [
            'Sunday' => 'Minggu',
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu'
        ];

        $namaBulan = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];

        $tanggal = strtotime($tanggal);
        $hari = $namaHari[date('l', $tanggal)];
        $tanggalAngka = date('j', $tanggal);
        $bulan = $namaBulan[(int)date('n', $tanggal)];
        $tahun = date('Y', $tanggal);

        if ($denganHari) {
            return $hari . ', ' . $tanggalAngka . ' ' . $bulan . ' ' . $tahun;
        }

        return $tanggalAngka . ' ' . $bulan . ' ' . $tahun;
    }
}

if(!function_exists('bulanIndonesia')){
	function bulanIndonesia($tanggal)
    {
        $namaBulan = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];

        $tanggal = strtotime($tanggal);
        $bulan = $namaBulan[(int)date('n', $tanggal)];
        $tahun = date('Y', $tanggal);

        return $bulan . ' ' . $tahun;
    }
}

if(!function_exists('paginateRender')){
	function paginateRender($total_data)
	{
		$data = array();
		$results_per_page = 25; // 10;
		$cari = null;
		$render = null;
		$custom_param = null; // Tambahkan parameter custom

		// Ambil nilai dari parameter custom dari URL
		foreach ($_GET as $key => $value) {
			if ($key !== 'page' && $key !== 'cari') {
				$custom_param .= '&' . $key . '=' . $value;
			}
		}

		if (isset($_GET["page"])) {
			$page = $_GET["page"];
		} else {
			$page = 1;
		}
		;
		$start_from = ($page - 1) * $results_per_page;

		$cari = empty($_GET['cari']) ? null : $_GET['cari'];
		$render .= '<ul class="pagination">';
		//LINK FIRST AND PREV

		if ($page == 1) { // Jika page adalah page ke 1, maka disable link PREV

			$render .= '
			<li class="page-item disabled">
				<a class="page-link" href="javascript:;" aria-label="First">
					<span aria-hidden="true">First</span>
					<span class="sr-only">First</span>
				</a>
			</li>';
		} else { // Jika page bukan page ke 1
			$link_prev = ($page > 1) ? $page - 1 : 1;

			$render .= '
			<li class="page-item">
				<a class="page-link" href="?page=1&cari=' . $cari . $custom_param . '" aria-label="First">
					<span aria-hidden="true">First</span>
					<span class="sr-only">First</span>
				</a>
			</li>
			<li class="page-item">
				<a class="page-link" href="?page=' . $link_prev . '&cari=' . $cari . $custom_param . '" aria-label="Prev">
					<span aria-hidden="true">&laquo;</span>
					<span class="sr-only">Prev</span>
				</a>
			</li>';
		}
		// LINK NUMBER					
		$jumlah_page = ceil($total_data / $results_per_page); // Hitung jumlah halamannya
		$jumlah_number = 1; // Tentukan jumlah link number sebelum dan sesudah page yang aktif
		$start_number = ($page > $jumlah_number) ? $page - $jumlah_number : 1; // Untuk awal link number
		$end_number = ($page < ($jumlah_page - $jumlah_number)) ? $page + $jumlah_number : $jumlah_page; // Untuk akhir link number

		for ($i = $start_number; $i <= $end_number; $i++) {
			$link_active = ($page == $i) ? ' class="page-item active"' : 'class="page-item"';

			$render .= '
			<li ' . $link_active . '><a class="page-link" href="?page=' . $i . '&cari=' . $cari . $custom_param . '">' . $i . '</a></li>';

		}

		// LINK NEXT AND LAST
		// Jika page sama dengan jumlah page, maka disable link NEXT nya
		// Artinya page tersebut adalah page terakhir 
		if ($page == $jumlah_page) { // Jika page terakhir

			$render .= '
			<li class="page-item disabled">
				<a class="page-link" href="javascript:;" aria-label="Next">
					<span aria-hidden="true">Last</span>
					<span class="sr-only">Next</span>
				</a>
			</li>
			';

		} else { // Jika Bukan page terakhir
			$link_next = ($page < $jumlah_page) ? $page + 1 : $jumlah_page;

			$render .= '
			<li class="page-item">
				<a class="page-link" href="?page=' . $link_next . '&cari=' . $cari . $custom_param . '" aria-label="Next">
					<span aria-hidden="true">&raquo;</span>
					<span class="sr-only">Next</span>
				</a>
			</li>
			<li class="page-item">
				<a class="page-link" href="?page=' . $jumlah_page . '&cari=' . $cari . $custom_param . '" aria-label="Last">
					<span aria-hidden="true">Last</span>
					<span class="sr-only">Last</span>
				</a>
			</li>
			';
		}

		$render .= '</ul>';

		$data = new \stdClass();
		$data->cari = $cari;
		$data->render = $render;
		$data->offset = $start_from;
		$data->limit = $results_per_page;
		$data->jumlah_page = $jumlah_page;
		return $data;
	}
}

if(!function_exists('highlight')){
	function highlight($text, $search) {
		$highlighted = preg_replace('/' . preg_quote($search, '/') . '/i', '<span style="background-color: yellow">$0</span>', $text);
		return $highlighted;
	}
}

if(!function_exists('formatSizeUnits')){
	function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
    }
}


if(!function_exists('haversineGreatCircleDistance')){
	function haversineGreatCircleDistance($lat1, $lon1, $lat2, $lon2) {
		$earthRadius = 6371; // Earth's radius in km

		$dLat = deg2rad((float)$lat2) - deg2rad((float)$lat1);
		$dLon = deg2rad((float)$lon2) - deg2rad((float)$lon1);

		$a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad((float)$lat1)) * cos(deg2rad((float)$lat2)) * sin($dLon / 2) * sin($dLon / 2);
		$c = 2 * asin(sqrt($a));

		$distance = $earthRadius * $c * 1000; // Convert to meters

		return $distance;
	}
}

if(!function_exists('getKontak')){
    function getKontak(){
        $data_kontak = Kontak::where('id_kontak', '1')
                                ->first();
        return $data_kontak;
    }
}

if(!function_exists('generateSlug')){
    function generateSlug($title)
    {
        // Ubah judul menjadi huruf kecil
        $slug = strtolower($title);

        // Ganti semua spasi dan karakter khusus dengan tanda hubung
        $slug = preg_replace('/[^a-z0-9]+/i', '-', trim($slug));

        // Hapus tanda hubung di awal dan akhir
        $slug = trim($slug, '-');

        return $slug;
    }
}

if(!function_exists('getExcerpt')){
    function getExcerpt($text, $wordLimit = 30)
    {
        $words = explode(' ', $text);

        if (count($words) <= $wordLimit) {
            return $text;
        }

        return implode(' ', array_slice($words, 0, $wordLimit)) . '...';
    }
}


