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
$routes->post('/ceklogin', 'backend/Login::ceklogin');
$routes->post('/backend/login/ceklogin', 'backend/Login::ceklogin');
$routes->post('/backend/login/ceklogin', 'backend/Login::ceklogin');
$routes->get('/logout', 'backend/Login::logout');
$routes->get('/backend/login/logout', 'backend/Login::logout');

$routes->get('/block', 'backend/Login::block');
$routes->get('/backend/login/block', 'backend/Login::block');

$routes->get('/dashboard', 'backend/Dashboard::index', ['filter' => 'akseslogin']);
$routes->get('/backend/dashboard', 'backend/Dashboard::index', ['filter' => 'akseslogin']);

$routes->get('/menu', 'backend/Menu::index', ['filter' => 'akseslogin']);
$routes->get('/backend/menu', 'backend/Menu::index', ['filter' => 'akseslogin']);
$routes->post('/menu/fetchmenu', 'backend/Menu::fetchmenu', ['filter' => 'akseslogin']);
$routes->post('/backend/menu/fetchmenu', 'backend/Menu::fetchmenu', ['filter' => 'akseslogin']);


$routes->post('/menu/savemenu', 'backend\Menu::savemenu', ['filter' => 'akseslogin']);
$routes->post('/backend/menu/savemenu', 'backend\Menu::savemenu', ['filter' => 'akseslogin']);
$routes->post('/menu/edit', 'backend\Menu::edit', ['filter' => 'akseslogin']);
$routes->post('/backend/menu/edit', 'backend\Menu::edit', ['filter' => 'akseslogin']);

$routes->post('/menu/editmenu', 'backend\Menu::editmenu', ['filter' => 'akseslogin']);
$routes->post('/backend/menu/editmenu', 'backend\Menu::editmenu', ['filter' => 'akseslogin']);
$routes->delete('/backend/menu/deletemenu/(:num)', 'backend\Menu::deletemenu/$1', ['filter' => 'akseslogin']);
$routes->delete('/menu/deletemenu/(:num)', 'backend\Menu::deletemenu/$1', ['filter' => 'akseslogin']);

$routes->get('/menu/submenu', 'backend/Menu::submenu', ['filter' => 'akseslogin']);
$routes->get('/backend/menu/submenu', 'backend/Menu::submenu', ['filter' => 'akseslogin']);
$routes->post('/menu/fetchsubmenu', 'backend/Menu::fetchsubmenu', ['filter' => 'akseslogin']);
$routes->post('/backend/menu/fetchsubmenu', 'backend/Menu::fetchsubmenu', ['filter' => 'akseslogin']);

$routes->post('/menu/savesubmenu', 'backend/Menu::savesubmenu', ['filter' => 'akseslogin']);
$routes->post('/backend/menu/savesubmenu', 'backend/Menu::savesubmenu', ['filter' => 'akseslogin']);

$routes->post('/menu/editsub', 'backend\Menu::editsub', ['filter' => 'akseslogin']);
$routes->post('/backend/menu/editsub', 'backend\Menu::editsub', ['filter' => 'akseslogin']);
$routes->post('/menu/editsubmenu', 'backend\Menu::editsubmenu', ['filter' => 'akseslogin']);
$routes->post('/backend/menu/editsubmenu', 'backend\Menu::editsubmenu', ['filter' => 'akseslogin']);

$routes->delete('/backend/menu/deletesubmenu/(:num)', 'backend\Menu::deletesubmenu/$1', ['filter' => 'akseslogin']);
$routes->delete('/menu/deletesubmenu/(:num)', 'backend\Menu::deletesubmenu/$1', ['filter' => 'akseslogin']);

