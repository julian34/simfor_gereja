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
$route['default_controller'] = 'dashboard';



//login
$route['login'] = 'login/Clogin';
$route['proseslogin'] = 'login/Clogin/aksi_login';
$route['logout'] = 'login/Clogin/logout';

//dashboard
$route['dashboard'] = 'dashboard/Cdashboard';

//unsur
$route['unsur'] = 'unsur/Cunsur';
$route['dataunsur'] = 'unsur/Cunsur/get_data';
$route['tambahunsur'] = 'unsur/Cunsur/tambah';
$route['editunsur/(:num)'] = 'unsur/Cunsur/edit/$1';
$route['hapusunsur/(:num)'] = 'unsur/Cunsur/hapus/$1';

//user
$route['user'] = 'user/Cuser';
$route['datauser'] = 'user/Cuser/get_data';
$route['tambahuser'] = 'user/Cuser/tambah';
$route['edituser/(:num)'] = 'user/Cuser/edit/$1';
$route['hapususer/(:num)'] = 'user/Cuser/hapus/$1';

//wijk
$route['wijk'] = 'wijk/Cwijk';
$route['datawijk'] = 'wijk/Cwijk/get_data';
$route['tambahwijk'] = 'wijk/Cwijk/tambah';
$route['editwijk/(:num)'] = 'wijk/Cwijk/edit/$1';
$route['hapuswijk/(:num)'] = 'wijk/Cwijk/hapus/$1';

//ksp
$route['ksp'] = 'ksp/Cksp';
$route['dataksp'] = 'ksp/Cksp/get_data';
$route['tambahksp'] = 'ksp/Cksp/tambah';
$route['editksp/(:num)'] = 'ksp/Cksp/edit/$1';
$route['hapusksp/(:num)'] = 'ksp/Cksp/hapus/$1';

//ruangan
$route['ruangan'] = 'ruangan/Cruangan';
$route['dataruangan'] = 'ruangan/Cruangan/get_data';
$route['tambahruangan'] = 'ruangan/Cruangan/tambah';
$route['editruangan/(:num)'] = 'ruangan/Cruangan/edit/$1';
$route['hapusruangan/(:num)'] = 'ruangan/Cruangan/hapus/$1';

//jenis barang
$route['jenis_barang'] = 'jenis_barang/Cjenis_barang';
$route['datajenis_barang'] = 'jenis_barang/Cjenis_barang/get_data';
$route['tambahjenis_barang'] = 'jenis_barang/Cjenis_barang/tambah';
$route['editjenis_barang/(:num)'] = 'jenis_barang/Cjenis_barang/edit/$1';
$route['hapusjenis_barang/(:num)'] = 'jenis_barang/Cjenis_barang/hapus/$1';

//bahan
$route['bahan'] = 'bahan/Cbahan';
$route['databahan'] = 'bahan/Cbahan/get_data';
$route['tambahbahan'] = 'bahan/Cbahan/tambah';
$route['editbahan/(:num)'] = 'bahan/Cbahan/edit/$1';
$route['hapusbahan/(:num)'] = 'bahan/Cbahan/hapus/$1';

//data_jemaat
$route['data_jemaat'] = 'data_jemaat/Cdata_jemaat';
$route['datadata_jemaat'] = 'data_jemaat/Cdata_jemaat/get_data';
$route['tambahdata_jemaat'] = 'data_jemaat/Cdata_jemaat/tambah';
$route['editdata_jemaat/(:num)'] = 'data_jemaat/Cdata_jemaat/edit/$1';
$route['hapusdata_jemaat/(:num)'] = 'data_jemaat/Cdata_jemaat/hapus/$1';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

