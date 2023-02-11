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


/* Route::get('/', function () {
    return redirect()->route('index');
}); */

Route::post('external/email', [App\Http\Controllers\ExternalEmailController::class, 'send'])->name('send.from.external');

Route::get('/', [App\Http\Controllers\IndexController::class, 'index'])->name('index');
Route::get('invitation/{token}',[App\Http\Controllers\UserController::class, 'newUserChangePass'])->name('invitation.set.password');
Route::post('invitation/activate',[App\Http\Controllers\UserController::class, 'newUserActivate'])->name('invitation.activate');

 Route::get('/test',[App\Http\Controllers\TestController::class, 'test']);



Auth::routes();

Route::group(['middleware' => ['auth','verified','checkBanned']], function()
{   
    Route::get('accept/terms', [App\Http\Controllers\TermsConditionController::class, 'accept'])->name('accept.terms');
    Route::delete('deactivate', [App\Http\Controllers\UserController::class, 'deactivate'])->name('deactivate');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::delete('post/delete/{id}',[App\Http\Controllers\PostController::class, 'destroy'])->name('post.destroy');
    Route::post('post/store/{category}',[App\Http\Controllers\PostController::class, 'store'])->name('post.store');
    Route::post('/home',[App\Http\Controllers\PostController::class, 'searchFilter'])->name('post.filter.search');

    Route::group(['middleware' => ['canViewPosts']], function()
    { 
        Route::group(['middleware' => ['checkGuidance']], function()
        { 
            Route::get('post/view/guidance/{id}',[App\Http\Controllers\PostController::class, 'viewPost'])->name('view.post');
        });
        Route::group(['middleware' => ['checkStudent']], function()
        { 
            Route::get('post/view/student/{id}',[App\Http\Controllers\PostController::class, 'viewPostByStudent'])->name('view.post.student');
            Route::post('comment/store/post/student/view',[App\Http\Controllers\CommentController::class, 'storeCommentByStudentPostView'])->name('store.comment.student.postview');
            Route::put('post/restore',[App\Http\Controllers\PostController::class, 'restore'])->name('restore.posts');
        });
    });

   /*  Route::group(['middleware' => ['checkGuidance','checkStudent']], function()
    {  */
        Route::post('comment/store/post',[App\Http\Controllers\CommentController::class, 'storeComment'])->name('store.comment');
        Route::post('comment/store/post/view',[App\Http\Controllers\CommentController::class, 'storeCommentPostView'])->name('store.comment.postview');
        Route::get('comment/get/post/{postId}',[App\Http\Controllers\CommentController::class, 'getComments'])->name('get.post.comments');
   /*  });
 */
    Route::group(['middleware' => ['checkAdmin']], function()
    {   
        //Manage Users of system
        Route::get('user/manage',[App\Http\Controllers\UserController::class, 'index'])->name('user.index');
        Route::post('user/store',[App\Http\Controllers\UserController::class, 'store'])->name('user.store');
        Route::put('user/disable/{id}',[App\Http\Controllers\UserController::class, 'disable'])->name('user.disable');
        Route::put('user/enable/{id}',[App\Http\Controllers\UserController::class, 'enable'])->name('user.enable');
        Route::get('user/edit/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('user.edit');
        Route::put('user/update', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');

        //Manage Student Sections
        Route::get('manage/get-section-info/{id}',[App\Http\Controllers\SectionController::class, 'getInfo'])->name('section.info');
        Route::delete('manage/section/{id}',[App\Http\Controllers\SectionController::class, 'destroy'])->name('section.destroy');
        Route::post('manage/section/create',[App\Http\Controllers\SectionController::class, 'store'])->name('section.store');
        Route::put('manage/section/update',[App\Http\Controllers\SectionController::class, 'update'])->name('section.update');

        //terms and conditions
        Route::get('accept/terms/edit/{id}', [App\Http\Controllers\TermsConditionController::class, 'edit'])->name('edit.terms');
        Route::put('accept/terms/update/{id}', [App\Http\Controllers\TermsConditionController::class, 'update'])->name('update.terms');

        //Manage recepients
        Route::get('recipients', [App\Http\Controllers\ExternalEmailController::class, 'receivers'])->name('edit.receivers');
        Route::get('recipients/info/{id}', [App\Http\Controllers\ExternalEmailController::class, 'getInfo'])->name('get.receiver.info');
        Route::post('recipients/store', [App\Http\Controllers\ExternalEmailController::class, 'store'])->name('store.receivers');
        Route::post('recipients/update', [App\Http\Controllers\ExternalEmailController::class, 'update'])->name('update.receivers');
        Route::delete('recipients/delete/{id}', [App\Http\Controllers\ExternalEmailController::class, 'destroy'])->name('destroy.receivers');

 
      


        //Manage page
       /*  Route::get('manage/page',[App\Http\Controllers\PageController::class, 'index'])->name('manage.page.index'); */
        //banner
      /*   Route::put('manage/page/banner/update/{id}',[App\Http\Controllers\PageController::class, 'updateBanner'])->name('manage.banner.update'); */
        //serviceTitle update
       /*  Route::put('manage/page/service-title/update/{id}',[App\Http\Controllers\PageController::class, 'updateServiceTitle'])->name('manage.service.update'); */
        //categories update
       /*  Route::put('manage/page/categories/update/personal/{id}',[App\Http\Controllers\PageController::class, 'updatePersonal'])->name('manage.personal.update');
        Route::put('manage/page/categories/update/academic/{id}',[App\Http\Controllers\PageController::class, 'updateAcademic'])->name('manage.academic.update');
        Route::put('manage/page/categories/update/career/{id}',[App\Http\Controllers\PageController::class, 'updateCareer'])->name('manage.career.update');
        Route::delete('manage/page/services/delete',[App\Http\Controllers\PageController::class, 'destroyServices'])->name('manage.services.destroy'); */

        //about
        /* Route::get('manage/page/about/get-info/{idType}',[App\Http\Controllers\PageController::class, 'getAboutInfo'])->name('manage.about.get.info');
        Route::put('manage/page/about/update',[App\Http\Controllers\PageController::class, 'updateAbout'])->name('manage.about.update');*/
 
        /* Route::get('get-post-chart-data',[App\Http\Controllers\ChartDataController::class, 'getPosts'])->name('get.chart'); */
       // Route::get('/get-post-chart-data', 'ChartDataController@getMonthlyPostData');

       //edit your profile
      
    });
    Route::get('profile/edit',[App\Http\Controllers\ProfileController::class, 'edit'])->name('edit.profile');
    Route::put('profile/avatar/upload/{id}',[App\Http\Controllers\ProfileController::class, 'uploadAvatar'])->name('edit.avatar');
    Route::put('profile/change-password',[App\Http\Controllers\ProfileController::class, 'changePass'])->name('edit.password');
    Route::put('profile/update',[App\Http\Controllers\ProfileController::class, 'update'])->name('update.profile');

    Route::group(['middleware' => ['checkSuperAdmin']], function()
    {  
        Route::get('deactivated/students',[App\Http\Controllers\UserController::class, 'deactivatedStudents'])->name('deactivated.students');
        Route::put('deactivated/students/{id}',[App\Http\Controllers\UserController::class, 'reactivateStudents'])->name('reactivate.students');
    });
});