$routes->get('/role', 'backend/Role::index', ['filter' => 'akseslogin']);
$routes->get('/backend/role', 'backend/Role::index', ['filter' => 'akseslogin']);
$routes->post('/role/fetchrole', 'backend/Role::fetchrole', ['filter' => 'akseslogin']);
$routes->post('/backend/role/fetchrole', 'backend/Role::fetchrole', ['filter' => 'akseslogin']);
$routes->post('/role/saverole', 'backend/Role::saverole', ['filter' => 'akseslogin']);
$routes->post('/backend/role/saverole', 'backend/Role::saverole', ['filter' => 'akseslogin']);
$routes->post('/role/edit', 'backend/Role::edit', ['filter' => 'akseslogin']);
$routes->post('/backend/role/edit', 'backend/Role::edit', ['filter' => 'akseslogin']);
$routes->post('/role/editrole', 'backend\Role::editrole', ['filter' => 'akseslogin']);
$routes->post('/backend/role/editrole', 'backend\Role::editrole', ['filter' => 'akseslogin']);
$routes->delete('/backend/role/deleterole/(:num)', 'backend\Role::deleterole/$1', ['filter' => 'akseslogin']);
$routes->delete('/role/deleterole/(:num)', 'backend\Role::deleterole/$1', ['filter' => 'akseslogin']);
$routes->get('/role/roleakses/(:any)', 'backend\Role::roleakses/$1', ['filter' => 'akseslogin']);
$routes->get('/backend/role/roleakses/(:any)', 'backend\Role::roleakses/$1', ['filter' => 'akseslogin']);
$routes->post('/role/gantiakses', 'backend\Role::gantiakses', ['filter' => 'akseslogin']);
$routes->post('/backend/role/gantiakses', 'backend\Role::gantiakses', ['filter' => 'akseslogin']);
$routes->get('/role/userrole', 'backend\Role::userrole', ['filter' => 'akseslogin']);
$routes->get('/backend/role/userrole', 'backend\Role::userrole', ['filter' => 'akseslogin']);
$routes->post('/role/fetchrolesemuapegawai', 'backend\Role::fetchrolesemuapegawai', ['filter' => 'akseslogin']);
$routes->post('/backend/role/fetchrolesemuapegawai', 'backend\Role::fetchrolesemuapegawai', ['filter' => 'akseslogin']);
$routes->post('/role/fetchfilterrolepegawai', 'backend\Role::fetchfilterrolepegawai', ['filter' => 'akseslogin']);
$routes->post('/backend/role/fetchfilterrolepegawai', 'backend\Role::fetchfilterrolepegawai', ['filter' => 'akseslogin']);
$routes->post('/role/btntujuanrolepegawai', 'backend\Role::btntujuanrolepegawai', ['filter' => 'akseslogin']);
$routes->post('/backend/role/btntujuanrolepegawai', 'backend\Role::btntujuanrolepegawai', ['filter' => 'akseslogin']);

$routes->get('/profil', 'backend/Profil::index', ['filter' => 'akseslogin']);
$routes->get('/backend/profil', 'backend/Profil::index', ['filter' => 'akseslogin']);
$routes->get('/profil/editprofil/(:num)', 'backend\Profil::editprofil/$1', ['filter' => 'akseslogin']);
$routes->get('/backend/profil/editprofil/(:num)', 'backend\Profil::editprofil/$1', ['filter' => 'akseslogin']);
$routes->post('/profil/editpassword', 'backend\Profil::editpassword', ['filter' => 'akseslogin']);
$routes->post('/backend/profil/editpassword', 'backend\Profil::editpassword', ['filter' => 'akseslogin']);
$routes->post('/profil/updateprofil', 'backend\Profil::updateprofil', ['filter' => 'akseslogin']);
$routes->post('/backend/profil/updateprofil', 'backend\Profil::updateprofil', ['filter' => 'akseslogin']);
$routes->get('/profil/absen', 'backend/Profil::absen', ['filter' => 'akseslogin']);
$routes->get('/backend/profil/absen', 'backend/Profil::absen', ['filter' => 'akseslogin']);
$routes->post('/profil/fetchabsen', 'backend\Profil::fetchabsen', ['filter' => 'akseslogin']);
$routes->post('/backend/profil/fetchabsen', 'backend\Profil::fetchabsen', ['filter' => 'akseslogin']);


