<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DiscountCoupon;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\TempImageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\SubcriberController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\AccessoriesController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

Route::get('/df', function () {
    return view('welcome');
});


// Admin Routes
  

    
Route::get('/Admin/Dashboard', [AdminController::class, 'dashboard'])->name('home');
Route::get('/Admin/Category', [AdminController::class, 'category'])->name('category');
Route::get('/Admin/Sub-Category', [AdminController::class, 'Subcategory'])->name('Subcategory');
Route::get('/Admin/Accessories', [AdminController::class, 'acccessoire'])->name('acccessoire');
Route::get('/Admin/Product', [AdminController::class, 'product'])->name('product');
Route::get('/Admin/Order', [AdminController::class, 'order'])->name('order');
Route::get('/Admin/Order-Detail/{id}', [AdminController::class, 'OrderDetail'])->name('order-detail');
Route::get('/Admin/Discount', [AdminController::class, 'discount'])->name('discount');
Route::get('/Admin/User', [AdminController::class, 'user'])->name('user');
Route::get('/Admin/News', [AdminController::class, 'news'])->name('news');
Route::get('/Admin/contactus', [AdminController::class, 'contact'])->name('admin.contact');
Route::get('/Admin/feedback', [AdminController::class, 'feedback'])->name('admin.feedback');
Route::get('/Admin/Wishlist', [AdminController::class, 'Wishlist'])->name('admin.Wishlist');
Route::delete('/Admin/feedback-Destroy/{id}', [AdminController::class, 'feedbackdestroy'])->name('deletefeedback');
Route::delete('/Admin/contactdestroy/{id}', [AdminController::class, 'contactdestroy'])->name('deleteContact');
Route::post('/Admin/Change-Status/{id}', [OrderController::class, 'ChangrStatus'])->name('Change-Status');
Route::post('/Admin/Send-Invioce-Email/{id}', [OrderController::class, 'SendInvioceEmail'])->name('Send-Invioce-Email');

// User Delete Route
Route::delete('/Admin/Delete-User/{id}', [AdminController::class, 'DeleteUser'])->name('Delete-User');


// Category Routes
Route::get('/Admin/Create-Category', [CategoryController::class, 'create'])->name('Create-Category');
Route::post('/Admin/Store-Category', [CategoryController::class, 'store'])->name('Store-Category');
Route::get('/Admin/Edit-Category/{id}', [CategoryController::class, 'edit'])->name('Edit-Category');
Route::post('/Admin/Update-Category/{id}', [CategoryController::class, 'update'])->name('Update-Category');
Route::delete('/Admin/Delete-Category/{id}', [CategoryController::class, 'destroy'])->name('Delete-Category');






// Product Routes
Route::get('/Admin/Create-Product', [ProductController::class, 'create'])->name('Create-Product');
Route::post('/Admin/Store-Product', [ProductController::class, 'store'])->name('Store-product');
Route::get('/Admin/Edit-product/{id}', [ProductController::class, 'edit'])->name('Edit-product');
Route::post('/Admin/Update-product/{id}', [ProductController::class, 'update'])->name('Update-product');
Route::delete('/Admin/Delete-Product/{id}', [ProductController::class, 'destroy'])->name('Delete-product');
Route::get('/Admin/Get-Product', [ProductController::class, 'getProduct'])->name('get-product');



// Product Routes
Route::get('/Admin/Create-Accessorie', [AccessoriesController::class, 'create'])->name('Create-Accessorie');
Route::post('/Admin/Store-Accessorie', [AccessoriesController::class, 'store'])->name('Store-Accessorie');
Route::get('/Admin/Edit-Accessorie/{id}', [AccessoriesController::class, 'edit'])->name('Edit-Accessorie');
Route::post('/Admin/Update-Accessorie/{id}', [AccessoriesController::class, 'update'])->name('Update-Accessorie');
Route::delete('/Admin/Delete-Accessorie/{id}', [AccessoriesController::class, 'destroy'])->name('Delete-Accessorie');


// News Routes
Route::get('/Admin/Create-News', [NewsController::class, 'create'])->name('Create-News');
Route::post('/Admin/Store-News', [NewsController::class, 'store'])->name('Store-News');
Route::get('/Admin/Edit-News/{id}', [NewsController::class, 'edit'])->name('Edit-News');
Route::post('/Admin/Update-News/{id}', [NewsController::class, 'update'])->name('Update-News');
Route::delete('/Admin/Delete-News/{id}', [NewsController::class, 'destroy'])->name('Delete-News');



// Shipping Routes
Route::get('/Admin/Shipping', [ShippingController::class, 'create'])->name('Shipping');
Route::post('/Admin/Store-Shipping', [ShippingController::class, 'store'])->name('Store-shipping');
Route::get('/Admin/Edit-Shipping/{id}', [ShippingController::class, 'edit'])->name('Edit-Shipping');
Route::post('/Admin/Update-Shipping/{id}', [ShippingController::class, 'update'])->name('Update-Shipping');
Route::delete('/Admin/Delete-Shipping/{id}', [ShippingController::class, 'destroy'])->name('Delete-Shipping');



