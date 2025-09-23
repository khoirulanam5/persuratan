<?php

	function do_formal_date($date='',$delimiter = '',$is_day=false) {
		if (empty($date)) {
			$date = date('d M Y');
		}
			if (!empty($date)) {
				$day = '';
				if ($is_day) 
				{
					$days = ['Saturday' => 'Sabtu',
							'Sunday' 	=> 'Minggu', 
							'Monday' 	=> 'Senin', 
							'Tuesday'  => 'Selasa', 
							'Wednesday'=> 'Rabu', 
							'Thursday' => 'Kamis',
							'Friday' 	=> 'Jum\'at'];
					$day = $days[date('l', strtotime($date))].', ';
				}
				$months =['','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
				$d = date('d', strtotime($date));
				$m = date('m', strtotime($date));
				$y = date('Y', strtotime($date));

				$delimiter = !empty($delimiter) ? $delimiter : ' ';
				return $day.$d.$delimiter.$months[intval($m)].$delimiter.$y;
			}
		}
	
	function do_formal_month($m) {
		switch($m){
	 
			case '1':			
				$bulan = "Bulan Januari";
			break;
	 
			case '2':
				$bulan = "Bulan Februari";
			break;
	 
			case '3':
				$bulan = "Bulan Maret";
			break;
	 
			case '4':
				$bulan = "Bulan April";
			break;
	 
			case '5':
				$bulan = "Bulan Mei";
			break;
	 
			case '6':
				$bulan = "Bulan Juni";
			break;
			
			case '7':
				$bulan = "Bulan Juli";
			break;
	 
			case '8':
				$bulan = "Bulan Agustus";
			break;
	 
			case '9':
				$bulan = "Bulan September";
			break;

			case '10':
				$bulan = "Bulan Oktober";
			break;

			case '11':
				$bulan = "Bulan November";
			break;

			case '12':
				$bulan = "Bulan Desember";
			break;

			default:
				$bulan = "Seluruh Bulan";		
			break;
		}
	 
		return $bulan; 
	}

	function do_formal_day($day) {
		switch($day){
			case '7':
				$hari = "Minggu";
			break;
	 
			case '1':			
				$hari = "Senin";
			break;
	 
			case '2':
				$hari = "Selasa";
			break;
	 
			case '3':
				$hari = "Rabu";
			break;
	 
			case '4':
				$hari = "Kamis";
			break;
	 
			case '5':
				$hari = "Jumat";
			break;
	 
			case '6':
				$hari = "Sabtu";
			break;
			
			default:
				$hari = "Tidak di ketahui";		
			break;
		}
	 
		return $hari;
	}

	function umur($date) {
		$birthDate = new DateTime($date);
		$today = new DateTime("today");
		if ($birthDate > $today) { 
		    exit("0 tahun 0 bulan 0 hari");
		}
		$y = $today->diff($birthDate)->y;
		$m = $today->diff($birthDate)->m;
		$d = $today->diff($birthDate)->d;
		return $y;
	}

	function predikat($data) {
		if ($data >= 88 || $data == 100) {
			$predikat = 'A';
		}elseif ($data >= 74 || $data == 87) {
			$predikat = 'B';
			
		}elseif ($data >= 60 || $data == 73) {
			$predikat = 'C';
			
		}else {
			$predikat = 'D';
			
		}
		return $predikat;
	}
