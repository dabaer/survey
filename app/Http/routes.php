<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::get('login', 'WelcomeController@login');

Route::post('login', 'WelcomeController@authenticate');

Route::get('logout', 'WelcomeController@logout');

Route::resource('customer', 'CustomerController');

Route::resource('customer.user', 'CustomerUserController', ['except'=>'show']);

Route::resource('customer.survey', 'CustomerSurveyController');

Route::resource('customer.questionnaire', 'CustomerQuestionnaireController', ['except'=>'show']);

Route::get('customer/{customer}/questionnaire/{questionnaire}/duplicate',['as' => 'customer.questionnaire.duplicate', 'uses' => 'CustomerQuestionnaireController@duplicate']);

Route::resource('customer.questionnaire.section', 'CustomerQuestionnaireSectionController', ['except'=>'show']);

Route::resource('customer.questionnaire.section.questiongroup', 'CustomerQuestionnaireSectionQuestiongroupController', ['except'=>'show']);

Route::post('customer/{customer}/questionnaire/{questionnaire}/section/{section}/questiongroup/order',['as' => 'customer.questionnaire.section.questiongroup.order', 'uses' => 'CustomerQuestionnaireSectionQuestiongroupController@order']);

//Route::resource('customer.questionnaire.section.questiongroup.question', 'CustomerQuestionnaireSectionQuestiongroupQuestionController', ['only'=>['index', 'destroy']]);

Route::resource('customer.iteration', 'CustomerIterationController', ['except'=>'show']);

Route::resource('customer.iteration.facility', 'CustomerIterationFacilityController', ['except'=>'show']);

Route::resource('customer.iteration.facility.group', 'CustomerIterationFacilityGroupController', ['except'=>'show']);

Route::resource('customer.iteration.facility.group.child', 'CustomerIterationFacilityGroupChildController', ['except'=>'show']);

Route::get('customer/{customer}/iteration/{iteration}/facility/{facility}/group/{group}/multi',['as' => 'customer.iteration.facility.group.child.multi', 'uses' => 'CustomerIterationFacilityGroupChildController@multi']);
Route::post('customer/{customer}/iteration/{iteration}/facility/{facility}/group/{group}/storemany',['as' => 'customer.iteration.facility.group.child.storemany', 'uses' => 'CustomerIterationFacilityGroupChildController@storemany']);

Route::resource('mail', 'MailController');
