<?php
use App\User;

use App\EnroleeCourses;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/', function () {
//     return view('welcome');
// });




Auth::routes([	'reset' => false,
				'verify' => false]);


//Route::get('/registration','RegisterController@index')->//name('login');

Route::Auth();

Route::get('/', function(){
	return view('welcome');
});

//LOGIN ------
//Route::get('/','LoginController@index')->name('login');
//Route::post('/','LoginController@auth');


Route::get('/change-password', 'Auth\ChangePasswordController@index');
Route::post('/change-password', 'Auth\ChangePasswordController@update');

//Route::post('/mylogout', 'Auth\LogoutController@logout');


//ADMIN AUTH
Route::get('/cpanel', 'Administrator\LoginController@index')->name('cpanel-login');
Route::post('/cpanel', 'Administrator\LoginController@authenticate')->name('cpanel-auth');


//ADMINISTRATOR-------
Route::get('/cpanel-home', 'Administrator\HomeController@index')->name('cpanel-home');




//REPORT ADMINISTRATOR
Route::get('/cpanel-report/faculty-report', 'Administrator\Report\FacultyReportController@index');
Route::get('/ajax/faculty', 'Administrator\Report\FacultyReportController@ajaxFaculty');

Route::get('/cpanel-report/faculty-schedule', 'Administrator\Report\FacultyReportScheduleController@index');
Route::get('/ajax/faculty-schedule', 'Administrator\Report\FacultyReportScheduleController@ajaxSchedule');

//rating
Route::get('/cpanel-report/faculty-rating', 'Administrator\Report\FacultyRatingReportController@index');
Route::get('/ajax/faculty-rater', 'Administrator\Report\FacultyRatingReportController@ajaxRater');
Route::get('/ajax/faculty-rating', 'Administrator\Report\FacultyRatingReportController@ajaxRating');
Route::get('/ajax/faculty-suggestion', 'Administrator\Report\FacultyRatingReportController@ajaxSuggestion');
Route::get('/ajax/signatory', 'Administrator\Report\FacultyRatingReportController@ajaxSignatory');





//USERS
Route::resource('/user-uploader' , 'Administrator\UserUploaderController');

Route::get('/cpanel-user','UserController@index');
Route::get('/ajax/user','UserController@index_data');
Route::get('/ajax/user/{id}','UserController@show');

Route::post('/ajax/user','UserController@store');
Route::put('/ajax/user/{id}','UserController@update');
Route::delete('/ajax/user/{id}','UserController@destroy');



Route::get('/cpanel-report-faculty', 'Administrator\ReportResultController@index')->name('report');
Route::get('/cpanel-report-faculty/rating', 'Administrator\ReportResultController@ratingResult'); //rating result
Route::get('/cpanel-report-faculty/schedule/{facultyid}', 'Administrator\ReportResultController@facultySchedule');
Route::get('/cpanel-report-faculty/schedule/{facultyid}/{schedcode}', 'Administrator\ReportResultController@reportRating');



Route::get('/cpanel-report-student/by-student', 'Administrator\ReportResultController@studentSchedRated');

Route::get('/data/ajax-faculties', 'Administrator\ReportResultController@ajaxFaculties');
Route::get('/data/ajax-schedules', 'Administrator\ReportResultController@ajaxSchedules');


//CRITERIA ---------------------
//Route::resource('/cpanel-criteria' , 'Administrator\CriteriaController');
Route::get('/cpanel-criteria' , 'Administrator\CriteriaController@index');
Route::get('/ajax/cpanel/criteria' , 'Administrator\CriteriaController@index_data');

//SCHEDULE
Route::resource('/cpanel-schedule' , 'Administrator\ScheduleController');
Route::get('/ajax/cpanel/schedule' , 'Administrator\ScheduleController@index_data');
Route::put('/open/rate/{id}' , 'Administrator\ScheduleController@openRate');
Route::put('/close/rate/{id}' , 'Administrator\ScheduleController@closeRate');




