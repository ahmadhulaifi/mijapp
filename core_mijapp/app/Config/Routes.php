<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('backend/Login');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'backend/Login::index');
$routes->get('/login', 'backend/Login::index');
$routes->get('/loginadmin', 'backend/Login::index');
$routes->post('/ceklogin', 'backend/login::ceklogin');
$routes->post('/backend/login/ceklogin', 'backend/login::ceklogin');
$routes->post('/backend/login/ceklogin', 'backend/login::ceklogin');
$routes->get('/logout', 'backend/login::logout');
$routes->get('/backend/login/logout', 'backend/login::logout');

$routes->get('/block', 'backend/login::block');
$routes->get('/backend/login/block', 'backend/login::block');

$routes->get('/dashboard', 'backend/dashboard::index', ['filter' => 'akseslogin']);
$routes->get('/backend/dashboard', 'backend/dashboard::index', ['filter' => 'akseslogin']);

$routes->get('/menu', 'backend/menu::index', ['filter' => 'akseslogin']);
$routes->get('/backend/menu', 'backend/menu::index', ['filter' => 'akseslogin']);
$routes->post('/menu/fetchmenu', 'backend/menu::fetchmenu', ['filter' => 'akseslogin']);
$routes->post('/backend/menu/fetchmenu', 'backend/menu::fetchmenu', ['filter' => 'akseslogin']);


$routes->post('/menu/savemenu', 'backend\menu::savemenu', ['filter' => 'akseslogin']);
$routes->post('/backend/menu/savemenu', 'backend\menu::savemenu', ['filter' => 'akseslogin']);
$routes->post('/menu/edit', 'backend\menu::edit', ['filter' => 'akseslogin']);
$routes->post('/backend/menu/edit', 'backend\menu::edit', ['filter' => 'akseslogin']);

$routes->post('/menu/editmenu', 'backend\menu::editmenu', ['filter' => 'akseslogin']);
$routes->post('/backend/menu/editmenu', 'backend\menu::editmenu', ['filter' => 'akseslogin']);
$routes->delete('/backend/menu/deletemenu/(:num)', 'backend\menu::deletemenu/$1', ['filter' => 'akseslogin']);
$routes->delete('/menu/deletemenu/(:num)', 'backend\menu::deletemenu/$1', ['filter' => 'akseslogin']);

$routes->get('/menu/submenu', 'backend/menu::submenu', ['filter' => 'akseslogin']);
$routes->get('/backend/menu/submenu', 'backend/menu::submenu', ['filter' => 'akseslogin']);
$routes->post('/menu/fetchsubmenu', 'backend/menu::fetchsubmenu', ['filter' => 'akseslogin']);
$routes->post('/backend/menu/fetchsubmenu', 'backend/menu::fetchsubmenu', ['filter' => 'akseslogin']);

$routes->post('/menu/savesubmenu', 'backend/menu::savesubmenu', ['filter' => 'akseslogin']);
$routes->post('/backend/menu/savesubmenu', 'backend/menu::savesubmenu', ['filter' => 'akseslogin']);

$routes->post('/menu/editsub', 'backend\menu::editsub', ['filter' => 'akseslogin']);
$routes->post('/backend/menu/editsub', 'backend\menu::editsub', ['filter' => 'akseslogin']);
$routes->post('/menu/editsubmenu', 'backend\menu::editsubmenu', ['filter' => 'akseslogin']);
$routes->post('/backend/menu/editsubmenu', 'backend\menu::editsubmenu', ['filter' => 'akseslogin']);

$routes->delete('/backend/menu/deletesubmenu/(:num)', 'backend\menu::deletesubmenu/$1', ['filter' => 'akseslogin']);
$routes->delete('/menu/deletesubmenu/(:num)', 'backend\menu::deletesubmenu/$1', ['filter' => 'akseslogin']);

$routes->get('/role', 'backend/role::index', ['filter' => 'akseslogin']);
$routes->get('/backend/role', 'backend/role::index', ['filter' => 'akseslogin']);
$routes->post('/role/fetchrole', 'backend/role::fetchrole', ['filter' => 'akseslogin']);
$routes->post('/backend/role/fetchrole', 'backend/role::fetchrole', ['filter' => 'akseslogin']);
$routes->post('/role/saverole', 'backend/role::saverole', ['filter' => 'akseslogin']);
$routes->post('/backend/role/saverole', 'backend/role::saverole', ['filter' => 'akseslogin']);
$routes->post('/role/edit', 'backend/role::edit', ['filter' => 'akseslogin']);
$routes->post('/backend/role/edit', 'backend/role::edit', ['filter' => 'akseslogin']);
$routes->post('/role/editrole', 'backend\role::editrole', ['filter' => 'akseslogin']);
$routes->post('/backend/role/editrole', 'backend\role::editrole', ['filter' => 'akseslogin']);
$routes->delete('/backend/role/deleterole/(:num)', 'backend\role::deleterole/$1', ['filter' => 'akseslogin']);
$routes->delete('/role/deleterole/(:num)', 'backend\role::deleterole/$1', ['filter' => 'akseslogin']);