// Discount Coupons Routes
Route::get('/Admin/Create-Discount-Coupon', [DiscountCoupon::class, 'create'])->name('Create-Discount-Coupon');
Route::post('/Admin/Store-Dicount-Coupon', [DiscountCoupon::class, 'store'])->name('Store-Dicount-Coupon');
Route::get('/Admin/Edit-Discount-Coupon/{id}', [DiscountCoupon::class, 'edit'])->name('Edit-Discount-Coupon');
Route::post('/Admin/Update-Dicount-Coupon/{id}', [DiscountCoupon::class, 'update'])->name('Update-Dicount-Coupon');
Route::delete('/Admin/Delete-Disount-Coupon/{id}', [DiscountCoupon::class, 'destroy'])->name('Delete-Disount-Coupon');





// Product image Routes
Route::post('/Admin/product-Images/Updated', [ProductImageController::class, 'update'])->name('Update-product-image');
Route::delete('/Admin/product-image/Deleted', [ProductImageController::class, 'destroy'])->name('Delete-product-image');


Route::post('/Admin/Temp-Images', [TempImageController::class, 'create'])->name('Temp-image');

// Excel Download Routes

Route::get('Admin/User-Export', [ExcelController::class, 'userExcel'])->name('User-Export');
Route::get('Admin/Order-Export', [ExcelController::class, 'OrderExcel'])->name('Order-Export');







// Front Route
Route::get('/', [FrontController::class, 'index'])->name('Front.index');
Route::get('/About-Us', [FrontController::class, 'about'])->name('Front.about');
Route::get('/Service', [FrontController::class, 'service'])->name('Front.service');
Route::get('/Contact-Us', [FrontController::class, 'contact'])->name('Front.contact');
Route::get('/Gallery', [FrontController::class, 'gallery'])->name('Front.gallery');
Route::get('/404', [FrontController::class, 'error'])->name('Front.error');
Route::get('/Shop/{category?}', [FrontController::class, 'shop'])->name('Front.shop');
Route::get('/Cart', [FrontController::class, 'cart'])->name('Front.cart');
Route::get('/Checkout', [FrontController::class, 'checkout'])->name('Front.checkout');
Route::get('/Product-Detail/{slug}', [FrontController::class, 'productDetail'])->name('Front.product-detail');
Route::get('/Accessorie-Detail/{slug}', [FrontController::class, 'accessorieDetail'])->name('Front.accessorie-detail');
Route::post('/Send-Contact-Email', [FrontController::class, 'SendContactEmal'])->name('Send-Contact-Email');
Route::post('/Store-Feedback', [FrontController::class, 'StoreFeedback'])->name('StoreFeedback');



// Profile Route

Route::get('/My-Profile', [UserProfileController::class, 'account'])->name('Profile.account');
Route::get('/My-Orders', [UserProfileController::class, 'order'])->name('Profile.order');
Route::get('/Order-Detail/{id}', [UserProfileController::class, 'orderDetail'])->name('Profile.order-detail');
Route::get('/My-Wishlist', [UserProfileController::class, 'wishlist'])->name('Profile.wishlist');
Route::get('/Change-Password', [UserProfileController::class, 'changePassword'])->name('Profile.change-password');
Route::get('/Cancel-Order/{id}', [UserProfileController::class, 'cancelOrder'])->name('Profile.cancel-order');
Route::get('/Download-Order-PDF/{id}', [UserProfileController::class, 'DownloadPDF'])->name('Download-Order-PDF');



// Cart
Route::post('/Creto/Add-To-Cart',[CartController::class,"AddtoCart"])->name("Add-to-Cart");
Route::post('/Creto/Update-Cart',[CartController::class,"UpdateCart"])->name("Update-Cart");
Route::post('/Creto/Delete-Cart',[CartController::class,"DeleteCart"])->name("Delete-Cart");
Route::post('/Creto/Proceed',[CartController::class,"proceed"])->name("Proceed");
Route::post('/Creto/Get-Order-Summary',[CartController::class,"getOrderSummary"])->name("getOrderSummary");
Route::post('/Creto/Get-Discount-Summary',[CartController::class,"GetDiscountSummary"])->name("Get-Discount-Summary");
Route::post('/Creto/Remove-Coupon',[CartController::class,"RemoveCoupon"])->name("Remove-Coupon");



  // Wishlist Routes
  Route::post('/Creto/Store-Wishlist', [WishlistController::class, 'store'])->name('Store-Wishlist');
  Route::delete('/Admin/Remove-Wishlist/{id}', [WishlistController::class, 'destroy'])->name('Remove-Wishlist');


  // Rating Routes
  Route::post('/Creto/Store-Rating/{id}', [RatingController::class, 'store'])->name('Store-Rating');
  Route::get('/Creto/Ratings/', [RatingController::class, 'index'])->name('Rating');
  Route::post('/Creto/Change-Rating-Status/{id}', [RatingController::class, 'ChangeStatus'])->name('Change-Rating-Status');
  Route::delete('/Creto/Delete-Rating/{id}', [RatingController::class, 'destroy'])->name('Delete-Rating');
  Route::get('/Creto/Rating-Detail/{id}', [RatingController::class, 'show'])->name('Show-Rating');




Route::get('Admin/getSlug', function(Request $request){

    $slug ='';
 if(!empty($request->input('title'))){
    $slug = Str::slug($request->input('title'));
 }
 return response()->json([
    'status' => true,
    'slug' => $slug,
 ]);

 
})->name('GetSlug');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