$routes->get('/datasekolah/divisi', 'backend/Datasekolah::divisi', ['filter' => 'akseslogin']);
$routes->get('/backend/datasekolah/divisi', 'backend/Datasekolah::divisi', ['filter' => 'akseslogin']);
$routes->post('/datasekolah/fetchdivisi', 'backend/Datasekolah::fetchdivisi', ['filter' => 'akseslogin']);
$routes->post('/backend/datasekolah/fetchdivisi', 'backend/Datasekolah::fetchdivisi', ['filter' => 'akseslogin']);
$routes->post('/datasekolah/savedivisi', 'backend/Datasekolah::savedivisi', ['filter' => 'akseslogin']);
$routes->post('/backend/datasekolah/savedivisi', 'backend/Datasekolah::savedivisi', ['filter' => 'akseslogin']);
$routes->delete('/backend/datasekolah/deletedivisi/(:num)', 'backend\Datasekolah::deletedivisi/$1', ['filter' => 'akseslogin']);
$routes->delete('/datasekolah/deletedivisi/(:num)', 'backend\Datasekolah::deletedivisi/$1', ['filter' => 'akseslogin']);
$routes->post('/datasekolah/editdivisimodal', 'backend\Datasekolah::editdivisimodal', ['filter' => 'akseslogin']);
$routes->post('/backend/datasekolah/editdivisimodal', 'backend\Datasekolah::editdivisimodal', ['filter' => 'akseslogin']);
$routes->post('/datasekolah/editdivisi', 'backend\Datasekolah::editdivisi', ['filter' => 'akseslogin']);
$routes->post('/backend/datasekolah/editdivisi', 'backend\Datasekolah::editdivisi', ['filter' => 'akseslogin']);

$routes->get('/datasekolah/jabatan', 'backend/Datasekolah::jabatan', ['filter' => 'akseslogin']);
$routes->get('/backend/datasekolah/jabatan', 'backend/Datasekolah::jabatan', ['filter' => 'akseslogin']);
$routes->post('/datasekolah/fetchjabatan', 'backend/Datasekolah::fetchjabatan', ['filter' => 'akseslogin']);
$routes->post('/backend/datasekolah/fetchjabatan', 'backend/Datasekolah::fetchjabatan', ['filter' => 'akseslogin']);
$routes->post('/datasekolah/savejabatan', 'backend/Datasekolah::savejabatan', ['filter' => 'akseslogin']);
$routes->post('/backend/datasekolah/savejabatan', 'backend/Datasekolah::savejabatan', ['filter' => 'akseslogin']);
$routes->delete('/backend/datasekolah/deletejabatan/(:num)', 'backend\Datasekolah::deletejabatan/$1', ['filter' => 'akseslogin']);
$routes->delete('/datasekolah/deletejabatan/(:num)', 'backend\Datasekolah::deletejabatan/$1', ['filter' => 'akseslogin']);
$routes->post('/datasekolah/editjabatanmodal', 'backend\Datasekolah::editjabatanmodal', ['filter' => 'akseslogin']);
$routes->post('/backend/datasekolah/editjabatanmodal', 'backend\Datasekolah::editjabatanmodal', ['filter' => 'akseslogin']);
$routes->post('/datasekolah/editjabatan', 'backend\Datasekolah::editjabatan', ['filter' => 'akseslogin']);
$routes->post('/backend/datasekolah/editjabatan', 'backend\Datasekolah::editjabatan', ['filter' => 'akseslogin']);

