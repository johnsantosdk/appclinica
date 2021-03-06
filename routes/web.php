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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/test', function () {
    return "Hello World!! CRLH";
});

//Rotas para Paciente
Route::group(['prefix' => 'paciente', 'as' => 'paciente.'], function() {
	//URL = paciente/index
	Route::get('/',					 					['as' => 'index',			'uses' => 'PacienteController@index']);
	Route::get('/create',			 					['as' => 'create',			'uses' => 'PacienteController@create']);
	Route::post('/addPaciente',							['as' => 'addPaciente',		'uses' => 'PacienteController@addPaciente']);//rota de teste para ajax
	Route::post('/editPaciente',						['as' => 'editPaciente',	'uses' => 'PacienteController@editPaciente']);//rota de teste para ajax
	Route::match(['get','post'], '/updatePaciente',		['as' => 'updatePaciente',	'uses' => 'PacienteController@updatePaciente']);//rota de teste para ajax
	Route::post('/showPaciente',						['as' => 'showPaciente',	'uses' => 'PacienteController@showPaciente']);//rota de teste para ajax
	Route::post('/destroyPaciente',						['as' => 'destroyPaciente',	'uses' => 'PacienteController@destroyPaciente']);//rota de teste para ajax
	Route::post('/infoPaciente',						['as' => 'infoPaciente',	'uses' => 'PacienteController@infoPaciente']);//rota de teste para ajax
	Route::post('/store',			 					['as' => 'store',			'uses' => 'PacienteController@store']);
	Route::get('/findPaciente',							['as' => 'findPaciente',	'uses' => 'PacienteController@findPaciente']);
	Route::match(['get','post'], '/listPaciente',		['as' => 'listPaciente',	'uses' => 'PacienteController@listPaciente']);
	Route::get('/edit',				 					['as' => 'edit',			'uses' => 'PacienteController@edit']);
	Route::put('/update',			 					['as' => 'update',			'uses' => 'PacienteController@update']);
	Route::get('/destroy/{id}',							['as' => 'destroy',			'uses' => 'PacienteController@destroy']);
	Route::get('/test',									['as' => 'test',			'uses' => 'PacienteController@listPlanos']);
});

//Rotas para Medico
Route::group(['prefix' => 'medico', 'as' => 'medico.'], function() {
	//URL = medico/index
	Route::get('/',					 	['as' => 'index',			'uses' => 'MedicoController@index']);
	Route::get('/create',			 	['as' => 'create',			'uses' => 'MedicoController@create']);
	Route::post('/addMedico',			['as' => 'addMedico',		'uses' => 'MedicoController@addMedico']);//rota de teste para ajax
	Route::post('/editMedico{id?}',		['as' => 'editMedico',		'uses' => 'MedicoController@editMedico']);//rota de teste para ajax
	Route::post('/updateMedico',		['as' => 'updateMedico',	'uses' => 'MedicoController@updateMedico']);//rota de teste para ajax
	Route::post('/destroyMedico',		['as' => 'destroyMedico',	'uses' => 'MedicoController@destroyMedico']);//rota de teste para ajax
	Route::post('/infoMedico',			['as' => 'infoMedico',		'uses' => 'MedicoController@infoMedico']);//rota de teste para ajax
	Route::post('/store',			 	['as' => 'store',			'uses' => 'MedicoController@store']);
	Route::match(['get','post'],'/list',['as' => 'list',			'uses' => 'MedicoController@list']);
	Route::match(['get','post'],'/find',['as' => 'find',			'uses' => 'MedicoController@find']);
	Route::post('/show',				['as' => 'show',			'uses' => 'MedicoController@show']);
	Route::get('/edit',				 	['as' => 'edit',			'uses' => 'MedicoController@edit']);
	Route::post('/info',				['as' => 'info',			'uses' => 'MedicoController@info']);
	Route::post('/update',			 	['as' => 'update',			'uses' => 'MedicoController@update']);
	Route::post('/showDestroy',			['as' => 'showDestroy',		'uses' => 'MedicoController@showDestroy']);
	Route::post('/destroy',				['as' => 'destroy',			'uses' => 'MedicoController@destroy']);
});