//CATEGORY ---------------------
Route::resource('/cpanel-category' , 'Administrator\CategoryController');
Route::get('/ajax-category' , 'Administrator\CategoryController@ajax_category');
Route::get('/ajax/cpanel/categories' , 'Administrator\CategoryController@activeCategories');


//ACADEMIC YEAR ---------------------
Route::resource('/cpanel-academicyear' , 'Administrator\AcademicYearController');
Route::get('/ajax-academicyear' , 'Administrator\AcademicYearController@ajax_academicyear');
//Route::get('/ajax/academicyear-set-active' , 'Administrator\AcademicYearController@setActive');




//Route::post('/cpanel-criteria/update' , 'Administrator\CriteriaController@update');


//SCHEDULE
Route::resource('/schedule-uploader', 'Administrator\ScheduleUploaderController');

//FaCULTY
Route::resource('/faculty-uploader', 'Administrator\FacultyUploaderController');

//COURSE UPLOADER
Route::resource('/course-uploader', 'Administrator\CourseController');

//ENROLEE UPLOADER
Route::resource('/enrolee-uploader', 'Administrator\EnroleeUploaderController');
Route::resource('/enrolee-courses-uploader', 'Administrator\EnroleeCoursesUploaderController');




//STUDENT MODULE HERE------
//Route::get('/home','Student\HomeController@index')->name('home');

Route::get('/home', 'Student\HomeController@index')->name('home');

Route::get('/about','Student\AboutController@index');
Route::get('/faq','Student\FAQController@index');

Route::get('/schedule','Student\ScheduleController@index');
Route::get('/ajax/schedule','Student\ScheduleController@ajaxSchedule');

Route::get('/criteria','Student\CriteriaController@index');
Route::get('/ajax/criteria','Student\CriteriaController@ajaxCriteria');
Route::post('/ajax/criteria','Student\CriteriaController@store');
Route::get('/ajax/instructor','Student\CriteriaController@ajaxInstructor');

Route::get('/view-rating','Student\ViewRatingController@index');
Route::get('/ajax/rating','Student\ViewRatingController@ajaxRating');


// Route::get('/cor','Student\StudyLoadController@studyload');
// Route::get('/cor/schedule/{schedid}','Student\StudyLoadController@rate');
// Route::post('/cor/save','Student\StudyLoadController@save');
// Route::get('/cor/{schedid}/rated','Student\StudyLoadController@isRated');
//Route::get('/cor/viewrating/{schedid}','Student\ViewRatingController@viewRating');


// Route::get('/rate/{schedid}','Student\RatingController@index');
// Route::post('/rate/{schedid}','Student\RatingController@save');


Route::get('/reguser','UserController@regUser');
Route::get('/data/ajax-users','UserController@ajaxUsers')->name('db-ajax-user');


//LOGOUT
//  Route::get('/app/logout', function() {
//      Auth::logout();
//      return redirect('/');
//  });



//  Route::get('/app/test', function() {
//     $role = Auth::guard('admin')->user()->userType;
//     return $role;

// });


// Route::get('/app/test', function() {
//     return User::all()->take(5);
// });
//insert admin
//Route::get('/insert', function(){
//
//    User::create([
//        'student_id' => 'admin',
//        'username' => 'admin',
//        'lname' => 'AMPARADO',
//        'password' => \Hash::make('gadtc'),
//        'role' => 'ADMINISTRATOR'
//    ]);
//
//});


//Route::get('/test/schedule', function(){
//    //return \App\Schedule::with(['faculty'])->take(5)->get();
//    //return \App\Faculty::take(5)->get();
//    return \App\Schedule::join('tblins', 'SchedInsCode', 'InsCode')
//        ->join('tblsubject', 'SchedSubjCode', 'SubjCode')
//        ->select('SchedCode','SchedTimeFrm', 'SchedTimeTo', 'SchedDays','InsCode',
//        'InsLName', 'InsFName', 'InsMName', 'SchedSubjCode', 'SubjName', 'SubjDesc', 'SubjClass', 'SubjUnits')
//        ->take(5)
//        ->get();
//});


Route::get('/not-rated','Administrator\Report\IncompleteRatingStudentController@notRated');

