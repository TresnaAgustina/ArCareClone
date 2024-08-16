<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', fn() => view('pages.auth.login'));
Route::get('/user/dashboard', fn() => view('pages.user.dashboard'));
Route::get('/user/ticket', fn() => view('pages.user.ticket.view.view_ticket_user'));
Route::get('/user/ticket/incoming', fn() => view('pages.user.ticket.view.incoming'));
Route::get('/user/ticket/process', fn() => view('pages.user.ticket.view.process'));
Route::get('/user/ticket/add', fn() => view('pages.user.ticket.add_ticket'));
