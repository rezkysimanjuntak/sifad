<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::put('test', function(){
	echo 'PUT';
});

Route::delete('test', function(){
	echo 'DELETE';
});

Route::group(['middleware' => ['web']], function()    
{
	//Route::auth();
	// Authentication Routes...
	$this->get('login', 'Auth\AuthController@showLoginForm');
	$this->post('login', 'Auth\AuthController@login');

	Route::get('/', array('as'=>'admin', 'uses'=> 'AdminController@index'));
	$this->get('logout', 'Auth\AuthController@logout');

	 //ini route instant isinya banyak route untuk kebutuhan auth
	

});

//Route as admin
Route::group(['middleware' => ['web','auth','level:1']], function()    
{

	// Registration Routes...
	$this->get('register', 'Auth\AuthController@showRegistrationForm');
	$this->post('register', 'Auth\AuthController@register');

	// Password Reset Routes...
	$this->get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
	$this->post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
	$this->post('password/reset', 'Auth\PasswordController@reset');	


	//kepsek
	Route::get('/kepsek', array('as'=>'kepsek', 'uses'=>'Kepsek\KepsekController@index'));
	Route::get('/kepsek/{kepsekNip}/detail', array('as'=>'kepsek.detail', 'uses'=>'Kepsek\KepsekController@detail'));
	//tambahkepsek
	Route::get('/kepsek/tambah', array('as'=>'kepsek.tambah', 'uses'=>'Kepsek\KepsekController@tambah'));
	Route::post('/kepsek/tambahkepsek', array('as'=>'kepsek.tambah.simpan', 'uses'=> 'Kepsek\KepsekController@tambahkepsek'));
	Route::get('/kepsek/{id}/hapus', array('as'=>'kepsek.hapus', 'uses'=> 'Kepsek\KepsekController@hapus'));
	
	Route::get('/kepsek/{id}/edit', array('as'=>'kepsek.edit', 'uses'=>'Kepsek\KepsekController@edit'));
	Route::post('/kepsek/update', array('as'=>'kepsek.update', 'uses'=>'Kepsek\KepsekController@update'));

	//register Kepsek
	Route::get('/accountkepsek', array('as'=>'account.kepsek', 'uses'=>'Account\AccountController@showAccountKepsek'));
	Route::post('/accountkepsek/tambah', array('as'=>'account.kepsek.tambah', 'uses'=>'Account\AccountController@tambahAccountKepsek'));
	Route::get('/accountkepsek/{id}/hapus', array('as'=>'account.kepsek.hapus', 'uses'=> 'Account\AccountController@hapusKepsek'));


	//guru
	Route::get('/guru', array('as'=>'guru', 'uses'=>'Guru\GuruController@index'));
	Route::get('/guru/{guruNip}/detail', array('as'=>'guru.detail', 'uses'=>'Guru\GuruController@detail'));
	//tambah Guru
	Route::get('/guru/tambah', array('as'=>'guru.tambah', 'uses'=>'Guru\GuruController@tambah'));
	Route::post('/guru/tambahguru', array('as'=>'guru.tambah.simpan', 'uses'=> 'Guru\GuruController@tambahguru'));
	Route::get('/guru/{id}/hapus', array('as'=>'guru.hapus', 'uses'=> 'Guru\GuruController@hapus'));	

	Route::get('/guru/{id}/edit', array('as'=>'guru.edit', 'uses'=>'Guru\GuruController@edit'));
	Route::post('/guru/update', array('as'=>'guru.update', 'uses'=>'Guru\GuruController@update'));

	//register Guru
	Route::get('/accountguru', array('as'=>'account.guru', 'uses'=>'Account\AccountController@showAccountGuru'));
	Route::post('/accountguru/tambah', array('as'=>'account.guru.tambah', 'uses'=>'Account\AccountController@tambahAccountGuru'));
	Route::get('/accountguru/{id}/hapus', array('as'=>'account.guru.hapus', 'uses'=> 'Account\AccountController@hapusGuru'));

	//pustakawan
	Route::get('/pustakawan', array('as'=>'pustakawan', 'uses'=>'Pustakawan\PustakawanController@index'));
	Route::get('/pustakawan/{pusNip}/detail', array('as'=>'pustakawan.detail', 'uses'=>'Pustakawan\PustakawanController@detail'));
	//tambah Pustakawan
	Route::get('/pustakawan/tambah', array('as'=>'pustakawan.tambah', 'uses'=>'Pustakawan\PustakawanController@tambah'));
	Route::post('/pustakawan/tambahpustakawan', array('as'=>'pustakawan.tambah.simpan', 'uses'=> 'Pustakawan\PustakawanController@tambahpustakawan'));
	Route::get('/pustakawan/{id}/hapus', array('as'=>'pustakawan.hapus', 'uses'=> 'Pustakawan\PustakawanController@hapus'));	
	//register Pustakawan
	Route::get('/accountpustakawan', array('as'=>'account.pustakawan', 'uses'=>'Account\AccountController@showAccountPustakawan'));
	Route::post('/accountpustakawan/tambah', array('as'=>'account.pustakawan.tambah', 'uses'=>'Account\AccountController@tambahAccountPustakawan'));
	Route::get('/accountpustakawan/{id}/hapus', array('as'=>'account.pustakawan.hapus', 'uses'=> 'Account\AccountController@hapusPustakawan'));


	//siswa
	Route::get('/siswa', array('as'=>'siswa', 'uses'=>'Siswa\SiswaController@index'));
	Route::get('/siswa/{sisNisn}/detail', array('as'=>'siswa.detail', 'uses'=>'Siswa\SiswaController@detail'));
	//tambah Siswa
	Route::get('/siswa/tambah', array('as'=>'siswa.tambah', 'uses'=>'Siswa\SiswaController@tambah'));
	Route::post('/siswa/tambahsiswa', array('as'=>'siswa.tambah.simpan', 'uses'=> 'Siswa\SiswaController@tambahsiswa'));
	Route::get('/siswa/{id}/hapus', array('as'=>'siswa.hapus', 'uses'=> 'Siswa\SiswaController@hapus'));	

	Route::get('/siswa/{id}/edit', array('as'=>'siswa.edit', 'uses'=>'Siswa\SiswaController@edit'));
	Route::post('/siswa/update', array('as'=>'siswa.update', 'uses'=>'Siswa\SiswaController@update'));

	//register Siswa
	Route::get('/accountsiswa', array('as'=>'account.siswa', 'uses'=>'Account\AccountController@showAccountSiswa'));
	Route::post('/accountsiswa/tambah', array('as'=>'account.siswa.tambah', 'uses'=>'Account\AccountController@tambahAccountSiswa'));
	Route::get('/accountsiswa/{id}/hapus', array('as'=>'account.siswa.hapus', 'uses'=> 'Account\AccountController@hapusSiswa'));


	//Mata Pelajaran
	Route::get('/mapel', array('as'=>'mapel', 'uses'=>'Mapel\MapelController@index'));
	Route::get('mapel/{id}/detail', array('as'=>'mapel.detail', 'uses'=> 'Mapel\MapelController@detail'));

	//tambah Mapel
	Route::get('/mapel/tambah', array('as'=>'mapel.tambah', 'uses'=>'Mapel\MapelController@tambah'));
	Route::post('/mapel/tambahmapel', array('as'=>'mapel.tambah.simpan', 'uses'=> 'Mapel\MapelController@tambahmapel'));
	Route::get('/mapel/{id}/hapus', array('as'=>'mapel.hapus', 'uses'=> 'Mapel\MapelController@hapus'));	

	//Kelas
	Route::get('/kelas', array('as'=>'kelas', 'uses'=>'Kelas\KelasController@index'));
	Route::get('/kelas/{id}/siswa', array('as'=>'kelas.siswa', 'uses'=>'Kelas\KelasController@listSiswa'));
	Route::get('/kelas/{id}/detail', array('as'=>'kelas.detail', 'uses'=>'Kelas\KelasController@detail'));

	//Absensi
	Route::get('/absensi',['as'=>'absensi', 'uses'=> 'Absensi\AbsensiController@index']);
	Route::get('/absensi/{id}/detail', array('as'=>'absensi.detail', 'uses'=> 'Absensi\AbsensiController@detail'));

	//Nilai
	Route::get('/nilai', array('as'=>'nilai', 'uses'=>'Nilai\NilaiController@index'));
	Route::get('/nilai/{id1}/{id2}/{id3}/detail', array('as'=>'nilai.detail', 'uses'=>'Nilai\NilaiController@detail'));
	
});

