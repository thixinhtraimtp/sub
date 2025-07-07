<?php

use App\Http\Controllers\Admin\DataAdminController;
use App\Http\Controllers\Admin\HistoryController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\PartnerWebsiteController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SmmController;
use App\Http\Controllers\Admin\TicketsController;
use App\Http\Controllers\Admin\ServicePlatformController;
use App\Http\Controllers\Admin\ServiceServerController;
use App\Http\Controllers\Admin\VoucherController;
use App\Http\Controllers\Admin\TelegramController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AffiliatesController;
use App\Http\Controllers\Admin\ViewAdminController;
use App\Http\Controllers\Admin\ProductionController;
use App\Http\Controllers\Auth\AuthenticateController;
use App\Http\Controllers\Guard\AccountController;
use App\Http\Controllers\Guard\TicketController;
use App\Http\Controllers\Guard\AffiliateController;
use App\Http\Controllers\Guard\ViewGuardController;
use App\Http\Controllers\Guard\WebSiteController;
use App\Http\Controllers\Service\ViewServiceController;
use App\Http\Controllers\Guard\Product\ViewProductController;


use Illuminate\Support\Facades\Route;

Route::prefix('site')->middleware(['installSite'])->group(function () {
    Route::get('install', [AuthenticateController::class, 'viewInstall'])->name('install');
    Route::post('install', [AuthenticateController::class, 'install'])->name('install.post');
});
Route::get('/ref/{id}', [AuthenticateController::class, 'RefPage'])->name('ref');
Route::get('auth/logout', [AuthenticateController::class, 'logout'])->name('logout');
Route::prefix('auth')->middleware(['guest', 'xss'])->group(function () {
    Route::get('login', [AuthenticateController::class, 'viewLogin'])->name('login');
    Route::get('register', [AuthenticateController::class, 'viewRegister'])->name('register');

    Route::post('login', [AuthenticateController::class, 'login'])->name('login.post');
    Route::post('register', [AuthenticateController::class, 'register'])->name('register.post');
});
Route::get('/', function () {
    return view('landing');
    // return abort(404);
    // return redirect()->route('home');
})->name('landing');


Route::prefix('/')->group(function () {
    Route::get('home', [ViewGuardController::class, 'viewHome'])->name('home');
    Route::get('rule', [ViewGuardController::class, 'viewRule'])->name('rule');
    Route::get('apiv2', [ViewGuardController::class, 'viewApi'])->name('api');
    Route::get('new', [ViewGuardController::class, 'viewNew'])->name('new');
    Route::get('affiliate', [ViewGuardController::class, 'viewAffiliate'])->name('affiliate')->middleware(['auth']);
    if (site('status_smm') == 'on') {
    Route::get('order', [ViewGuardController::class, 'viewOrder'])->name('order');
    }
    if (site('status_massorder') == 'on') {
        Route::get('massorder', [ViewGuardController::class, 'viewMass'])->name('mass')->middleware(['auth']);
    }
    Route::post('/service/checking', [DataAdminController::class, 'serviceChecking'])->name('service.checking.post');
    Route::post('/service/server/checking', [DataAdminController::class, 'serverChecking'])->name('service.server.checking.post');
    Route::post('/server/checking', [DataAdminController::class, 'serverserviceChecking'])->name('server.checking.post');
    Route::prefix('account')->middleware(['auth'])->group(function () {
        Route::get('profile', [ViewGuardController::class, 'viewProfile'])->name('account.profile');
        Route::get('recharge', [ViewGuardController::class, 'viewRecharge'])->name('account.recharge');
        Route::get('card', [ViewGuardController::class, 'viewCard'])->name('account.card');
        Route::post('card', [ViewGuardController::class, 'Card'])->name('account.card.post');
        Route::get('recharge/payment/{id}', [ViewGuardController::class, 'viewCreateRecharge'])->name('account.recharge.payment');
        Route::post('recharge', [ViewGuardController::class, 'createRecharge'])->name('recharge.post');
        Route::get('transactions', [ViewGuardController::class, 'viewTransactions'])->name('account.transactions');
        Route::get('progress', [ViewGuardController::class, 'viewProgress'])->name('account.progress');
        //checking
        Route::get('services', [ViewGuardController::class, 'viewServices'])->name('account.services');
        Route::post('change-password', [AccountController::class, 'changePassword'])->name('account.change-password');
        Route::post('two-factor-auth', [AccountController::class, 'twoFactorAuth'])->name('account.two-factor-auth');
        Route::post('two-factor-auth-disable', [AccountController::class, 'twoFactorAuthDisable'])->name('account.two-factor-auth-disable');
        Route::get('reload-user-token', [AccountController::class, 'reloadUserToken'])->name('account.reload-user-token');
        Route::post('update/status-telegram', [AccountController::class, 'updateStatusTelegram'])->name('account.update.status-telegram');
    });

    Route::get('ticket', [TicketController::class, 'viewTicket'])->name('ticket')->middleware(['auth']);
    Route::get('ticket/{id}', [TicketController::class, 'viewEditTicket'])->name('ticket.edit')->middleware(['auth']);
    Route::post('ticket', [TicketController::class, 'createTicket'])->name('ticket.post')->middleware(['auth']);
    Route::get('create/website', [WebSiteController::class, 'viewCreateWebsite'])->name('create.website')->middleware(['auth']);
    Route::post('create/website', [WebSiteController::class, 'createWebsite'])->name('create.website.post')->middleware(['auth']);
    Route::get('withdraw', [AffiliateController::class, 'viewWithdraw'])->name('withdraw')->middleware(['auth']);
    Route::post('create/withdraw', [AffiliateController::class, 'createWithdraw'])->name('withdraw.create')->middleware(['auth']);
    Route::get('service/{platform}/{service}', [ViewServiceController::class, 'viewService'])->name('service');
    if (request()->getHost() === env('APP_MAIN_SITE')) {
    Route::prefix('/product')->middleware('auth')->group(function () {
        Route::get('/categories', [ViewProductController::class, 'viewCategories'])->name('product.categories');
        Route::get('/category/{slug}', [ViewProductController::class, 'viewCategory'])->name('product.category');
        Route::get('/purchased', [ViewProductController::class, 'viewPurchased'])->name('product.purchased');
    });
}
});

