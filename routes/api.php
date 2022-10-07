<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\API;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register',[API\UserController::class, 'register']);
Route::post('login',[API\UserController::class,'login']);
Route::post('forget-password',[ API\UserController::class,'forgetPassword']);
Route::post('social-login',[ API\UserController::class, 'socialLogin' ]); // login by social medias accounts

Route::get('user-list',[API\UserController::class, 'userList']); // list users by user_type or country_id or city_id or status or is_deleted (soft delete)  or no filter return per pages

Route::get('staticdata-list',[API\StaticDataController::class,'getList']); // list static data by type or keyword 

Route::get('user-detail',[API\UserController::class, 'userDetail']); // user details 

Route::get('country-list', [ API\CountryController::class, 'getList' ] ); // list countries by status or code or is_deleted (soft delete)  or no filter / return per pages orderded by 'name','asc'

Route::get('country-detail', [ API\CountryController::class, 'getDetail' ] ); // country details 

Route::get('city-list', [ API\CityController::class, 'getList' ] ); // list cities by country_id or name or status or is_deleted (soft delete) or no filter return per pages / return per pages orderded by 'name','asc'

Route::get('city-detail', [ API\CityController::class, 'getDetail' ] ); // city details

Route::get('extracharge-list', [ API\ExtraChargeController::class, 'getList' ] ); // list extra chages by status or city_id or is_deleted (soft delete) or no filter / return per pages orderded by 'title','asc'

Route::get('paymentgateway-list',[API\PaymentGatewayController::class,'getList']);// list paymentgateway by status or no filter / return per pages orderded by 'title','asc'


Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::get('dashboard-detail', [ API\UserController::class, 'dashboard' ]); // dashboard content informations about the app for admins

    Route::post('country-save', [ App\Http\Controllers\CountryController::class, 'store' ] ); //bayna

    Route::post('country-delete/{id}', [ App\Http\Controllers\CountryController::class, 'destroy' ] );//bayna

    Route::post('country-action', [ App\Http\Controllers\CountryController::class, 'action' ] );// forcedelete or restore depending on the request type

    Route::post('city-save', [ App\Http\Controllers\CityController::class, 'store' ] );//bayna
    Route::post('city-delete/{id}', [ App\Http\Controllers\CityController::class, 'destroy' ] );//bayna
    Route::post('city-action', [ App\Http\Controllers\CityController::class, 'action' ] ); // forcedelete or restore depending on the request type


    Route::post('extracharge-save', [ App\Http\Controllers\ExtraChargeController::class, 'store' ] );//bayna
    Route::post('extracharge-delete/{id}', [ App\Http\Controllers\ExtraChargeController::class, 'destroy' ] );//bayna
    Route::post('extracharge-action', [ App\Http\Controllers\ExtraChargeController::class, 'action' ] );  // forcedelete or restore depending on the request type

    
    Route::post('staticdata-save',[ App\Http\Controllers\StaticDataController::class, 'store' ]);//bayna
    Route::post('staticdata-delete/{id}',[ App\Http\Controllers\StaticDataController::class, 'destroy' ]);//bayna

    Route::get('order-list', [ API\OrderController::class, 'getList' ] );// list orders by status or client_id or delivery_man_id or country_id or city_id or from_date && to_date or no filter / return per pages orderded by 'date','desc'
    Route::get('order-detail', [ API\OrderController::class, 'getDetail' ] ); // order details

    Route::post('order-save', [ App\Http\Controllers\OrderController::class, 'store' ] );//bayna
    Route::post('order-update/{id}', [ App\Http\Controllers\OrderController::class, 'update' ] );//bayna
    Route::post('order-delete/{id}', [ App\Http\Controllers\OrderController::class, 'destroy' ] );//bayna

    Route::post('order-action', [ App\Http\Controllers\OrderController::class, 'action' ] ); // forcedelete or restore depending on the request type


    Route::post('paymentgateway-save', [ App\Http\Controllers\PaymentGatewayController::class, 'store' ] );//bayna
    
    Route::post('payment-save', [ API\PaymentController::class, 'paymentSave' ] );// update payment date -> add payment id to order -> save order -> saveorderhistory -> return message +  satus code

    Route::get('payment-list', [ API\PaymentController::class, 'getList' ] );// list all the payments ordered by  'id','desc'  per pages (number pages choosed in request) /return json response

    Route::post('notification-list',[API\NotificationController::class,'getList']); // list notifications listed by created_at  per  pages (number pages choosed in request)  /return json response   
        /* $response = [
            'notification_data' => $items,
            'all_unread_count' => $all_unread_count,
        ];*/
    Route::post('update-user-status',[API\UserController::class, 'updateUserStatus']); //  update user status return json response 
    /*  $response = [
            'data' => new UserResource($user),
            'message' => $message
        ];*/

    Route::post('change-password',[API\UserController::class, 'changePassword']);//bayna
    Route::post('update-profile',[API\UserController::class,'updateProfile']);//bayna

    Route::post('delete-user',[API\UserController::class,'deleteUser']);//bayna

    Route::post('user-action', [ API\UserController::class, 'userAction' ] ); // forcedelete or restore depending on the request type

    Route::post('update-appsetting',[API\UserController::class,'updateAppSetting']);// bayna
    Route::get('get-appsetting',[API\UserController::class,'getAppSetting']); // bayna

    Route::get('document-list', [ API\DocumentController::class, 'getList' ] );//list  the documents ordered by  'id','desc'  per pages (number pages choosed in request) /return json response
    /* $response = [
            'pagination' => json_pagination_response($items),
            'data' => $items,
        ];*/

    Route::post('document-save', [ App\Http\Controllers\DocumentController::class, 'store' ] );//bayna
    Route::post('document-delete/{id}', [ App\Http\Controllers\DocumentController::class, 'destroy' ] );//bayna
    Route::post('document-action', [ App\Http\Controllers\DocumentController::class, 'action' ] );// forcedelete or restore depending on the request type

    Route::get('delivery-man-document-list', [ API\DeliveryManDocumentController::class, 'getList' ] );
    Route::post('delivery-man-document-save', [ App\Http\Controllers\DeliveryManDocumentController::class, 'store' ] );;//bayna
    Route::post('delivery-man-document-delete/{id}', [ App\Http\Controllers\DeliveryManDocumentController::class, 'destroy' ] );;//bayna
    Route::post('delivery-man-document-action', [ App\Http\Controllers\DeliveryManDocumentController::class, 'action' ] );// forcedelete or restore depending on the request type
});