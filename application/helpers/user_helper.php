<?php

	function isadmin() {
		$ci = get_instance();
		$level = $ci->session->userdata('level');
		if ($level != 'ADMIN') {
			redirect('auth');
		}
	}

	function ispegawai() {
		$ci = get_instance();
		$level = $ci->session->userdata('level');
		if ($level != 'PEGAWAI') {
			redirect('auth');
		}
	}