// admin
Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('dashboard', [ViewAdminController::class, 'viewDashboard'])->name('admin.dashboard');
    Route::get('website/config', [ViewAdminController::class, 'viewWebsiteConfig'])->name('admin.website.config');
    Route::get('cron/', [ViewAdminController::class, 'viewCron'])->name('admin.cron');

    Route::get('notify/', [NotificationController::class, 'viewNotify'])->name('admin.notify');
    Route::post('notify/system/create', [NotificationController::class, 'createSystemNotify'])->name('admin.notify.system.create');
    Route::get('notify/system/delete/{id}', [NotificationController::class, 'deleteSystemNotify'])->name('admin.notify.system.delete');
    Route::post('notify/service/create', [NotificationController::class, 'createServiceNotify'])->name('admin.notify.service.create');
    Route::get('notify/service/delete/{id}', [NotificationController::class, 'deleteServiceNotify'])->name('admin.notify.service.delete');

    Route::get('telegram/set-webhook', [TelegramController::class, 'setWebhook'])->name('admin.telegram.set-webhook');
    Route::get('payment/config', [PaymentController::class, 'viewPaymentConfig'])->name('admin.payment.config');
    Route::post('payment/config/update', [PaymentController::class, 'updatePaymentConfig'])->name('admin.payment.config.update');
    Route::post('payment/update/{bank_name}', [PaymentController::class, 'updatePayment'])->name('admin.payment.update');
    Route::get('website/partner', [PartnerWebsiteController::class, 'viewPartnerWebsite'])->name('admin.website.partner');
    Route::get('website/partner/edit/{id}', [PartnerWebsiteController::class, 'viewEditPartnerWebsite'])->name('admin.website.partner.edit');
    Route::post('website/partner/update/{id}', [PartnerWebsiteController::class, 'updatePartnerWebsite'])->name('admin.website.partner.update');
    Route::get('website/partner/active/{id}', [PartnerWebsiteController::class, 'activePartnerWebsite'])->name('admin.website.partner.active');
    Route::get('/website/partner/{id}/reset', [PartnerWebsiteController::class, 'resetPartnerWebsite'])->name('admin.website.partner.reset');
    Route::get('website/partner/delete/{id}', [PartnerWebsiteController::class, 'deletePartnerWebsite'])->name('admin.website.partner.delete');

    // website con
    if (request()->getHost() === env('APP_MAIN_SITE')) {
        Route::post('/smm/checking', [ServiceServerController::class, 'smmChecking'])->name('admin.smm.checking.post');
        Route::post('/smm/seice/checking', [ServiceServerController::class, 'smmserviceeeChecking'])->name('admin.smm.serv.checking.post');
        Route::post('/smm/service/checking', [ServiceServerController::class, 'smmserviceChecking'])->name('admin.smm.service.checking.post');

        // dịch vụ & và nền tảng
        Route::get('service/platform', [ServicePlatformController::class, 'viewServicePlatform'])->name('admin.service.platform');
        Route::post('service/platform/create', [ServicePlatformController::class, 'createServicePlatform'])->name('admin.service.platform.create');
        Route::get('service/platform/edit/{id}', [ServicePlatformController::class, 'viewEditServicePlatform'])->name('admin.service.platform.edit');
        Route::post('service/platform/update/{id}', [ServicePlatformController::class, 'updateServicePlatform'])->name('admin.service.platform.update');
        Route::get('service/platform/delete/{id}', [ServicePlatformController::class, 'deleteServicePlatform'])->name('admin.service.platform.delete');
        // smm
        Route::get('service/smm', [SmmController::class, 'viewSmm'])->name('admin.service.smm');
        Route::post('service/smm/create', [SmmController::class, 'createSmm'])->name('admin.service.smm.create');
        Route::get('service/smm/edit/{id}', [SmmController::class, 'viewEditSmm'])->name('admin.service.smm.edit');
        Route::get('service/smm/balance/', [SmmController::class, 'balanceSmm'])->name('admin.service.smm.balance');
        Route::post('service/smm/update/{id}', [SmmController::class, 'updateSmm'])->name('admin.service.smm.update');
        Route::get('service/smm/delete/{id}', [SmmController::class, 'deleteSmm'])->name('admin.service.smm.delete');

        //ticket
        Route::get('service', [ServiceController::class, 'viewService'])->name('admin.service');
        Route::post('service/create', [ServiceController::class, 'createService'])->name('admin.service.create');
        Route::post('service/create/v2', [ServiceController::class, 'createServiceV2'])->name('admin.service.create.v2');
        Route::get('service/edit/{id}', [ServiceController::class, 'viewEditService'])->name('admin.service.edit');
        Route::post('service/update/{id}', [ServiceController::class, 'updateService'])->name('admin.service.update');
        Route::get('service/delete/{id}', [ServiceController::class, 'deleteService'])->name('admin.service.delete');
        // -- Máy chủ
        Route::post('/service/server/create', [ServiceServerController::class, 'createServer'])->name('admin.server.create');
        Route::post('/service/server/create/v2', [ServiceServerController::class, 'createServerV2'])->name('admin.server.create.v2');
        Route::get('/service/server/delete/{id}', [ServiceServerController::class, 'deleteServer'])->name('admin.server.delete');
        Route::post('/service/server/delete/checked', [ServiceServerController::class, 'deleteServerChecked'])->name('admin.server.delete.checked');
        Route::get('/service/server/clear/price', [ServiceServerController::class, 'clearPrice'])->name('admin.server.clear.price');
    }
    Route::get('/service/server/delete', [ServiceServerController::class, 'serverDeleteAll'])->name('admin.server.delete.all');
    Route::get('ticket/ticket', [TicketsController::class, 'viewTicket'])->name('admin.ticket.ticket');
    Route::get('ticket/ticket/edit/{id}', [TicketsController::class, 'viewEditTicket'])->name('admin.ticket.ticket.edit');
    Route::post('ticket/ticket/update/{id}', [TicketsController::class, 'updateTicket'])->name('admin.ticket.ticket.update');
    Route::get('ticket/ticket/delete/{id}', [TicketsController::class, 'deleteTicket'])->name('admin.ticket.ticket.delete');

    Route::get('affiliates', [AffiliatesController::class, 'viewAffiliates'])->name('admin.affiliates');
    Route::post('affiliates/withdraw/{id}/', [AffiliatesController::class, 'withdrawRef'])->name('admin.affiliates.withdraw');


    Route::get('/service/server', [ServiceServerController::class, 'viewServer'])->name('admin.server');
    Route::get('/service/server/smm', [ServiceServerController::class, 'viewServerSmm'])->name('admin.server.smm');
    Route::get('/service/server/edit/{id}', [ServiceServerController::class, 'viewEditServer'])->name('admin.server.edit');
    Route::post('/service/server/update/{id}', [ServiceServerController::class, 'updateServer'])->name('admin.server.update');
    // update price
    Route::post('/service/server/update-price', [ServiceServerController::class, 'updatePrice'])->name('admin.server.update-price');

    //voucher
    Route::get('voucher', [VoucherController::class, 'viewVoucher'])->name('admin.voucher');
    Route::post('voucher/create', [VoucherController::class, 'createVoucher'])->name('admin.voucher.create');
    Route::post('/admin/voucher/{id}', [VoucherController::class, 'deleteVoucher'])->name('admin.voucher.delete');

    Route::get('users', [UserController::class, 'viewUser'])->name('admin.user');
    Route::get('user/{id}', [UserController::class, 'viewUserDetail'])->name('admin.user.detail');
    Route::post('user/update-lamtilo/{username}', [UserController::class, 'updateUser'])->name('admin.user.update');
    Route::post('user/update-password/{username}', [UserController::class, 'updatePassword'])->name('admin.user.update-password');
    Route::get('user/delete/{id}', [UserController::class, 'deleteUser'])->name('admin.user.delete');
    Route::get('user/edit/balance', [UserController::class, 'viewUserBalance'])->name('admin.user.balance');
    Route::post('user/update/balance', [UserController::class, 'updateUserBalance'])->name('admin.user.update-balance');
    Route::get('user/transactions/{username}', [UserController::class, 'viewUserTransactions'])->name('admin.user.transactions');

    Route::get('transactions', [HistoryController::class, 'viewUserHistory'])->name('admin.user.history');

    Route::post('order/refund', [HistoryController::class, 'refundOrder'])->name('admin.refund.order');
    Route::post('website/update', [DataAdminController::class, 'updateWebsiteConfig'])->name('admin.website.update');
    Route::post('website/setting', [DataAdminController::class, 'WebsiteSetting'])->name('admin.website.setting');

    Route::get('history/orders', [HistoryController::class, 'viewHistoryOrders'])->name('admin.history.orders');
    Route::get('history/payment', [HistoryController::class, 'viewHistoryPayment'])->name('admin.history.payment');

    Route::post('admin/order/update/{id}', [HistoryController::class, 'orderAction'])->name('admin.order.action');
    Route::post('admin/order/update/start/{id}', [HistoryController::class, 'orderActionStart'])->name('admin.order.action.start');
    Route::post('admin/order/update/buff/{id}', [HistoryController::class, 'orderActionBuff'])->name('admin.order.action.buff');
    Route::get('admin/order/delete/{id}', [HistoryController::class, 'deleteOrder'])->name('admin.order.delete');
    if (request()->getHost() === env('APP_MAIN_SITE')) {
    /// danh mục sản phẩm
    Route::get('history/product/orders', [HistoryController::class, 'viewHistoryProductOrders'])->name('admin.history.product.orders');
    Route::get('product/category', [ProductionController::class, 'viewProductCategory'])->name('admin.product.category');
    Route::post('product/category/create', [ProductionController::class, 'createProductCategory'])->name('admin.product.category.create');
    Route::get('product/category/edit/{id}', [ProductionController::class, 'viewEditProductCategory'])->name('admin.product.category.edit');
    Route::put('product/category/update/{id}', [ProductionController::class, 'updateProductCategory'])->name('admin.product.category.update');
    Route::get('product/category/delete/{id}', [ProductionController::class, 'deleteProductCategory'])->name('admin.product.category.delete');
    // thêm sản phẩm
    Route::get('/product/category/add/{id}', [ProductionController::class, 'viewAddProduct'])->name('admin.product.add');
    Route::post('/product/create', [ProductionController::class, 'createProduct'])->name('admin.product.create');
    // xóa sản phẩm
    Route::get('/product/delete/{id}', [ProductionController::class, 'deleteProduct'])->name('admin.product.delete');
    }
});
