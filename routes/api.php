<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\ExpensesController;
 
// List all expenses
 Route::get('expenses', 'App\Http\Controllers\ExpensesController@getAllExpenses');

// List a specific expense
 Route::get('expenses/{id}', 'App\Http\Controllers\ExpensesController@getExpense');

// Create one expense
 Route::post('expenses', 'App\Http\Controllers\ExpensesController@createExpense');

// Update one expense
 Route::put('expenses/{id}', 'App\Http\Controllers\ExpensesController@updateExpense');

// Delete one expense
 Route::delete('expenses/{id}', 'App\Http\Controllers\ExpensesController@deleteExpense');
