<?php

use Illuminate\Support\Facades\Route;


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


Auth::routes();

// HOME
Route::get('/', 'HomeController@index')->name('home');
Route::get('/{page}', 'HomeController')->where('page', 'about|products|contact|apply-job|post-job|apply-online');
Route::get('service/{type}', 'HomeController@service');

Route::post('set-candidate', 'HomeController@set_candidate')->middleware(['XSS']);
Route::post('apply-job-details', 'HomeController@apply_job_details');
Route::post('set-employer', 'HomeController@set_employer')->middleware(['XSS']);
Route::post('post-job-details', 'HomeController@post_job_details');
Route::get('upload-resume', 'HomeController@upload_resume');
Route::post('upload', 'HomeController@upload');
Route::post('submit-enquiry', 'HomeController@submit_enquiry')->middleware(['XSS']);
Route::post('apply-job-online', 'HomeController@apply_job_online')->middleware(['XSS']);

Route::get('test/{id}', 'CandidatesController@test');
Route::get('unset-school/{id}', 'CandidatesController@unset_school');
Route::get('unset-college/{id}', 'CandidatesController@unset_college');
Route::get('unset-education', 'CandidatesController@unset_education');
Route::post('add-school', 'CandidatesController@add_school')->middleware(['XSS']);
Route::post('add-college', 'CandidatesController@add_college')->middleware(['XSS']);
Route::post('create-candidate', 'CandidatesController@create_candidate')->middleware(['XSS']);

Route::post('create-employer', 'EmployerController@create_employer')->middleware(['XSS']);

Route::post('add-requirement', 'RequirementController@add_requirement')->middleware(['XSS']);
Route::get('unset-requirement', 'RequirementController@unset_requirement');
Route::get('unset-job/{id}', 'RequirementController@unset_job');

Route::post('show-cities/{state_id}', 'HelperController@show_cities')->middleware(['XSS']);

Route::group(['prefix' => 'admin', 'middleware' => 'guest'], function () {
    Route::get('login', 'AdminController@login');
});

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('/', 'AdminController@dashboard')->name('dashboard');
    Route::get('view-profile', 'AdminController@view_profile');
    Route::post('update-profile/{id}', 'AdminController@update_profile')->middleware(['XSS']);
    Route::post('update-password', 'AdminController@update_password')->middleware(['XSS']);
    Route::get('staffs', 'AdminController@staffs');
    Route::post('add-staff', 'AdminController@add_staff')->middleware(['XSS']);
    Route::get('edit-staff/{id}', 'AdminController@edit_staff');
    Route::get('delete-staff/{id}', 'AdminController@delete_staff');

    Route::get('seo', 'SeoController@seo');
    Route::get('edit-seo/{shortcode}', 'SeoController@fetch_seo');
    Route::post('update-seo', 'SeoController@update_seo')->middleware(['XSS']);

    Route::get('configuration', 'SettingsController@configuration');
    Route::get('edit-config/{shortcode}', 'SettingsController@edit_config');
    Route::post('update-config', 'SettingsController@update_config');

    Route::get('candidates', 'CandidatesController@candidates');
    Route::post('filter-candidates', 'CandidatesController@candidates')->middleware(['XSS']);
    Route::get('add-candidate', 'CandidatesController@add_candidate');
    Route::post('update-candidate', 'CandidatesController@update_candidate')->middleware(['XSS']);
    Route::get('new-candidates', 'CandidatesController@new_candidates');
    Route::post('change-candidate-profile-status', 'CandidatesController@change_candidate_profile_status')->middleware(['XSS']);
    Route::get('edit-candidate/{id}', 'CandidatesController@edit_candidate');
    Route::get('view-candidate/{id}', 'CandidatesController@view_candidate');
    Route::get('add-status/{id}', 'CandidatesController@add_status');
    Route::get('delete-profile/{id}', 'CandidatesController@delete_profile');

    Route::get('pending-online-reports', 'ApplyOnlineReportController@pending_online_reports');
    Route::get('approved-online-reports', 'ApplyOnlineReportController@approved_online_reports');
    Route::post('change-apply-online-reports-status', 'ApplyOnlineReportController@change_apply_online_reports_status');

    Route::get('imported-candidates', 'ImportedCandidatesController@imported_candidates');
    Route::post('import-candidates', 'ImportedCandidatesController@import_candidates');
    Route::post('delete-imported-candidates', 'ImportedCandidatesController@delete_imported_candidates');
    Route::get('edit-imported-candidate/{id}', 'ImportedCandidatesController@edit_imported_candidate');
    Route::post('update-imported-candidate/{id}', 'ImportedCandidatesController@update_imported_candidate');

    Route::get('employers', 'EmployerController@employers');
    Route::get('add-employer', 'EmployerController@add_employer');
    Route::get('new-employers', 'EmployerController@new_employers');
    Route::post('change-employer-profile-status', 'EmployerController@change_employer_profile_status')->middleware(['XSS']);
    Route::get('view-employer/{id}', 'EmployerController@view_employer');
    Route::get('edit-employer/{id}', 'EmployerController@edit_employer');
    Route::post('update-employer/{id}', 'EmployerController@update_employer')->middleware(['XSS']);
    Route::get('delete-employer/{id}', 'EmployerController@delete_employer');

    Route::get('jobs', 'RequirementController@jobs');
    Route::post('filter-jobs', 'RequirementController@jobs')->middleware(['XSS']);
    Route::get('view-job/{id}', 'RequirementController@view_job');
    Route::get('update-candidate-count/{id}', 'RequirementController@update_candidate_count');
    Route::get('update-job-status/{id}', 'RequirementController@update_status');
    Route::get('edit-job/{id}', 'RequirementController@edit_job');
    Route::get('delete-job/{id}', 'RequirementController@delete_job');
    Route::post('update-job', 'RequirementController@update_requirement')->middleware(['XSS']);
});

//Clear Cache facade value:
Route::get('clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('config:cache');
});

//Reoptimized class loader:
Route::get('/optimize', function () {
    Artisan::call('optimize');
    return '<h1>Reoptimized class loader</h1>';
});