$routes->get('/datasekolah/statuspegawai', 'backend/Datasekolah::statuspegawai', ['filter' => 'akseslogin']);
$routes->get('/backend/datasekolah/statuspegawai', 'backend/Datasekolah::statuspegawai', ['filter' => 'akseslogin']);
$routes->post('/datasekolah/fetchstatuspegawai', 'backend/Datasekolah::fetchstatuspegawai', ['filter' => 'akseslogin']);
$routes->post('/backend/datasekolah/fetchstatuspegawai', 'backend/Datasekolah::fetchstatuspegawai', ['filter' => 'akseslogin']);
$routes->post('/datasekolah/savestatuspegawai', 'backend/Datasekolah::savestatuspegawai', ['filter' => 'akseslogin']);
$routes->post('/backend/datasekolah/savestatuspegawai', 'backend/Datasekolah::savestatuspegawai', ['filter' => 'akseslogin']);
$routes->delete('/backend/datasekolah/deletestatuspegawai/(:num)', 'backend\Datasekolah::deletestatuspegawai/$1', ['filter' => 'akseslogin']);
$routes->delete('/datasekolah/deletestatuspegawai/(:num)', 'backend\Datasekolah::deletestatuspegawai/$1', ['filter' => 'akseslogin']);
$routes->post('/datasekolah/editstatuspegawaimodal', 'backend\Datasekolah::editstatuspegawaimodal', ['filter' => 'akseslogin']);
$routes->post('/backend/datasekolah/editstatuspegawaimodal', 'backend\Datasekolah::editstatuspegawaimodal', ['filter' => 'akseslogin']);
$routes->post('/datasekolah/editstatuspegawai', 'backend\Datasekolah::editstatuspegawai', ['filter' => 'akseslogin']);
$routes->post('/backend/datasekolah/editstatuspegawai', 'backend\Datasekolah::editstatuspegawai', ['filter' => 'akseslogin']);

$routes->get('/datasekolah/tahun', 'backend/Datasekolah::tahun', ['filter' => 'akseslogin']);
$routes->get('/backend/datasekolah/tahun', 'backend/Datasekolah::tahun', ['filter' => 'akseslogin']);
$routes->post('/datasekolah/fetchtahun', 'backend/Datasekolah::fetchtahun', ['filter' => 'akseslogin']);
$routes->post('/backend/datasekolah/fetchtahun', 'backend/Datasekolah::fetchtahun', ['filter' => 'akseslogin']);
$routes->post('/datasekolah/editmodaltahun', 'backend/Datasekolah::editmodaltahun', ['filter' => 'akseslogin']);
$routes->post('/backend/datasekolah/editmodaltahun', 'backend/Datasekolah::editmodaltahun', ['filter' => 'akseslogin']);
$routes->post('/datasekolah/edittahun', 'backend/Datasekolah::edittahun', ['filter' => 'akseslogin']);
$routes->post('/backend/datasekolah/edittahun', 'backend/Datasekolah::edittahun', ['filter' => 'akseslogin']);

$routes->get('/pegawai', 'backend/Pegawai::index', ['filter' => 'akseslogin']);
$routes->get('/backend/pegawai', 'backend/Pegawai::index', ['filter' => 'akseslogin']);
$routes->get('/pegawai/formtambah', 'backend/Pegawai::formtambah', ['filter' => 'akseslogin']);
$routes->get('/backend/pegawai/formtambah', 'backend/Pegawai::formtambah', ['filter' => 'akseslogin']);
$routes->post('/pegawai/fetchpegawai', 'backend/Pegawai::fetchpegawai', ['filter' => 'akseslogin']);
$routes->post('/backend/pegawai/fetchpegawai', 'backend/Pegawai::fetchpegawai', ['filter' => 'akseslogin']);
$routes->post('/pegawai/tambahpegawai', 'backend/Pegawai::tambahpegawai', ['filter' => 'akseslogin']);
$routes->post('/backend/pegawai/tambahpegawai', 'backend/Pegawai::tambahpegawai', ['filter' => 'akseslogin']);
$routes->get('/pegawai/editformpegawai/(:num)', 'backend\Pegawai::editformpegawai/$1', ['filter' => 'akseslogin']);
$routes->get('/backend/pegawai/editformpegawai/(:num)', 'backend\Pegawai::editformpegawai/$1', ['filter' => 'akseslogin']);
$routes->post('/pegawai/editpegawai', 'backend/Pegawai::editpegawai', ['filter' => 'akseslogin']);
$routes->post('/backend/pegawai/editpegawai', 'backend/Pegawai::editpegawai', ['filter' => 'akseslogin']);
$routes->post('/pegawai/editpasswordpegawai', 'backend/Pegawai::editpasswordpegawai', ['filter' => 'akseslogin']);
$routes->post('/backend/pegawai/editpasswordpegawai', 'backend/Pegawai::editpasswordpegawai', ['filter' => 'akseslogin']);
$routes->post('/pegawai/importpegawai', 'backend/Pegawai::importpegawai', ['filter' => 'akseslogin']);
$routes->post('/backend/pegawai/importpegawai', 'backend/Pegawai::importpegawai', ['filter' => 'akseslogin']);
$routes->post('/pegawai/deletepegawai', 'backend/Pegawai::deletepegawai', ['filter' => 'akseslogin']);
$routes->post('/backend/pegawai/deletepegawai', 'backend/Pegawai::deletepegawai', ['filter' => 'akseslogin']);

