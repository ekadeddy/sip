<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


    if ( ! function_exists('HGetProfilPath')) {
        function HGetProfilPath($userAkses)
        {
        	if ($userAkses == 'adm')
			{
				$path=base_url('admin/profil');
			}
			else if ($userAkses == 'mhs')
			{
				$path=base_url('mahasiswa/profil');
			}
			else
			{
				$path=base_url('dosen/profil');
			}

            return $path;
        }
    }

if ( ! function_exists('HGetNavbarUser')) {
	function HGetNavbarUser($userAkses)
	{
		if ($userAkses == 'Admin')
		{
			$path='layout/admin/navbar_admin_view';
		}
		else if ($userAkses == 'Mahasiswa')
		{
			$path='layout/mahasiswa/navbar_mahasiswa_view';
		}
		else
		{
			$path='layout/dosen/navbar_dosen_view';
		}

		return $path;
	}
}


if ( ! function_exists('HGetRedirectProfil')) {
	function HGetRedirectProfil($userAkses)
	{
		if ($userAkses == 'adm')
		{
			redirect('admin/profil', 'refresh');
		}
		else if ($userAkses == 'mhs')
		{
			redirect('mahasiswa/profil', 'refresh');
		}
		else
		{
			redirect('dosen/profil', 'refresh');
		}

	}
}

if ( ! function_exists('HGetAksesProfil')) {
	function HGetAksesProfil($userAkses)
	{
		if ($userAkses == 'adm')
		{
			return 'Admin';
		}
		else if ($userAkses == 'mhs')
		{
			return 'Mahasiswa';
		}
		elseif($userAkses == 'dsn')
		{
			return 'Dosen';
		}

	}
}
