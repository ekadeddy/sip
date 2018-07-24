<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
//admin
$route['admin/dashboard'] = 'admin';
$route['admin/manage/jadwal/add'] = 'admin/manageJadwalKuliahDashboard';
$route['admin/manage/jadwal/edit'] = 'admin/manageEditJadwal';
$route['admin/manage-jadwal/(:any)'] = 'admin/manageJadwalKuliah/$1';
$route['admin/edit-jadwal/(:any)/(:any)'] = 'admin/manageJadwalKuliahEdit/$1/$2';
$route['admin/ajax_edit'] = 'admin/ajax_edit_manageJadwalKuliah';
$route['admin/save-jadwal'] = 'admin/manageJadwalKuliahSave';
$route['admin/manage/kalender'] = 'admin/manageKalenderAkademik';
$route['admin/manage/event'] = 'admin/manageEventPcr';
$route['admin/approval'] = 'admin/approvalGantiJadwal';
$route['admin/save-approval'] = 'admin/approvalSave';
$route['admin/ajax-approval'] = 'admin/ajaxApproval';
$route['admin/save-edit'] = 'admin/saveEditJadwal';
$route['admin/ajax_edit_jadwal'] = 'admin/ajax_edit_jadwal';




//kalender
$route['admin-kalender'] = 'admin/kalender';


//dosen
$route['dosen/dashboard'] = 'dosen';
$route['dosen/jadwal-kuliah'] = 'dosen/jadwalMataKuliah';
$route['dosen/jadwal-ubah'] = 'dosen/ubahJadwalKuliah';
$route['dosen/ajax_dosen_ubah'] = 'dosen/ajax_get_mk_by_dosen_to_kelas';
$route['dosen/kalender-akademik'] = 'dosen/kalenderAkademik';
$route['dosen/event-pcr'] = 'dosen/eventPcr';
$route['dosen/save-perubahan-jadwal'] = 'dosen/simpanJadwalPerubahan';





//mahasiswa
$route['mahasiswa/dashboard'] = 'mahasiswa';
$route['mahasiswa/jadwal'] = 'mahasiswa/jadwalMataKuliah';
$route['mahasiswa/jadwal/perubahan'] = 'mahasiswa/jadwalPerubahan';
$route['mahasiswa/kalender'] = 'mahasiswa/kalenderAkademik';
$route['mahasiswa/event'] = 'mahasiswa/eventPcr';
$route['mahasiswa/jadwal/perubahan/detail'] = 'mahasiswa/jadwalPerubahanDetail';




//profil
$route['mahasiswa/profil'] = 'profil';
$route['dosen/profil'] = 'profil';
$route['admin/profil'] = 'profil';
$route['profil/edit'] = 'profil/updateProfil';
$route['profil/edit/save'] = 'profil/updateProfilSave';

//notif
$route['notif/read'] = 'notif/readNotif';
$route['notif/detail'] = 'notif/notifDetail';
$route['jadwal/ganti/list'] = 'notif/listPerubahanJadwal';





$route['default_controller'] = 'Login';
$route['logout'] = 'Login/logout';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
