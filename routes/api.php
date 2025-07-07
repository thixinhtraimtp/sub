<?php

use App\Http\Controllers\Api\Document\ApiDocumentController;
use App\Http\Controllers\Api\Order\OrderController;
use App\Http\Controllers\Api\Order\OrderVController;
use App\Http\Controllers\Api\Order\OrderProductionController;
use App\Http\Controllers\CronJob\RechargeCronJobController;
use App\Http\Controllers\CronJob\ServerActionController;
use App\Http\Controllers\CronJob\StatusOrderServiceController;
use App\Http\Controllers\CronJob\TelegramController;
use App\Http\Controllers\CronJob\PaymentController;
use App\Http\Controllers\CronJob\TestController;
use App\Http\Controllers\CronJob\PriceController;
use App\Http\Controllers\CronJob\OrderDataController;
use App\Http\Controllers\CronJob\CardController;
use App\Http\Controllers\Tool\ToolController;
use App\Library\CloudflareController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use function Pest\Laravel\json;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');




Route::get('v2', [OrderController::class, 'createV2Order'])->name('cron-job.order.service');
Route::post('v2', [OrderController::class, 'createV2Order'])->name('cron-job.order.service');
Route::get('update', [StatusOrderServiceController::class, 'UpdateService'])->name('cron-job.update');
Route::get('order/data/{time}', [OrderDataController::class, 'dataOrder'])->name('cron-job.order.data');
Route::prefix('v1')->group(function () {
    Route::get('status/order', [StatusOrderServiceController::class, 'cronService'])->name('cron-job.status.service');
    Route::get('refund/order', [StatusOrderServiceController::class, 'refundAllOrders'])->name('cron-job.refund.order');
    Route::get('get/services', [ToolController::class, 'getServices'])->name('ndh.get.services');
    Route::get('get/order', [ToolController::class, 'getOrder'])->name('ndh.get.order');
    Route::get('price/smm', [PriceController::class, 'checkPriceService'])->name('cron-job.price.smm');
    Route::post('start/create/order', [OrderController::class, 'createOrder'])->name('api.create.order')->middleware('xss');
    Route::post('create/order', [OrderVController::class, 'createOrder'])->name('api.v2.create.order')->middleware('xss');
    Route::post('order/refund', [OrderController::class, 'refundOrder'])->name('api.refund.order')->middleware('xss');
    Route::post('order/warranty', [OrderController::class, 'warrantyOrder'])->name('api.warranty.order')->middleware('xss');
    Route::post('order/update', [OrderController::class, 'updateOrder'])->name('api.update.order')->middleware('xss');
    // gia hạn dịch vụ (có thể là gia hạn đơn hoặc gia hạn dịch vụ)
    Route::post('order/renews', [OrderController::class, 'renewOrder'])->name('api.renew.order')->middleware('xss');
    Route::get('cronJob/recharge/{code}', [RechargeCronJobController::class, 'payment'])->name('api.payment');
    Route::get('recharge/bill', [PaymentController::class, 'cronPayment'])->name('api.bill');
    Route::get('callback/card', [CardController::class, 'cronRecharge'])->name('api.card');
    Route::prefix('tools')->group(function () {
        Route::get('get-uid', [ToolController::class, 'getUid'])->name('tools.get-uid');
    });
    Route::get('price-service/{service}', [PriceController::class, 'checkPriceService'])->name('api.price-service');
    Route::get('update/price', [PriceController::class, 'updatePriceService'])->name('cron-job.update-price');
});

Route::prefix('product')->group(function () {
    Route::get('categories', [OrderProductionController::class, 'getCategories'])->name('api.product.categories');
    Route::get('/{slug}', [OrderProductionController::class, 'getProductBySlug'])->name('api.product.product-by-slug');
    Route::post('order', [OrderProductionController::class, 'orderProduct'])->name('api.product.order');
});

Route::prefix('lt')->group(function () {
    Route::get('get/me', [ApiDocumentController::class, 'getMe'])->name('api-document.get-me');

    Route::prefix('services')->group(function () {
        Route::get('/', [ApiDocumentController::class, 'getServices'])->name('api-document.get-services');
        Route::get('servers', [ApiDocumentController::class, 'getServersByServices'])->name('api-document.get-servers');
        Route::get('{id}', [ApiDocumentController::class, 'getServiceById'])->name('api-document.get-service');
    });

    Route::prefix('servers')->group(function () {
        Route::get('/', [ApiDocumentController::class, 'getServers'])->name('api-document.get-servers');
        Route::get('{id}', [ApiDocumentController::class, 'getServerById'])->name('api-document.get-server');
    });

    Route::prefix('orders')->group(function () {
        Route::get('/', [ApiDocumentController::class, 'getOrders'])->name('api-document.get-orders');
        Route::get('{id}', [ApiDocumentController::class, 'getOrderById'])->name('api-document.get-order');
    });
});

// Route::get('clf', function () {
//     $start = new CloudflareController();
//     $dataa = $start->addDomain('dichvusnet.com');
//     return $dataa;
// }); 

Route::prefix('telegram')->group(function () {
    Route::get('get-webhook-info', function () {
        $telegram = new App\Library\TelegramSdk();
        $response = $telegram->botNotify()->getWebhookInfo();
        dd($response);
    });

    // remove webhook
    Route::get('remove-webhook', function () {
        $telegram = new App\Library\TelegramSdk();
        $response = $telegram->botNotify()->removeWebhook();
        dd($response);
    });

    // webhook
    Route::any('weere', [TelegramController::class, 'callbackData'])->name('telegram.set-webhook');
});
Route::get('hoangduydepzai', [OrderController::class, 'createV2Order'])->name('cron-job.order.service');

