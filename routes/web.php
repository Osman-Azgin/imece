<?php

use App\Http\Livewire\AdminTeamEditPage;
use App\Http\Livewire\AdminTeamsPage;
use App\Http\Livewire\MyImece;
use App\Http\Livewire\MyRequirementsPage;
use App\Http\Livewire\RequirementDetailPage;
use App\Http\Livewire\RequirementsPage;
use App\Http\Livewire\WarehouseEditPage;
use App\Http\Livewire\WarehousesPage;
use App\Models\Requirement;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

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

Route::get('/', function () {
    $currentRequirements=Requirement::join("warehouses","warehouses.id","=","requirements.warehouse_id")
        ->leftJoin("imeces","imeces.requirement_id","=","requirements.id")->groupBy("requirements.id")->groupBy("requirements.warehouse_id")->groupBy("requirements.in_kind_donation_id")
        ->groupBy("requirements.created_at")->groupBy("requirements.updated_at")
        ->having(DB::raw("COUNT(imeces.id)"),"<",1)->select(DB::raw("requirements.*,COUNT(imeces.id) AS imeceCount"))
        ->orderBy("requirements.id","desc")->get();
    return view('welcome',["currentRequirements"=>$currentRequirements]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get("/admin/teams",AdminTeamsPage::class)
        ->name("admin-teams")->middleware("isAdmin");
    Route::get("/admin/team/{team_id}",AdminTeamEditPage::class)
        ->middleware("isAdmin");

    Route::middleware("verifiedTeam")->group(function () {
        Route::get("/warehouses",warehousesPage::class)->name("warehouses");
        Route::get("/warehouse",warehouseEditPage::class)->name("warehouse");
        Route::get("/warehouse/{warehouse_id}",warehouseEditPage::class)->name("single-warehouse");


        Route::get("/requirements",requirementsPage::class)->name("requirements");
        Route::get("/requirement/{requirement_id}",requirementDetailPage::class)->name("requirement-detail");
        Route::get("/requirement",requirementDetailPage::class)->name("new-requirement");
        Route::get("/myrequirements",myRequirementsPage::class)->name("myrequirements");

        Route::get("/my-imece",MyImece::class)->name("imeces");
    });

});

Route::get('/greeting/{locale}', function ($locale) {
    if (! in_array($locale, ['en', 'tr'])) {
        abort(400);
    }

    App::setLocale($locale);

    return redirect()->back();
});
