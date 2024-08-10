<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Admin\CityController;
use App\Http\Controllers\Api\Admin\CountryController;
use App\Http\Controllers\Api\Admin\InterestController;
use App\Http\Controllers\Api\Admin\PersonController;
use App\Http\Controllers\Api\Admin\ActivityController;
use App\Http\Controllers\Api\Admin\OrganizationLegalFormController;


use App\Http\Controllers\Api\Admin\AccompanyingEventController;
use App\Http\Controllers\Api\Admin\AccompanyingEventTypeController;
use App\Http\Controllers\Api\Admin\AccompanyingListTypeController;
use App\Http\Controllers\Api\Admin\CalenderController;
use App\Http\Controllers\Api\Admin\EventSeriesController;
use App\Http\Controllers\Api\Admin\EventSpecialityController;
use App\Http\Controllers\Api\Admin\EventTypeController;
use App\Http\Controllers\Api\Admin\OrganizationClassificationController;
use App\Http\Controllers\Api\Admin\OrganizationActivityController;
use App\Http\Controllers\Api\Admin\OrganizationController;
use App\Http\Controllers\Api\Admin\ListTypeController;
use App\Http\Controllers\Api\Admin\EventController;
use App\Http\Controllers\Api\Admin\EventItemController;
use App\Http\Controllers\Api\Admin\EventOrganizationController;
use App\Http\Controllers\Api\Admin\WorkshopTopicController;
use App\Http\Controllers\Api\Admin\ShipperCompanyController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('login', [\App\Http\Controllers\api\admin\AdminAuthController::class, 'login']);
Route::middleware('auth:admin')->post('logout', [\App\Http\Controllers\api\admin\AdminAuthController::class, 'logout']);
Route::middleware('auth:admin')->group(function () {
Route::apiResource('countries',CountryController::class);
Route::apiResource('cities',CityController::class);
Route::apiResource('interests',InterestController::class);
Route::apiResource('persons',PersonController::class);

/** Organization Routes  */
Route::apiResource('activities',ActivityController::class);
Route::apiResource('organization-legal-form',OrganizationLegalFormController::class);
Route::apiResource('organization-classification',OrganizationClassificationController::class);
Route::apiResource('organizations',OrganizationController::class);
Route::apiResource('organization-activity',OrganizationActivityController::class);
/** Event Route  */
Route::apiResource('event-types',EventTypeController::class);
Route::apiResource('event-series',EventSeriesController::class);
Route::apiResource('event-speciality',EventSpecialityController::class);
Route::apiResource('list-types',ListTypeController::class);
Route::apiResource('events',EventController::class);
Route::apiResource('event-items',EventItemController::class);
Route::apiResource('event-organizations',EventOrganizationController::class);
Route::apiResource('event-persons',EventOrganizationController::class);
Route::apiResource('organization-persons',EventOrganizationController::class);

/** Accompanying Event  */
Route::apiResource('accompanying-event-types',AccompanyingEventTypeController::class);
Route::apiResource('accompanying-event',AccompanyingEventController::class);
Route::apiResource('accompanying-list-types',AccompanyingListTypeController::class);
Route::apiResource('calenders',CalenderController::class);
Route::apiResource('Workshop-topics',WorkshopTopicController::class);
Route::apiResource('organization-persons',OrganizationPersonController::class);
Route::apiResource('event_booth_type',EventBoothTypeController::class);
Route::apiResource('space-classification',SpaceClassificationController::class);
Route::apiResource('event-booth',EventBoothController::class);
Route::apiResource('event-space',EventSpaceController::class);



/* Storage Routes */

Route::apiResource('storage',StorageController::class);
Route::apiResource('request-storage',RequestStorageController::class);
Route::apiResource('package',PackageController::class);
Route::apiResource('item-in-package',PackageItemController::class);



/** shipping routes */

Route::apiResource('shipper-company',ShipperCompanyController::class);
Route::apiResource('manifest',\App\Http\Controllers\Api\Admin\ManifestController::class);
Route::apiResource('drivers',\App\Http\Controllers\Api\Admin\DriverController::class);
Route::apiResource('trucks',\App\Http\Controllers\Api\Admin\TruckController::class);





/**  sales Routes */
Route::apiResource('invoices',\App\Http\Controllers\Api\Admin\InvoiceController::class);
Route::apiResource('invoice_details',\App\Http\Controllers\Api\Admin\InvoiceDetailController::class);



/**  messages Routes */
Route::apiResource('messages',MessageController::class);
Route::apiResource('messages-classfication',MessageClassificationController::class);
Route::apiResource('repalies',ReplayController::class);
});