$routes->get('/pegawai/divisi', 'backend/Pegawai::divisi', ['filter' => 'akseslogin']);
$routes->get('/backend/pegawai/divisi', 'backend/Pegawai::divisi', ['filter' => 'akseslogin']);
$routes->post('/pegawai/fetchdivisibdpegawai', 'backend/Pegawai::fetchdivisibdpegawai', ['filter' => 'akseslogin']);
$routes->post('/backend/pegawai/fetchdivisibdpegawai', 'backend/Pegawai::fetchdivisibdpegawai', ['filter' => 'akseslogin']);
$routes->post('/pegawai/fetchdivisisemuapegawai', 'backend/Pegawai::fetchdivisisemuapegawai', ['filter' => 'akseslogin']);
$routes->post('/backend/pegawai/fetchdivisisemuapegawai', 'backend/Pegawai::fetchdivisisemuapegawai', ['filter' => 'akseslogin']);
$routes->delete('/backend/pegawai/deletedivisipegawai/(:num)', 'backend\Pegawai::deletedivisipegawai/$1', ['filter' => 'akseslogin']);
$routes->delete('/pegawai/deletedivisipegawai/(:num)', 'backend\Pegawai::deletedivisipegawai/$1', ['filter' => 'akseslogin']);
$routes->post('/pegawai/fetchdivisipegawai', 'backend/Pegawai::fetchdivisipegawai', ['filter' => 'akseslogin']);
$routes->post('/backend/pegawai/fetchdivisipegawai', 'backend/Pegawai::fetchdivisipegawai', ['filter' => 'akseslogin']);
$routes->post('/pegawai/btntujuandivisipegawai', 'backend/Pegawai::btntujuandivisipegawai', ['filter' => 'akseslogin']);
$routes->post('/backend/pegawai/btntujuandivisipegawai', 'backend/Pegawai::btntujuandivisipegawai', ['filter' => 'akseslogin']);

$routes->get('/pegawai/absen', 'backend/Pegawai::absen', ['filter' => 'akseslogin']);
$routes->get('/backend/pegawai/absen', 'backend/Pegawai::absen', ['filter' => 'akseslogin']);
$routes->post('/pegawai/fetchabsenpegawai', 'backend/Pegawai::fetchabsenpegawai', ['filter' => 'akseslogin']);
$routes->post('/backend/pegawai/fetchabsenpegawai', 'backend/Pegawai::fetchabsenpegawai', ['filter' => 'akseslogin']);
$routes->post('/pegawai/saveabsenpegawai', 'backend/Pegawai::saveabsenpegawai', ['filter' => 'akseslogin']);
$routes->post('/backend/pegawai/saveabsenpegawai', 'backend/Pegawai::saveabsenpegawai', ['filter' => 'akseslogin']);
$routes->post('/pegawai/editmodalabsen', 'backend/Pegawai::editmodalabsen', ['filter' => 'akseslogin']);
$routes->post('/backend/pegawai/editmodalabsen', 'backend/Pegawai::editmodalabsen', ['filter' => 'akseslogin']);
$routes->post('/pegawai/editabsenpegawai', 'backend/Pegawai::editabsenpegawai', ['filter' => 'akseslogin']);
$routes->post('/backend/pegawai/editabsenpegawai', 'backend/Pegawai::editabsenpegawai', ['filter' => 'akseslogin']);
$routes->post('/pegawai/deleteabsenpegawai', 'backend/Pegawai::deleteabsenpegawai', ['filter' => 'akseslogin']);
$routes->post('/backend/pegawai/deleteabsenpegawai', 'backend/Pegawai::deleteabsenpegawai', ['filter' => 'akseslogin']);
$routes->post('/pegawai/importabsenpegawai', 'backend/Pegawai::importabsenpegawai', ['filter' => 'akseslogin']);
$routes->post('/backend/pegawai/importabsenpegawai', 'backend/Pegawai::importabsenpegawai', ['filter' => 'akseslogin']);

