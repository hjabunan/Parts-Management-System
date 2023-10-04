<?php

use App\Http\Controllers\ActivityLog;
use App\Http\Controllers\PartsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
->name('logout');

Route::redirect(uri:'/', destination:'login');

Route::get('/dashboard', function () {

    $parts = DB::table('parts')
                    ->select('parts.id','parts.partno','parts.partname','parts_brands.name','parts.price','parts.status','parts.is_deleted')
                    ->leftJoin('parts_brands','parts.brand','parts_brands.id')
                    ->where('parts.is_deleted','0')->paginate(25);
    $brands = DB::table('parts_brands')->get();
    return view('dashboard',compact('parts','brands'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/batch', function () {
    return view('batch');
})->middleware(['auth', 'verified'])->name('batch');

Route::get('/activity', function () {
    $activity = DB::table('pms_activity_logs')
        ->select('table', 'table_key', 'action', 'description', 'field', 'before', 'after', 'name', 'ipaddress','pms_activity_logs.created_at','pms_activity_logs.updated_at')
        ->leftJoin('pms_users', 'pms_activity_logs.user_id', 'pms_users.id')
        ->whereIn('pms_activity_logs.id', function ($query) {
            $query->select(DB::raw('MIN(id)'))
                ->from('pms_activity_logs')
                ->groupBy('table_key');
        })
        ->get();

    return view('activity', compact('activity'));
})->middleware(['auth', 'verified'])->name('activity');

Route::get('/user_management', function () {
    $users = DB::table('pms_users')
                    ->get();
    return view('user_management',compact('users'));
})->middleware(['auth', 'verified'])->name('user_management');

// Route::get('/batch', [UserController::class, 'index'])->name('user.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::GET('/dashboard/getParts', [PartsController::class, 'getParts'])->name('dashboard.getParts');
Route::POST('/dashboard/saveParts', [PartsController::class, 'saveParts'])->name('dashboard.saveParts');
Route::POST('/dashboard/deleteParts', [PartsController::class, 'deleteParts'])->name('dashboard.deleteParts');
Route::GET('/dashboard/search', [PartsController::class, 'search'])->name('dashboard.search');

Route::POST('/batch/upload', [UploadController::class, 'upload'])->name('parts.upload');

Route::GET('/activity/getLogs', [ActivityLog::class, 'getLogs'])->name('activity.getLogs');

Route::POST('/user_management/saveUser', [UserController::class, 'saveUser'])->name('user_management.saveUser');
Route::POST('/user_management/viewUser', [UserController::class, 'viewUser'])->name('user_management.viewUser');

require __DIR__.'/auth.php';