$routes->get('/role/roleakses/(:any)', 'backend\role::roleakses/$1', ['filter' => 'akseslogin']);
$routes->get('/backend/role/roleakses/(:any)', 'backend\role::roleakses/$1', ['filter' => 'akseslogin']);
$routes->post('/role/gantiakses', 'backend\role::gantiakses', ['filter' => 'akseslogin']);
$routes->post('/backend/role/gantiakses', 'backend\role::gantiakses', ['filter' => 'akseslogin']);

$routes->get('/profil', 'backend/profil::index', ['filter' => 'akseslogin']);
$routes->get('/backend/profil', 'backend/profil::index', ['filter' => 'akseslogin']);
$routes->get('/profil/editprofil/(:num)', 'backend\profil::editprofil/$1', ['filter' => 'akseslogin']);
$routes->get('/backend/profil/editprofil/(:num)', 'backend\profil::editprofil/$1', ['filter' => 'akseslogin']);
$routes->post('/profil/editpassword', 'backend\profil::editpassword', ['filter' => 'akseslogin']);
$routes->post('/backend/profil/editpassword', 'backend\profil::editpassword', ['filter' => 'akseslogin']);
$routes->post('/profil/updateprofil', 'backend\profil::updateprofil', ['filter' => 'akseslogin']);
$routes->post('/backend/profil/updateprofil', 'backend\profil::updateprofil', ['filter' => 'akseslogin']);


$routes->get('/datasekolah/divisi', 'backend/datasekolah::divisi', ['filter' => 'akseslogin']);
$routes->get('/backend/datasekolah/divisi', 'backend/datasekolah::divisi', ['filter' => 'akseslogin']);
$routes->post('/datasekolah/fetchdivisi', 'backend/datasekolah::fetchdivisi', ['filter' => 'akseslogin']);
$routes->post('/backend/datasekolah/fetchdivisi', 'backend/datasekolah::fetchdivisi', ['filter' => 'akseslogin']);
$routes->post('/datasekolah/savedivisi', 'backend/datasekolah::savedivisi', ['filter' => 'akseslogin']);
$routes->post('/backend/datasekolah/savedivisi', 'backend/datasekolah::savedivisi', ['filter' => 'akseslogin']);
$routes->delete('/backend/datasekolah/deletedivisi/(:num)', 'backend\datasekolah::deletedivisi/$1', ['filter' => 'akseslogin']);
$routes->delete('/datasekolah/deletedivisi/(:num)', 'backend\datasekolah::deletedivisi/$1', ['filter' => 'akseslogin']);
$routes->post('/datasekolah/editdivisimodal', 'backend\datasekolah::editdivisimodal', ['filter' => 'akseslogin']);
$routes->post('/backend/datasekolah/editdivisimodal', 'backend\datasekolah::editdivisimodal', ['filter' => 'akseslogin']);
$routes->post('/datasekolah/editdivisi', 'backend\datasekolah::editdivisi', ['filter' => 'akseslogin']);
$routes->post('/backend/datasekolah/editdivisi', 'backend\datasekolah::editdivisi', ['filter' => 'akseslogin']);

$routes->get('/datasekolah/jabatan', 'backend/datasekolah::jabatan', ['filter' => 'akseslogin']);
$routes->get('/backend/datasekolah/jabatan', 'backend/datasekolah::jabatan', ['filter' => 'akseslogin']);
$routes->post('/datasekolah/fetchjabatan', 'backend/datasekolah::fetchjabatan', ['filter' => 'akseslogin']);
$routes->post('/backend/datasekolah/fetchjabatan', 'backend/datasekolah::fetchjabatan', ['filter' => 'akseslogin']);
$routes->post('/datasekolah/savejabatan', 'backend/datasekolah::savejabatan', ['filter' => 'akseslogin']);
$routes->post('/backend/datasekolah/savejabatan', 'backend/datasekolah::savejabatan', ['filter' => 'akseslogin']);
$routes->delete('/backend/datasekolah/deletejabatan/(:num)', 'backend\datasekolah::deletejabatan/$1', ['filter' => 'akseslogin']);
$routes->delete('/datasekolah/deletejabatan/(:num)', 'backend\datasekolah::deletejabatan/$1', ['filter' => 'akseslogin']);
$routes->post('/datasekolah/editjabatanmodal', 'backend\datasekolah::editjabatanmodal', ['filter' => 'akseslogin']);
$routes->post('/backend/datasekolah/editjabatanmodal', 'backend\datasekolah::editjabatanmodal', ['filter' => 'akseslogin']);
$routes->post('/datasekolah/editjabatan', 'backend\datasekolah::editjabatan', ['filter' => 'akseslogin']);
$routes->post('/backend/datasekolah/editjabatan', 'backend\datasekolah::editjabatan', ['filter' => 'akseslogin']);

