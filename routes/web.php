<?php
// routes/web.php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\DocumentController as AdminDocumentController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Manager\DashboardController as ManagerDashboardController;
use App\Http\Controllers\Manager\ProductController as ManagerProductController;
use App\Http\Controllers\Manager\CategoryController as ManagerCategoryController;
use App\Http\Controllers\Manager\DocumentController as ManagerDocumentController;
use App\Http\Controllers\Customer\HomeController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\OrderController as CustomerOrderController;

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('products', AdminProductController::class);
    Route::resource('categories', AdminCategoryController::class);
    Route::resource('documents', AdminDocumentController::class);
    Route::resource('orders', AdminOrderController::class);
});

// Manager Routes
Route::middleware(['auth', 'role:manager'])->prefix('manager')->name('manager.')->group(function () {
    Route::get('/dashboard', [ManagerDashboardController::class, 'index'])->name('dashboard');
    Route::resource('products', ManagerProductController::class);
    Route::resource('categories', ManagerCategoryController::class);
    Route::resource('documents', ManagerDocumentController::class);
});

// Customer Routes
Route::middleware(['auth', 'role:customer'])->name('customer.')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/products', [HomeController::class, 'products'])->name('products');
    Route::get('/products/{product}', [HomeController::class, 'show'])->name('products.show');
    
    Route::resource('cart', CartController::class);
    Route::post('/cart/add/{product}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::delete('/cart/remove/{cart}', [CartController::class, 'removeFromCart'])->name('cart.remove');
    
    Route::resource('orders', CustomerOrderController::class);
    Route::post('/checkout', [CustomerOrderController::class, 'checkout'])->name('checkout');
});

// Redirect based on role after login
Route::get('/home', function () {
    if (Auth::user()->isAdmin()) {
        return redirect()->route('admin.dashboard');
    } elseif (Auth::user()->isManager()) {
        return redirect()->route('manager.dashboard');
    } else {
        return redirect()->route('customer.home');
    }
})->middleware('auth');