//Route as Kepsek
Route::group(['middleware' => ['web','auth','level:4']], function()    
{
	Route::get('/kepsekdashboard',['as'=>'kepsekdashboard', 'uses'=> 'RoleKepsek\RoleKepsekController@kepsekDashboard']);
	
	//reset password
	Route::get('reset/password/kepsek',['as'=>'reset.password.kepsek', 'uses'=> 'RoleKepsek\RoleKepsekController@formResetPasswordKepsek']);
	Route::post('reset/password/kepsek',['as'=>'reset.password.kepsek', 'uses'=> 'RoleKepsek\RoleKepsekController@resetPasswordKepsek']);

});


//Route as Guru
Route::group(['middleware' => ['web','auth','level:5']], function()    
{
	Route::get('/gurudashboard',['as'=>'gurudashboard', 'uses'=> 'RoleGuru\RoleGuruController@guruDashboard']);

	//siswa
	Route::get('/datasiswa', array('as'=>'datasiswa', 'uses'=>'Siswa\SiswaController@index'));
	Route::get('datasiswa/{sisNisn}/detail', array('as'=>'datasiswa.detail', 'uses'=>'Siswa\SiswaController@detail'));

	//anakwali
	Route::get('/anakwali/{id}', array('as'=>'anakwali', 'uses'=>'Siswa\SiswaController@anakWali'));
	
	//nilai
	Route::get('/datanilai/{id}', array('as'=>'datanilai', 'uses'=>'Nilai\NilaiController@dataNilai'));
	Route::get('/datanilai/{id1}/{id2}/{id3}/detail', array('as'=>'datanilai.detail', 'uses'=>'Nilai\NilaiController@detail'));
	Route::get('/datanilai/{id1}/{id2}/{id3}/tambah', array('as'=>'datanilai.edit', 'uses'=>'Nilai\NilaiController@tambah'));
	Route::post('/datanilai/tambahnilai', array('as'=>'datanilai.tambah.simpan', 'uses'=> 'Nilai\NilaiController@tambahnilai'));
	Route::get('/datanilai/{id}/edit', array('as'=>'datanilai.edit', 'uses'=>'Nilai\NilaiController@edit'));
	Route::post('/datanilai/update', array('as'=>'datanilai.update', 'uses'=>'Nilai\NilaiController@update'));
	
	//absensi
	Route::get('/dataabsensi',['as'=>'dataabsensi', 'uses'=> 'Absensi\AbsensiController@index']);
	Route::get('/dataabsensi/{id}/detail', array('as'=>'dataabsensi.detail', 'uses'=> 'Absensi\AbsensiController@detail'));

	Route::get('/dataabsensi/{id}/tambah',['as'=>'dataabsensi.tambah', 'uses'=> 'Absensi\AbsensiController@tambah']);

	//reset password
	Route::get('reset/password/guru',['as'=>'reset.password.guru', 'uses'=> 'RoleGuru\RoleGuruController@formResetPasswordGuru']);
	Route::put('reset/password/guru',['as'=>'reset.password.guru', 'uses'=> 'RoleGuru\RoleGuruController@resetPasswordGuru']);

});