$routes->get('/tatausaha/kelas', 'backend/TataUsaha::kelas', ['filter' => 'akseslogin']);
$routes->get('/backend/tatausaha/kelas', 'backend/TataUsaha::kelas', ['filter' => 'akseslogin']);
$routes->post('/tatausaha/fetchkelas', 'backend/TataUsaha::fetchkelas', ['filter' => 'akseslogin']);
$routes->post('/backend/tatausaha/fetchkelas', 'backend/TataUsaha::fetchkelas', ['filter' => 'akseslogin']);
$routes->post('/tatausaha/savekelas', 'backend/TataUsaha::savekelas', ['filter' => 'akseslogin']);
$routes->post('/backend/tatausaha/savekelas', 'backend/TataUsaha::savekelas', ['filter' => 'akseslogin']);
$routes->post('/tatausaha/editmodalkelas', 'backend/TataUsaha::editmodalkelas', ['filter' => 'akseslogin']);
$routes->post('/backend/tatausaha/editmodalkelas', 'backend/TataUsaha::editmodalkelas', ['filter' => 'akseslogin']);
$routes->post('/tatausaha/editkelas', 'backend/TataUsaha::editkelas', ['filter' => 'akseslogin']);
$routes->post('/backend/tatausaha/editkelas', 'backend/TataUsaha::editkelas', ['filter' => 'akseslogin']);
$routes->delete('/tatausaha/deletekelas/(:num)', 'backend\TataUsaha::deletekelas/$1', ['filter' => 'akseslogin']);
$routes->delete('/backend/tatausaha/deletekelas/(:num)', 'backend\TataUsaha::deletekelas/$1', ['filter' => 'akseslogin']);

$routes->get('/tatausaha/rombel', 'backend/TataUsaha::rombel', ['filter' => 'akseslogin']);
$routes->get('/backend/tatausaha/rombel', 'backend/TataUsaha::rombel', ['filter' => 'akseslogin']);
$routes->post('/tatausaha/fetchrombel', 'backend/TataUsaha::fetchrombel', ['filter' => 'akseslogin']);
$routes->post('/backend/tatausaha/fetchrombel', 'backend/TataUsaha::fetchrombel', ['filter' => 'akseslogin']);
$routes->post('/tatausaha/cekdivisirombel', 'backend/TataUsaha::cekdivisirombel', ['filter' => 'akseslogin']);
$routes->post('/backend/tatausaha/cekdivisirombel', 'backend/TataUsaha::cekdivisirombel', ['filter' => 'akseslogin']);
$routes->post('/tatausaha/saverombel', 'backend/TataUsaha::saverombel', ['filter' => 'akseslogin']);
$routes->post('/backend/tatausaha/saverombel', 'backend/TataUsaha::saverombel', ['filter' => 'akseslogin']);
$routes->post('/tatausaha/editmodalrombel', 'backend/TataUsaha::editmodalrombel', ['filter' => 'akseslogin']);
$routes->post('/backend/tatausaha/editmodalrombel', 'backend/TataUsaha::editmodalrombel', ['filter' => 'akseslogin']);
$routes->post('/tatausaha/editrombel', 'backend/TataUsaha::editrombel', ['filter' => 'akseslogin']);
$routes->post('/backend/tatausaha/editrombel', 'backend/TataUsaha::editrombel', ['filter' => 'akseslogin']);
$routes->delete('/tatausaha/deleterombel/(:num)', 'backend\TataUsaha::deleterombel/$1', ['filter' => 'akseslogin']);
$routes->delete('/backend/tatausaha/deleterombel/(:num)', 'backend\TataUsaha::deleterombel/$1', ['filter' => 'akseslogin']);


