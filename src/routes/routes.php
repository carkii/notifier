<?php
Route::group(['as' => 'notifier::','middleware' => ['web']], function () {
	Route::post('notifier/acknowledge','Carkii\Notifier\controllers\NotifierController@acknowledged')
	->name('acknowledged');
});