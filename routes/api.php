<?php

use App\Http\Controllers\AuthApiManager;
use App\Http\Controllers\DeliveryBoyManager;
use App\Http\Controllers\OrderManager;
use App\Http\Controllers\ProductManager;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerManager;
use App\Http\Controllers\CarrierManager;
use App\Http\Controllers\CartManager;
use App\Http\Controllers\CartProductManager;
use App\Http\Controllers\CategoryManager;
use App\Http\Controllers\ClientManager;
use App\Http\Controllers\ClientAddressManager;
use App\Http\Controllers\CountryManager;
use App\Http\Controllers\CurrencyManager;
use App\Http\Controllers\CurrencyRateManager;
use App\Http\Controllers\LanguageManager;
use App\Http\Controllers\ManufacturerManager;
use App\Http\Controllers\PaymentManager;
use App\Http\Controllers\StateManager;
use App\Http\Controllers\TaxManager;
use App\Http\Controllers\UserManager;


Route::any("/users/login", [AuthApiManager::class, "login"]);
Route::any("/users/register", [AuthApiManager::class, "registration"]);

Route::get('/users', [UserManager::class, 'listUsers']);
Route::post('/users/register', [UserManager::class, 'register']);
Route::post('/users/update', [UserManager::class, 'updateUser']);
Route::post('/users/delete', [UserManager::class, 'deleteUser']);

Route::any("/users/delivery", [DeliveryBoyManager::class, "getDelivery"]);
Route::any("/users/delivery/success", [DeliveryBoyManager::class, "markStatusSuccess"]);
Route::any("/users/delivery/failed", [DeliveryBoyManager::class, "markStatusFailed"]);

Route::get('/carriers/active', [CarrierManager::class, 'getActiveCarriers']);
Route::post('/carriers/activate', [CarrierManager::class, 'activate']);
Route::post('/carriers/deactivate', [CarrierManager::class, 'deactivate']);

Route::get('/countries/active', [CountryManager::class, 'getActiveCountries']);
Route::post('/countries/activate', [CountryManager::class, 'markActive']);
Route::post('/countries/deactivate', [CountryManager::class, 'markInactive']);

Route::post('/clients/list', [ClientManager::class, 'getClients']);
Route::post('/clients/activate', [ClientManager::class, 'activate']);
Route::post('/clients/deactivate', [ClientManager::class, 'deactivate']);

Route::get('/currencies/active', [CurrencyManager::class, 'getActiveCurrencies']);
Route::post('/currencies/activate', [CurrencyManager::class, 'activate']);
Route::post('/currencies/deactivate', [CurrencyManager::class, 'deactivate']);

Route::post('/currency-rates/list', [CurrencyRateManager::class, 'getRates']);
Route::post('/currency-rates/update', [CurrencyRateManager::class, 'updateRate']);

Route::post('/client/addresses', [ClientAddressManager::class, 'getAddresses']);
Route::post('/client/address/activate', [ClientAddressManager::class, 'markStatusActive']);
Route::post('/client/address/deactivate', [ClientAddressManager::class, 'markStatusInactive']);

Route::post('/cart/list', [CartManager::class, 'getCart']);
Route::post('/cart/activate', [CartManager::class, 'markActive']);
Route::post('/cart/deactivate', [CartManager::class, 'markInactive']);

Route::post('/cart/products/list', [CartProductManager::class, 'getCartItems']);
Route::post('/cart/products/update', [CartProductManager::class, 'updateQuantity']);
Route::post('/cart/products/remove', [CartProductManager::class, 'removeItem']);

Route::get('/languages/active', [LanguageManager::class, 'getActiveLanguages']);
Route::post('/languages/activate', [LanguageManager::class, 'activate']);
Route::post('/languages/deactivate', [LanguageManager::class, 'deactivate']);

Route::get('/manufacturers/active', [ManufacturerManager::class, 'getActiveManufacturers']);
Route::post('/manufacturers/activate', [ManufacturerManager::class, 'activate']);
Route::post('/manufacturers/deactivate', [ManufacturerManager::class, 'deactivate']);

Route::any("/product/list", [ProductManager::class, "getProducts"]);

Route::get('/payments/active', [PaymentManager::class, 'getActivePayments']);
Route::post('/payments/activate', [PaymentManager::class, 'activate']);
Route::post('/payments/deactivate', [PaymentManager::class, 'deactivate']);

Route::post('/states/active', [StateManager::class, 'getActiveStates']);
Route::post('/states/activate', [StateManager::class, 'activate']);
Route::post('/states/deactivate', [StateManager::class, 'deactivate']);

Route::get('/taxes', [TaxManager::class, 'getTaxes']);
Route::post('/taxes/update', [TaxManager::class, 'updateTax']);

Route::get('/categories/active', [CategoryManager::class, 'getActiveCategories']);
Route::post('/categories/activate', [CategoryManager::class, 'markStatusActive']);
Route::post('/categories/deactivate', [CategoryManager::class, 'markStatusInactive']);

Route::any("/users/cart/add", [OrderManager::class, "addToCart"]);
Route::any("/users/cart/remove", [OrderManager::class, "removeFromCart"]);
Route::any("/users/cart/list", [OrderManager::class, "getCart"]);
Route::any("/users/cart/confirm", [OrderManager::class, "confirmCart"]);
Route::any("/users/cart/clear", [OrderManager::class, "clearCart"]);
Route::any("/users/orders/list", [OrderManager::class, "getOrders"]);

Route::any("/users/address/update", [CustomerManager::class, "updateAddress"]);