$routes->get('/tatausaha/datasiswa', 'backend/TataUsaha::datasiswa', ['filter' => 'akseslogin']);
$routes->get('/backend/tatausaha/datasiswa', 'backend/TataUsaha::datasiswa', ['filter' => 'akseslogin']);
$routes->get('/tatausaha/daftarsiswa/(:num)', 'backend\TataUsaha::daftarsiswa/$1', ['filter' => 'akseslogin']);
$routes->get('/backend/tatausaha/daftarsiswa/(:num)', 'backend\TataUsaha::daftarsiswa/$1', ['filter' => 'akseslogin']);
$routes->post('/tatausaha/fetchsiswa', 'backend/TataUsaha::fetchsiswa', ['filter' => 'akseslogin']);
$routes->post('/backend/tatausaha/fetchsiswa', 'backend/TataUsaha::fetchsiswa', ['filter' => 'akseslogin']);
$routes->post('/tatausaha/fetchsiswabelum', 'backend/TataUsaha::fetchsiswabelum', ['filter' => 'akseslogin']);
$routes->post('/backend/tatausaha/fetchsiswabelum', 'backend/TataUsaha::fetchsiswabelum', ['filter' => 'akseslogin']);
$routes->post('/tatausaha/fetchsiswakelas', 'backend/TataUsaha::fetchsiswakelas', ['filter' => 'akseslogin']);
$routes->post('/backend/tatausaha/fetchsiswakelas', 'backend/TataUsaha::fetchsiswakelas', ['filter' => 'akseslogin']);
$routes->post('/tatausaha/fetchsiswarombel', 'backend/TataUsaha::fetchsiswarombel', ['filter' => 'akseslogin']);
$routes->post('/backend/tatausaha/fetchsiswarombel', 'backend/TataUsaha::fetchsiswarombel', ['filter' => 'akseslogin']);
$routes->post('/tatausaha/tambahsiswa', 'backend/TataUsaha::tambahsiswa', ['filter' => 'akseslogin']);
$routes->post('/backend/tatausaha/tambahsiswa', 'backend/TataUsaha::tambahsiswa', ['filter' => 'akseslogin']);
$routes->post('/tatausaha/editpasswordsiswa', 'backend/TataUsaha::editpasswordsiswa', ['filter' => 'akseslogin']);
$routes->post('/backend/tatausaha/editpasswordsiswa', 'backend/TataUsaha::editpasswordsiswa', ['filter' => 'akseslogin']);
$routes->post('/tatausaha/editmodalsiswa', 'backend/TataUsaha::editmodalsiswa', ['filter' => 'akseslogin']);
$routes->post('/backend/tatausaha/editmodalsiswa', 'backend/TataUsaha::editmodalsiswa', ['filter' => 'akseslogin']);
$routes->post('/tatausaha/editsiswa', 'backend/TataUsaha::editsiswa', ['filter' => 'akseslogin']);
$routes->post('/backend/tatausaha/editsiswa', 'backend/TataUsaha::editsiswa', ['filter' => 'akseslogin']);
$routes->post('/tatausaha/deletesiswa', 'backend/TataUsaha::deletesiswa', ['filter' => 'akseslogin']);
$routes->post('/backend/tatausaha/deletesiswa', 'backend/TataUsaha::deletesiswa', ['filter' => 'akseslogin']);
$routes->post('/tatausaha/importsiswa', 'backend/TataUsaha::importsiswa', ['filter' => 'akseslogin']);
$routes->post('/backend/tatausaha/importsiswa', 'backend/TataUsaha::importsiswa', ['filter' => 'akseslogin']);

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
