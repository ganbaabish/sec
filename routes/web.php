<?php
    //Libraries
        use Illuminate\Support\Facades\Route;
        use App\Http\Controllers\HomeController;
        use App\Http\Controllers\AdminController;
        use App\Http\Controllers\LoginController;


    //Auth routes
        Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('login', [LoginController::class, 'login']);
        Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    //Home routes
        Route::get('/', [HomeController::class, 'index']);
        Route::post('/update/ref', [HomeController::class, 'update_ref']);
        Route::get('/settings', [HomeController::class, 'settings']);

    //Admin routes
        Route::get('/user_management', [AdminController::class, 'user_management']);
        Route::post('/add/user', [AdminController::class, 'add_user']);
        Route::post('/update/user/permission', [AdminController::class, 'update_user_permission']);
        Route::get('/ref_management', [AdminController::class, 'ref_management']);
        Route::post('/add/ref', [AdminController::class, 'add_ref']);
        Route::post('/add/ctnr', [AdminController::class, 'add_ctnr']);
        Route::post('/add/vehicle', [AdminController::class, 'add_vehicle']);
        Route::get('/history', [AdminController::class, 'history']);