//Rotas para Convenio
Route::group(['prefix' => 'convenio', 'as' => 'convenio.'], function() {
	//URL = convenio/index
	Route::get('/',					 	['as' => 'index',			'uses' => 'ConvenioController@index']);
	Route::get('/create',			 	['as' => 'create',			'uses' => 'ConvenioController@create']);
	Route::post('/addConvenio',			['as' => 'addConvenio',		'uses' => 'ConvenioController@addConvenio']);//rota de teste para ajax
	Route::post('/editConvenio{id?}',	['as' => 'editConvenio',	'uses' => 'ConvenioController@editConvenio']);//rota de teste para ajax
	Route::post('/updateConvenio',		['as' => 'updateConvenio',	'uses' => 'ConvenioController@updateConvenio']);//rota de teste para ajax
	Route::post('/destroyConvenio',		['as' => 'destroyConvenio',	'uses' => 'ConvenioController@destroyConvenio']);//rota de teste para ajax
	Route::post('/infoConvenio',		['as' => 'infoConvenio',	'uses' => 'ConvenioController@infoConvenio']);//rota de teste para ajax
	Route::post('/store',			 	['as' => 'store',			'uses' => 'ConvenioController@store']);
	Route::get('/show/{id}',			['as' => 'show',			'uses' => 'ConvenioController@show']);
	Route::get('/edit/{id}',		 	['as' => 'edit',			'uses' => 'ConvenioController@edit']);
	Route::put('/update/{id}',		 	['as' => 'update',			'uses' => 'ConvenioController@update']);
	Route::get('/destroy/{id}',			['as' => 'destroy',			'uses' => 'ConvenioController@destroy']);
});

//Rotas para Plano
Route::group(['prefix' => 'plano', 'as' => 'plano.'], function() {
	//URL = plano/index
	Route::get('/',					 	['as' => 'index',			'uses' => 'PlanoController@index']);
	Route::get('/create',			 	['as' => 'create',			'uses' => 'PlanoController@create']);
	Route::post('/addPlano',			['as' => 'addPlano',		'uses' => 'PlanoController@addPlano']);//rota de teste para ajax
	Route::post('/editPlano',			['as' => 'editPlano',		'uses' => 'PlanoController@editPlano']);//rota de teste para ajax
	Route::get('/updatePlano',			['as' => 'updatePlano',		'uses' => 'PlanoController@updatePlano']);//rota de teste para ajax
	Route::post('/destroyPlano',		['as' => 'destroyPlano',	'uses' => 'PlanoController@destroyPlano']);//rota de teste para ajax
	Route::post('/infoPlano',			['as' => 'infoPlano',		'uses' => 'PlanoController@infoPlano']);//rota de teste para ajax
	Route::get('/store',			 	['as' => 'store',			'uses' => 'PlanoController@store']);
	Route::post('/showPlano',			['as' => 'showPlano',		'uses' => 'PlanoController@showPlano']);
	Route::get('/show',					['as' => 'show',			'uses' => 'PlanoController@show']);
	Route::get('/list',					['as' => 'list',			'uses' => 'PlanoController@list']);
	Route::get('/edit/{id}',		 	['as' => 'edit',			'uses' => 'PlanoController@edit']);
	Route::put('/update/{id}',		 	['as' => 'update',			'uses' => 'PlanoController@update']);
	Route::get('/destroy/{id}',			['as' => 'destroy',			'uses' => 'PlanoController@destroy']);
});

