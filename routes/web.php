<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BackController;
use App\Http\Controllers\FrontController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('admin/login', [UserController::class, 'getLogin'])->name('login');
Route::post('admin/login', [UserController::class, 'postLogin'])->name('login');
Route::get('logout', [UserController::class, 'getLogout'])->name('logout');

Route::get('', [FrontController::class, 'home']);
Route::post('/send-notice', [BackController::class, 'sendNotice']);

Route::get('lien-he', [FrontController::class, 'contact']);
Route::get('ve-chung-toi', [FrontController::class, 'about']);

Route::get('tim-kiem', [FrontController::class, 'search']);

Route::get('{slug}.html', [FrontController::class, 'slugHtml']);
Route::get('{slug}', [FrontController::class, 'slug']);

Route::post('dang-ki-nhan-tin-moi-nhat', [FrontController::class, 'subEmail']);
Route::post('lien-he-hoi-dap', [FrontController::class, 'messageContact']);
Route::post('update-view', [FrontController::class, 'updateViews']);
Route::post('comment', [FrontController::class, 'comment']);
Route::post('reply_comment', [FrontController::class, 'replyComment']);

//Adminstrator
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    # welcom to admin
    Route::get('home', [BackController::class, 'home']);

    # staff
    Route::group(['prefix' => 'staff'], function () {
        Route::get('profile', [BackController::class, 'staff_profile']);
        Route::post('profile', [BackController::class, 'staff_profile_post']);
        Route::get('list', [BackController::class, 'staff_list']);
        Route::get('add', [BackController::class, 'staff_add']);
        Route::post('add', [BackController::class, 'staff_add_post']);
        Route::get('edit/{id}', [BackController::class, 'staff_edit']);
        Route::post('edit/{id}', [BackController::class, 'staff_edit_post']);
        Route::get('delete/{id}', [BackController::class, 'staff_delete']);
    });

    # system management
    Route::get('system', [BackController::class, 'system']);
    Route::post('system', [BackController::class, 'system_post']);

    # page management
    Route::group(['prefix' => 'page'], function () {
        Route::get('list', [BackController::class, 'page_list']);
        Route::get('edit/{id}', [BackController::class, 'page_edit']);
        Route::post('edit/{id}', [BackController::class, 'page_edit_post']);
        Route::get('delete/{id}', [BackController::class, 'page_delete']);
        Route::get('add', [BackController::class, 'page_add']);
        Route::post('add', [BackController::class, 'page_add_post']);
    });

    # social management
    Route::group(['prefix' => 'social'], function () {
        Route::get('list', [BackController::class, 'social_list']);
        Route::get('edit/{id}', [BackController::class, 'social_edit']);
        Route::post('edit/{id}', [BackController::class, 'social_edit_post']);
        Route::get('delete/{id}', [BackController::class, 'social_delete']);
        Route::get('add', [BackController::class, 'social_add']);
        Route::post('add', [BackController::class, 'social_add_post']);
    });

    # newsletter management
    Route::group(['prefix' => 'newsletter'], function () {
        Route::get('list', [BackController::class, 'newsletter_list']);
        Route::get('edit/{id}', [BackController::class, 'newsletter_edit']);
        Route::post('edit/{id}', [BackController::class, 'newsletter_edit_post']);
        Route::get('delete/{id}', [BackController::class, 'newsletter_delete']);
        Route::get('add', [BackController::class, 'newsletter_add']);
        Route::post('add', [BackController::class, 'newsletter_add_post']);
    });

    # contact management
    Route::group(['prefix' => 'contact'], function () {
        Route::get('list', [BackController::class, 'contact_list']);
        Route::get('edit/{id}', [BackController::class, 'contact_edit']);
        Route::post('edit/{id}', [BackController::class, 'contact_edit_post']);
        Route::get('delete/{id}', [BackController::class, 'contact_delete']);
        Route::get('add', [BackController::class, 'contact_add']);
        Route::post('add', [BackController::class, 'contact_add_post']);
    });

    Route::group(['prefix' => 'news_cat'], function () {
        Route::get('list', [BackController::class, 'news_cat_list']);
        Route::get('edit/{id}', [BackController::class, 'news_cat_edit']);
        Route::post('edit/{id}', [BackController::class, 'news_cat_edit_post']);
        Route::get('delete/{id}', [BackController::class, 'news_cat_delete']);
        Route::get('add', [BackController::class, 'news_cat_add']);
        Route::post('add', [BackController::class, 'news_cat_add_post']);
    });

    Route::group(['prefix' => 'news'], function () {
        Route::get('list', [BackController::class, 'news_list']);
        Route::get('edit/{id}', [BackController::class, 'news_edit']);
        Route::post('edit/{id}', [BackController::class, 'news_edit_post']);
        Route::get('delete/{id}', [BackController::class, 'news_delete']);
        Route::get('add', [BackController::class, 'news_add']);
        Route::post('add', [BackController::class, 'news_add_post']);
    });

    Route::group(['prefix' => 'slider'], function () {
        Route::get('list', [BackController::class, 'slider_list']);
        Route::get('edit/{id}', [BackController::class, 'slider_edit']);
        Route::post('edit/{id}', [BackController::class, 'slider_edit_post']);
        Route::get('delete/{id}', [BackController::class, 'slider_delete']);
        Route::get('add', [BackController::class, 'slider_add']);
        Route::post('add', [BackController::class, 'slider_add_post']);
    });

    # contact_info management
    Route::group(['prefix' => 'contact_info'], function () {
        Route::get('list', [BackController::class, 'contact_info_list']);
        Route::get('edit/{id}', [BackController::class, 'contact_info_edit']);
        Route::post('edit/{id}', [BackController::class, 'contact_info_edit_post']);
        Route::get('delete/{id}', [BackController::class, 'contact_info_delete']);
        Route::get('add', [BackController::class, 'contact_info_add']);
        Route::post('add', [BackController::class, 'contact_info_add_post']);
    });

    Route::group(['prefix' => 'reply'], function () {
        Route::get('replyContact/{id}', [BackController::class, 'reply_contact']);
        Route::post('replyContact/{id}', [BackController::class, 'reply_contact_post']);
    });
});
