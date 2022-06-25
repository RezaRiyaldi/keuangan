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
|	https://codeigniter.com/userguide3/general/routing.html
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
$route['default_controller'] = 'Welcome';
$route['404_override'] = 'Welcome/not_found';
$route['403'] = 'Welcome/forbidden';
$route['translate_uri_dashes'] = FALSE;

// Auth
$route['user/login'] = 'Auth/login';
$route['user/logout'] = 'Auth/logout';

// User
$route['setting-profile'] = 'Auth/setting_profile';
$route['user-manage'] = 'Admin/user_manage';
$route['list-users'] = 'Admin/list_users';
$route['user/tambah-user'] = 'Admin/tambah_user';
$route['user/edit-user/(:any)'] = 'Admin/edit_user/$1';
$route['user/delete-user/(:any)'] = 'Admin/delete_user/$1';

// Parkir
$route['parkir-manage'] = 'Parkir/parkir_manage';
$route['parkir/tambah-parkir'] = 'Parkir/tambah_parkir';
$route['parkir/selesai/(:any)'] = 'Parkir/selesai/$1';

// Jenis Kendaraan
$route['jenis-kendaraan-manage'] = 'Parkir/jenis_kendaraan_manage';
$route['parkir/tambah-jenis-kendaraan'] = 'Parkir/tambah_jenis_kendaraan';
$route['parkir/edit-jenis-kendaraan/(:any)'] = 'Parkir/edit_jenis_kendaraan/$1';
$route['parkir/delete-jenis-kendaraan/(:any)'] = 'Parkir/delete_jenis_kendaraan/$1';