//Rotas para Consulta
Route::group(['prefix' => 'consulta', 'as' => 'consulta.'], function() {
	//URL = consulta/index
	Route::get('/',					 	['as' => 'index',			'uses' => 'ConsultaController@index']);
	Route::get('/create',			 	['as' => 'create',			'uses' => 'ConsultaController@create']);
	Route::post('/medico',			 	['as' => 'medico',			'uses' => 'ConsultaController@ajaxRequestMedico']);
	Route::post('/filtro',			 	['as' => 'filtro',			'uses' => 'ConsultaController@ajaxFiltroDateTime']);
	Route::post('/findPaciente',	 	['as' => 'findPaciente',	'uses' => 'ConsultaController@findPaciente']);
	Route::post('/addConsulta',			['as' => 'addConsulta',		'uses' => 'ConsultaController@addConsulta']);//rota de teste para ajax
	Route::post('/editConsulta{id?}',	['as' => 'editConsulta',	'uses' => 'ConsultaController@editConsulta']);//rota de teste para ajax
	Route::post('/updateConsulta',		['as' => 'updateConsulta',	'uses' => 'ConsultaController@updateConsulta']);//rota de teste para ajax
	Route::post('/destroyConsulta',		['as' => 'destroyConsulta',	'uses' => 'ConsultaController@destroyConsulta']);//rota de teste para ajax
	Route::post('/infoConsulta',		['as' => 'infoConsulta',	'uses' => 'ConsultaController@infoConsulta']);//rota de teste para ajax
	Route::post('/store',			 	['as' => 'store',			'uses' => 'ConsultaController@store']);
	Route::get('/show/{id}',			['as' => 'show',			'uses' => 'ConsultaController@show']);
	Route::get('/edit/{id}',		 	['as' => 'edit',			'uses' => 'ConsultaController@edit']);
	Route::put('/update/{id}',		 	['as' => 'update',			'uses' => 'ConsultaController@update']);
	Route::get('/destroy/{id}',			['as' => 'destroy',			'uses' => 'ConsultaController@destroy']);
});

//Rotas para Consulta
Route::group(['prefix' => 'especialidade', 'as' => 'especialidade.'], function() {
	//URL = especialidade/index
	Route::get('/',					 			['as' => 'index',					'uses' => 'EspecialidadeController@index']);
	Route::get('/create',			 			['as' => 'create',					'uses' => 'EspecialidadeController@create']);
	Route::post('/store',			 			['as' => 'store',					'uses' => 'EspecialidadeController@store']);
	Route::post('/show',						['as' => 'show',					'uses' => 'EspecialidadeController@show']);
	Route::get('/edit',		 					['as' => 'edit',					'uses' => 'EspecialidadeController@edit']);
	Route::get('/update',		 				['as' => 'update',					'uses' => 'EspecialidadeController@update']);
	Route::post('/showDestroy',					['as' => 'showDestroy',				'uses' => 'EspecialidadeController@showDestroy']);
	Route::post('/destroy',						['as' => 'destroy',					'uses' => 'EspecialidadeController@destroy']);
});

//Rotas para Calendario
Route::group(['prefix' => 'agenda', 'as' => 'agenda.'], function() {
	//URL = agenda/index
	Route::get('/',					 	['as' => 'index',				'uses' => 'AgendaController@index']);
	Route::get('/create',				['as' => 'create',				'uses' => 'AgendaController@create']);
	Route::post('/getMedico',			['as' => 'getMedico',			'uses' => 'AgendaController@getMedico']);
	Route::post('/getAgenda',			['as' => 'getAgenda',			'uses' => 'AgendaController@getAgenda']);
	Route::post('/getAgendaFiltrada',	['as' => 'getAgendaFiltrada',	'uses' => 'AgendaController@getAgendaFiltrada']);
});
//Rotas para o ADMIN
/*
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function() {
	Route::get('/', 			['as' => 'index',		'uses' => 'AdminController@index']);
	Route::get('/test', 		['as' => 'test',		'uses' => 'AdminController@test']);
	Route::get('/login', 		['as' => 'login',		'uses' => 'AdminController@login']);
	Route::get('/signup', 		['as' => 'signup',		'uses' => 'AdminController@signup']);
	Route::get('/error404',		['as' => 'error404',	'uses' => 'AdminController@error404']);
	Route::get('/error500',		['as' => 'error500',	'uses' => 'AdminController@error500']);
	Route::get('/blank-page',	['as' => 'blank-page',	'uses' => 'AdminController@blankPage']);
});
*/

Auth::routes();

Route::get('/test', 'TestController@index')->name('route.test');
Route::get('/home', 'HomeController@index')->name('home');
