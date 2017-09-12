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

//DocumentViewer Library
Route::get('/', 'HomeController@index')->name('home');

 Auth::routes();



    Route::any('ViewerJS/{all?}', function(){

        return View::make('ViewerJS.index');
    });
 

    Route::resource('module', 'ModuleController');

    Route::resource('training', 'TrainingController');

    Route::resource('struktur', 'StrukturOrganisasiController');

    Route::post('struktur/update','StrukturOrganisasiController@update');

    Route::resource('job-family', 'JobFamilyController');

    Route::resource('department', 'DepartmentController');

    Route::resource('news', 'BeritaController');

    Route::resource('slider', 'ContentSliderController');

    Route::resource('section-training', 'SectionTrainingController');

    Route::resource('jawaban', 'JawabanTraineeController');

    Route::resource('personnel', 'PersonnelController');

    Route::get('trainee/{id}', 'TrainingController@see_trainee');

//    Route::controller('personnel/datatables', 'PersonnelController', [
//        'anyData'  => 'personnel.data',
//        'getIndex' => 'personnel',
//    ]);

    Route::resource('raport', 'ScoreSummaryController');

    Route::resource('test', 'TestController');

    Route::resource('question', 'QuestionController');

    Route::post('personnel/submit', 'PersonnelController@update');

    Route::post('slider/submit', 'ContentSliderController@update');

    Route::post('news/submit', 'BeritaController@update');

    Route::post('question/submit', 'QuestionController@update');

    Route::post('raport/submit', 'ScoreSummaryController@store');

    Route::resource('news-reply', 'NewsReplieController');

    Route::resource('forum-reply', 'ReplieController');

    Route::resource('access', 'UserTrainingAuthController');

    Route::get('/slider/{id}/active', 'ContentSliderController@active');

    Route::get('/slider/{id}/nonactive', 'ContentSliderController@nonactive');

    Route::get('/berita/{id}/active', 'BeritaController@status_active');

    Route::get('/berita/{id}/nonactive', 'BeritaController@status_nonactive');

    Route::get('/access/{id}/active', 'UserTrainingAuthController@active');

    Route::get('/access/{id}/nonactive', 'UserTrainingAuthController@nonactive');

    Route::get('/news/{id}/active', 'BeritaController@active');

    Route::get('/news/{id}/nonactive', 'BeritaController@nonactive');

    Route::get('/content-learning/{id}', 'ContentLearningController@add_content_learning');

    Route::post('/content-learning/submit', 'ContentLearningController@store');

    Route::post('/training/update', 'TrainingController@update');

    Route::get('/get-content-learning/{id}', 'ContentLearningController@get_content_learning');

    Route::get('/add-post-test/{id}', 'TrainingController@add_post_test');

    Route::post('/post-test/submit', 'TestController@store_post_test');

    Route::get('news-board', 'BeritaController@readMore');

    Route::get('/request-access/{id_training}', 'UserTrainingAuthController@request_access');

    Route::get('/training/publish/{id}','TrainingController@publish');

    Route::get('/training/deactive/{id}','TrainingController@deactive');

    Route::get('/training/view/{id}','TrainingController@view');

    Route::get('/question/delete/{id}','QuestionController@destroy');

    Route::get('/content-learning/delete/{id}','ContentLearningController@destroy');

    Route::post('/change-time','TestController@change_time');

    Route::post('/content-learning/add-content','ContentLearningController@add_content');

    Route::post('/question/submit','QuestionController@submit');

    Route::post('/question/edit/submit','QuestionController@update');

    Route::post('/get-unit','StrukturOrganisasiController@get_unit');

    Route::post('/get-department','StrukturOrganisasiController@get_department');

    Route::post('/get-section','StrukturOrganisasiController@get_section');

    Route::post('/get-content-preview','ContentLearningController@get_content_preview');

    Route::get('/forum/list', 'ForumController@list_forum');

    Route::get('/slider_attachment_delete/{id}', 'ContentSliderController@delete_attachment');

    Route::post('/get-forum', 'ForumController@get_forum');

    Route::post('/delete-forum', 'ForumController@delete_forum');

    Route::get('/personnel/nonactive/{id}', 'PersonnelController@nonactive');

    Route::get('/personnel/active/{id}', 'PersonnelController@active');

    Route::get('/reset-password', 'PersonnelController@reset');

    Route::post('/reset-password', 'PersonnelController@reset_password');

    Route::post('/request-reset-password', 'PersonnelController@request_reset');

    Route::get('/request-reset', function () {
        return view('RequestPasswordForm');
    });

    Route::get('/access-process/{id}', 'UserTrainingAuthController@process');

    Route::get('process-access/submit/{id}', 'UserTrainingAuthController@process_submit');

    Route::post('/get-slider-ajax', 'ContentSliderController@get_slider_ajax');

    Route::post('/change-photo', 'PersonnelController@change_photo');


    Route::get('/news_attachment_delete/{id}', 'BeritaController@delete_attachment');

    Route::get('Trainning', function () {
        return view('IModul');
    });

    Route::resource('datatables', 'DatatablesController', [
        'anyData'  => 'datatables.data',
        'getIndex' => 'datatables',
    ]);

    Route::post('abc', 'DatatablesController@anyData');


    Route::get('Modul', function () {
        return view('module');
    });

    Route::get('Pre-Test', function () {
        return view('PreTest');
    });

    Route::get('EditPreTest', function () {
        return view('Admin.EditPreTest');
    });

    Route::resource('content-learning', 'ContentLearningController');



    Route::get('UserList', function () {
        return view('Admin(new).UserList');
    });


    Route::get('Employee', function () {
        return view('Admin.EmployeeList');
    });


    Route::get('Tests', function () {
        return view('Quiz');
    });




    Route::get('/CreateDepartement', function () {
        return view('Admin.CreateDept');
    });

    Route::get('Materi', function () {
        return view('Materi');
    });

    Route::get('AddUser', function () {
        return view('Admin.AddUser');
    });

    Route::get('UserInfo', function () {
        return view('Admin.UserInfo');
    });

    Route::get('TrainningInfo', function () {
        return view('Admin.TrainningInfo');
    });


    Route::get('CreateTrainning', function () {
        return view('Admin.CreateTrainning2');
    });

    Route::get('EditProfile', function () {
        return view('Admin.EditProfile');
    });

    Route::get('UserList', function () {
        return view('Admin.UserList');
    });

    Route::get('CreateNews', function () {
        return view('Admin.CreateNews');
    });

    Route::get('ListTrainning', function () {
        return view('Admin.ListTrainning');
    });


    Route::get('lol', function () {
        return view('Admin.Template');
    });


    Route::get('QuestionList', function () {
        return view('Admin1.QuestionList');
    });

    Route::get('CreatePreTest', function () {
        return view('Admin.CreatePreTest');
    });

    Route::get('CreateTrainningMateri', function () {
        return view('Admin.CreateTrainningMateri');
    });

    Route::get('AddMateri', function () {
        return view('Admin.AddMateri');
    });

    Route::get('Upload', function () {
        return view('Admin.UploadImage');
    });

    Route::get('CreateTrainning2', function () {
        return view('Admin.CreateTrainning2');
    });

    Route::get('404', function () {
        return view('404');
    });

    Route::get('NewsBoard', function () {
        return view('newsboard');
    });

    Route::resource('forum', 'ForumController');

    Route::get('forum/{id_forum}/user/edit','ForumController@editUser');

    Route::post('forum/user/update','ForumController@updateUser');

    Route::get('RequestBoard', function () {
        return view('Admin.RequestBoard');
    });

    Route::get('ResetPassword', function () {
        return view('ResetPassword');
    });

    Route::get('editor', function () {
        return view('editor');
    });