$routes->get('/datasekolah/statuspegawai', 'backend/datasekolah::statuspegawai', ['filter' => 'akseslogin']);
$routes->get('/backend/datasekolah/statuspegawai', 'backend/datasekolah::statuspegawai', ['filter' => 'akseslogin']);
$routes->post('/datasekolah/fetchstatuspegawai', 'backend/datasekolah::fetchstatuspegawai', ['filter' => 'akseslogin']);
$routes->post('/backend/datasekolah/fetchstatuspegawai', 'backend/datasekolah::fetchstatuspegawai', ['filter' => 'akseslogin']);
$routes->post('/datasekolah/savestatuspegawai', 'backend/datasekolah::savestatuspegawai', ['filter' => 'akseslogin']);
$routes->post('/backend/datasekolah/savestatuspegawai', 'backend/datasekolah::savestatuspegawai', ['filter' => 'akseslogin']);
$routes->delete('/backend/datasekolah/deletestatuspegawai/(:num)', 'backend\datasekolah::deletestatuspegawai/$1', ['filter' => 'akseslogin']);
$routes->delete('/datasekolah/deletestatuspegawai/(:num)', 'backend\datasekolah::deletestatuspegawai/$1', ['filter' => 'akseslogin']);
$routes->post('/datasekolah/editstatuspegawaimodal', 'backend\datasekolah::editstatuspegawaimodal', ['filter' => 'akseslogin']);
$routes->post('/backend/datasekolah/editstatuspegawaimodal', 'backend\datasekolah::editstatuspegawaimodal', ['filter' => 'akseslogin']);
$routes->post('/datasekolah/editstatuspegawai', 'backend\datasekolah::editstatuspegawai', ['filter' => 'akseslogin']);
$routes->post('/backend/datasekolah/editstatuspegawai', 'backend\datasekolah::editstatuspegawai', ['filter' => 'akseslogin']);


$routes->get('/pegawai', 'backend/pegawai::index', ['filter' => 'akseslogin']);
$routes->get('/backend/pegawai', 'backend/pegawai::index', ['filter' => 'akseslogin']);
$routes->get('/pegawai/formtambah', 'backend/pegawai::formtambah', ['filter' => 'akseslogin']);
$routes->get('/backend/pegawai/formtambah', 'backend/pegawai::formtambah', ['filter' => 'akseslogin']);
$routes->post('/pegawai/fetchpegawai', 'backend/pegawai::fetchpegawai', ['filter' => 'akseslogin']);
$routes->post('/backend/pegawai/fetchpegawai', 'backend/pegawai::fetchpegawai', ['filter' => 'akseslogin']);
$routes->post('/pegawai/tambahpegawai', 'backend/pegawai::tambahpegawai', ['filter' => 'akseslogin']);
$routes->post('/backend/pegawai/tambahpegawai', 'backend/pegawai::tambahpegawai', ['filter' => 'akseslogin']);
$routes->get('/pegawai/editformpegawai/(:num)', 'backend\pegawai::editformpegawai/$1', ['filter' => 'akseslogin']);
$routes->get('/backend/pegawai/editformpegawai/(:num)', 'backend\pegawai::editformpegawai/$1', ['filter' => 'akseslogin']);
$routes->post('/pegawai/editpegawai', 'backend/pegawai::editpegawai', ['filter' => 'akseslogin']);
$routes->post('/backend/pegawai/editpegawai', 'backend/pegawai::editpegawai', ['filter' => 'akseslogin']);
$routes->post('/pegawai/editpasswordpegawai', 'backend/pegawai::editpasswordpegawai', ['filter' => 'akseslogin']);
$routes->post('/backend/pegawai/editpasswordpegawai', 'backend/pegawai::editpasswordpegawai', ['filter' => 'akseslogin']);


/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
