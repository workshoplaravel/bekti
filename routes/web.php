<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/coba', 'QAController@caseFloding');

Route::get('/', function () {
    $kata = 'menghasilkan';
    $kataAsal = $kata;
    $__kata = preg_replace('/(i|an)\z/i','',$kata);
    return preg_match('/(kan)\z/i',$kata);
	if(preg_match('/(i|an)\z/i',$kata)){ // Cek Suffixes
		$__kata = preg_replace('/(i|an)\z/i','',$kata);
		if(cekKamus($__kata)){ // Cek Kamus
			return $__kata;
		}else if(preg_match('/(kan)\z/i',$kata)){
			$__kata = preg_replace('/(kan)\z/i','',$kata);
			if(cekKamus($__kata)){
				return $__kata;
			}
		}
/*– Jika Tidak ditemukan di kamus –*/
	}
	return $kataAsal;
});

Route::get('tf', 'TFController@index')->name('tf');

Route::get('/qa', 'QAController@index')->name('qa');
Route::get('/qa/add', 'QAController@add')->name('qa.add');
Route::post('/qa', 'QAController@store')->name('qa.store');
Route::delete('/qa/{id}', 'QAController@delete')->name('qa.delete');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/qa/check', 'QAController@getReCheck')->name('qa.check');