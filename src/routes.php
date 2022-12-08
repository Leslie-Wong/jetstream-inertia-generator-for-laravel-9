<?php
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('language/{language}', function ($language) {
    Session()->put('locale', $language);

    return redirect()->back();
})->name('language');

Route::middleware(['auth:sanctum', 'verified'])->get('/admin', function () {
    return Inertia::render('AdminDashboard');
})->name('admin.dashboard');
