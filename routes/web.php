<?php

use App\Http\Livewire\ChartComponent;
use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\SettingComponent;
use App\Models\Settings;
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

Route::get('/', HomeComponent::class)->name('home');
Route::get('/settings', SettingComponent::class)->name('Settings');
Route::get('/search/{id?}/from{from_date}/to{to_date}', ChartComponent::class)->name('search');
