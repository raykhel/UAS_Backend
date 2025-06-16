<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

route::get("/", [ProductController::class, 'index'])->name('index.index');