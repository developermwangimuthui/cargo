<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductSizeController;
use App\Http\Controllers\ProductTypeController;
use App\Http\Controllers\PackageStyleController;
use App\Http\Controllers\TruckTypeController;
use App\Http\Controllers\TruckSizeController;
use App\Http\Controllers\DrivingYearController;
use App\Http\Controllers\LicensePlateColorController;
use App\Http\Controllers\TruckBrandController;
use App\Http\Controllers\TruckModelController;
use App\Http\Controllers\CarrierLengthController;
use App\Http\Controllers\TruckRequirementController;
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



Route::get('/', [HomeController::class,'index'])->name('dashboard');
//...................ProductCategory.......................//
Route::get('/product/category', [ProductCategoryController::class,'index'])->name('product.category');
Route::post('/product/category/store', [ProductCategoryController::class,'store'])->name('product.category.store');
Route::get('/product/category/edit/{id}', [ProductCategoryController::class,'edit'])->name('product.category.edit');
Route::post('/product/category/update/{id}', [ProductCategoryController::class,'update'])->name('product.category.update');
Route::delete('/product/category/destroy/', [ProductCategoryController::class,'destroy'])->name('product.category.destroy');
//...................ProductSizeController.......................//
Route::get('/product/size', [ProductSizeController::class,'index'])->name('product.size');
Route::post('/product/size/store', [ProductSizeController::class,'store'])->name('product.size.store');
Route::get('/product/size/edit/{id}', [ProductSizeController::class,'edit'])->name('product.size.edit');
Route::post('/product/size/update/{id}', [ProductSizeController::class,'update'])->name('product.size.update');
Route::delete('/product/size/destroy', [ProductSizeController::class,'destroy'])->name('product.size.destroy');
//...................ProductTypeController.......................//
Route::get('/product/type', [ProductTypeController::class,'index'])->name('product.type');
Route::get('/product/type/edit/{id}', [ProductTypeController::class,'edit'])->name('product.type.edit');
Route::post('/product/type/store', [ProductTypeController::class,'store'])->name('product.type.store');
Route::post('/product/type/update/{id}', [ProductTypeController::class,'update'])->name('product.type.update');
Route::delete('/product/type/destroy/', [ProductTypeController::class,'destroy'])->name('product.type.destroy');
//...................PackageStyleController.......................//
Route::get('/packaging/style', [PackageStyleController::class,'index'])->name('packaging.style');
Route::post('/packaging/style/store', [PackageStyleController::class,'store'])->name('packaging.style.store');
Route::get('/packaging/style/edit/{id}', [PackageStyleController::class,'edit'])->name('packaging.style.edit');
Route::post('/packaging/style/update/{id}', [PackageStyleController::class,'update'])->name('packaging.style.update');
Route::delete('/packaging/style/destroy/', [PackageStyleController::class,'destroy'])->name('packaging.style.destroy');
//...................TruckTypeController.......................//
Route::get('/truck/type', [TruckTypeController::class,'index'])->name('truck.type');
Route::post('/truck/type/store', [TruckTypeController::class,'store'])->name('truck.type.store');
Route::get('/truck/type/edit/{id}', [TruckTypeController::class,'edit'])->name('truck.type.edit');
Route::post('/truck/type/update/{id}', [TruckTypeController::class,'update'])->name('truck.type.update');
Route::delete('/truck/type/destroy/', [TruckTypeController::class,'destroy'])->name('truck.type.destroy');
//...................TruckSizeController.......................//
Route::get('/truck/size', [TruckSizeController::class,'index'])->name('truck.size');
Route::post('/truck/size/store', [TruckSizeController::class,'store'])->name('truck.size.store');
Route::get('/truck/size/edit/{id}', [TruckSizeController::class,'edit'])->name('truck.size.edit');
Route::post('/truck/size/update/{id}', [TruckSizeController::class,'update'])->name('truck.size.update');
Route::delete('/truck/size/destroy/', [TruckSizeController::class,'destroy'])->name('truck.size.destroy');
//...................DrivingYearController.......................//
Route::get('/driving/year', [DrivingYearController::class,'index'])->name('driving.year');
Route::post('/driving/year/store', [DrivingYearController::class,'store'])->name('driving.year.store');
Route::get('/driving/year/edit/{id}', [DrivingYearController::class,'edit'])->name('driving.year.edit');
Route::post('/driving/year/update/{id}', [DrivingYearController::class,'update'])->name('driving.year.update');
Route::delete('/driving/year/destroy/', [DrivingYearController::class,'destroy'])->name('driving.year.destroy');
//...................LicensePlateColorController.......................//
Route::get('/license/plate/color', [LicensePlateColorController::class,'index'])->name('license.plate.color');
Route::post('/license/plate/color/store', [LicensePlateColorController::class,'store'])->name('license.plate.color.store');
Route::get('/license/plate/color/edit/{id}', [LicensePlateColorController::class,'edit'])->name('license.plate.color.edit');
Route::post('/license/plate/color/update/{id}', [LicensePlateColorController::class,'update'])->name('license.plate.color.update');
Route::delete('/license/plate/color/destroy/', [LicensePlateColorController::class,'destroy'])->name('license.plate.color.destroy');
//...................TruckBrandController.......................//
Route::get('/truck/brand', [TruckBrandController::class,'index'])->name('truck.brand');
Route::post('/truck/brand/store', [TruckBrandController::class,'store'])->name('truck.brand.store');
Route::get('/truck/brand/edit/{id}', [TruckBrandController::class,'edit'])->name('truck.brand.edit');
Route::post('/truck/brand/update/{id}', [TruckBrandController::class,'update'])->name('truck.brand.update');
Route::delete('/truck/brand/destroy/', [TruckBrandController::class,'destroy'])->name('truck.brand.destroy');
//...................TruckModelController.......................//
Route::get('/truck/model', [TruckModelController::class,'index'])->name('truck.model');
Route::get('/getTruckModels', [TruckModelController::class,'getMakeModels'])->name('getTruckModels');
Route::post('/truck/model/store', [TruckModelController::class,'store'])->name('truck.model.store');
Route::get('/truck/model/edit/{id}', [TruckModelController::class,'edit'])->name('truck.model.edit');
Route::post('/truck/model/update/{id}', [TruckModelController::class,'update'])->name('truck.model.update');
Route::delete('/truck/model/destroy/', [TruckModelController::class,'destroy'])->name('truck.model.destroy');
//...................CarrierLengthController.......................//
Route::get('/carrier/length', [CarrierLengthController::class,'index'])->name('carrier.length');
Route::post('/carrier/length/store', [CarrierLengthController::class,'store'])->name('carrier.length.store');
Route::get('/carrier/length/edit/{id}', [CarrierLengthController::class,'edit'])->name('carrier.length.edit');
Route::post('/carrier/length/update/{id}', [CarrierLengthController::class,'update'])->name('carrier.length.update');
Route::delete('/carrier/length/destroy/', [CarrierLengthController::class,'destroy'])->name('carrier.length.destroy');
//...................TruckRequirementController.......................//
Route::get('/truck/requirements', [TruckRequirementController::class,'index'])->name('truck.requirements');
Route::post('/truck/requirements/store', [TruckRequirementController::class,'store'])->name('truck.requirements.store');
Route::get('/truck/requirements/edit/{id}', [TruckRequirementController::class,'edit'])->name('truck.requirements.edit');
Route::post('/truck/requirements/update/{id}', [TruckRequirementController::class,'update'])->name('truck.requirements.update');
Route::delete('/truck/requirements/destroy/', [TruckRequirementController::class,'destroy'])->name('truck.requirements.destroy');
