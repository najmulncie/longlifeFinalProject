<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\PaymentRequestController;
use App\Http\Controllers\ReferralController;
use \App\Http\Controllers\AdminPaymentTaskGatewayController;
use App\Http\Controllers\LogoController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\User\UserTaskController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\UserContactController;
use App\Http\Controllers\ChanelController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AdminTransactionController;

use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\User\drivePackageController;
use App\Http\Controllers\BillPaymentController;
use App\Http\Controllers\AdminBillPaymentController;
use App\Http\Controllers\PremiumController;
use App\Http\Controllers\ProfessionalServiceController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseCategoryCotnroller;
use App\Http\Controllers\User\userCourseController;
use App\Http\Controllers\JobController;


use App\Http\Controllers\GameController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [FrontendController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__.'/auth.php';

//Admin Route Middleware
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashbaord'])->name('admin.admin_dashboard');
    Route::get('/manage/user', [AdminController::class, 'ManageUser'])->name('manage.user');
    Route::delete('/users/{id}', [AdminController::class,'destroy'])->name('users.destroy');
    Route::get('/users/{id}/edit', [AdminController::class,'edit'])->name('users.edit');
    Route::put('/users/{id}', [AdminController::class,'update'])->name('users.update');
    Route::get ('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get ('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post ('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.admin_profile_store');
    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.changePassword');
    Route::post('/admin/update/password', [AdminController::class, 'AdminUpdatePassword'])->name('admin.updatePassword');

    //for user account suspend
    Route::post('/admin/suspend-user/{user}', [AdminController::class,'suspendUser'])->name('admin.suspendUser');
    Route::post('/admin/unsuspend-user/{user}', [AdminController::class,'unsuspendUser'])->name('admin.unsuspendUser');

    //payment request
    Route::get('/admin/payment-requests', [AdminController::class, 'showPaymentRequests'])->name('admin.payment-requests');
    Route::post('/admin/approve-payment/{id}', [AdminController::class, 'approvePayment'])->name('admin.approve-payment');
    Route::delete('/admin/payment/reject/{id}', [AdminController::class, 'rejectPayment'])->name('admin.reject-payment');

    Route::get('/admin/approved-payments', [AdminController::class, 'showApprovedPaymentRequests'])->name('admin.approved-payment-requests');

    Route::get('/admin/withdrawals/approved-requests', [AdminController::class, 'showApprovedWithdrawalRequests'])->name('admin.withdrawals.approveRequest');

    //admin bkash payment task gateway
    Route::get('/admin/payment-task', [AdminPaymentTaskGatewayController::class, 'paymentIndex'])->name('amdin.payment_tasks.gateway');
    Route::get('/admin/manage-task/bkash', [AdminPaymentTaskGatewayController::class, 'bkashManage'])->name('amdin.bkash_tasks.manage');
    Route::get('/admin/manage-task/nagod', [AdminPaymentTaskGatewayController::class, 'nagodManage'])->name('amdin.nagod_tasks.manage');
    Route::delete('/admin/nagod/delete/{id}', [AdminPaymentTaskGatewayController::class, 'nagodDelete'])->name('admin.nagod-task-delete');
    Route::delete('/admin/bkash/delete/{id}', [AdminPaymentTaskGatewayController::class, 'bkashDelete'])->name('admin.bkash-task-delete');


    Route::post('/admin/payment-task', [AdminPaymentTaskGatewayController::class, 'bkashPaymentTaskStore'])->name('admin.payment_gateway_bkash.task');
    //admin nagad payment task gateway
    Route::post('/admin/payment/nagod-task', [AdminPaymentTaskGatewayController::class, 'nagodPaymentTaskStore'])->name('admin.payment_gateway_nagod.task');

    //withdrawal process
    Route::get('/withdrawals', [AdminController::class, 'index'])->name('admin.withdrawals.index');
    Route::post('/withdrawals/approve/{id}', [AdminController::class, 'approve'])->name('admin.withdrawals.approve');
    Route::post('/withdrawals/reject/{id}', [AdminController::class, 'reject'])->name('admin.withdrawals.reject');

    //Logo Routing
    Route::get('/logo', [LogoController::class, 'index'])->name('logo.add-logo');
    Route::post('/add/logo', [LogoController::class, 'create'])->name('logo.add-logo-data');
    Route::get('/manage/logo', [LogoController::class, 'manage'])->name('logo.manage-logo');
    Route::get('/logo/status/{id}', [LogoController::class, 'updateStatus'])->name('logo.logo-status');
    Route::get('/logo/edit/{id}', [LogoController::class, 'edit'])->name('logo.logo-edit');
    Route::post('/logo/update/{id}', [LogoController::class, 'update'])->name('logo.logo-update');
    Route::post('/logo/delete/{id}', [LogoController::class, 'delete'])->name('logo.logo-delete');

    //Task Controller
    Route::get('/admin/task', [TaskController::class, 'index'])->name('admin.tasks.index'); // টাস্কের তালিকা দেখাবে
    Route::get('/tasks/create', [TaskController::class, 'create'])->name('admin.tasks.create'); // নতুন টাস্কের ফর্ম দেখাবে
    Route::post('/admin/tasks', [TaskController::class, 'store'])->name('admin.tasks.store'); // নতুন টাস্ক এড করবে
    Route::delete('/admin/tasks/{id}', [TaskController::class, 'destroy'])->name('admin.tasks.destroy'); // টাস্ক ডিলিট করবে
    Route::get('/admin/show/tasks/{id}', [TaskController::class, 'showTask'])->name('admin.tasks.view');

    //section controller routing...
    Route::get('/sections', [SectionController::class, 'index'])->name('sections.index');
    Route::get('/sections/create', [SectionController::class, 'create'])->name('sections.create');
    Route::post('/sections', [SectionController::class, 'store'])->name('sections.store');
    Route::get('/sections/{id}/edit', [SectionController::class, 'edit'])->name('sections.edit');
    Route::put('/sections/{id}', [SectionController::class, 'update'])->name('sections.update');
    Route::delete('/sections/{id}', [SectionController::class, 'destroy'])->name('sections.destroy');

    //for contact routing..
    Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
    Route::get('/contacts/create', [ContactController::class, 'create'])->name('contacts.create');
    Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');
    Route::delete('/contacts/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy');

    //Banner Routing
    Route::get('/banner', [BannerController::class, 'index'])->name('banner.add-banner');
    Route::post('/add/banner', [BannerController::class, 'create'])->name('banner.add-banner-data');
    Route::get('/manage/banner', [BannerController::class, 'manage'])->name('banner.manage-banner');
    Route::get('/banner/status/{id}', [BannerController::class, 'updateStatus'])->name('banner.banner-status');
    Route::get('/banner/edit/{id}', [BannerController::class, 'edit'])->name('banner.banner-edit');
    Route::post('/banner/update/{id}', [BannerController::class, 'update'])->name('banner.banner-update');
    Route::post('/banner/delete/{id}', [BannerController::class, 'delete'])->name('banner.banner-delete');

    // Notification Routes
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::get('/notifications/create', [NotificationController::class, 'create'])->name('notifications.create');
    Route::post('/notifications', [NotificationController::class, 'store'])->name('notifications.store');
    Route::delete('/notifications/{notification}', [NotificationController::class, 'destroy'])->name('notifications.destroy');

    Route::get('/admin/transactions', [AdminTransactionController::class, 'index'])->name('admin.transactions.index');
    Route::post('/admin/transactions/{id}/verify', [AdminTransactionController::class, 'verify'])->name('admin.transactions.verify');
    // Route::get('/transaction-all', [IncomeController::class, 'allTransaction'])->name('admin.all.transaction');
    
    Route::put('/admin/transactions/{id}/approve', [AdminTransactionController::class, 'approve'])->name('admin.transactions.approve');
    Route::put('/admin/transactions/{id}/cancel', [AdminTransactionController::class, 'cancel'])->name('admin.transactions.cancel');
    


   //admin package routing
    Route::get('/packages/all', [PackageController::class, 'index'])->name('admin.packages.index'); // List all packages
    Route::get('/packages/create', [PackageController::class, 'create'])->name('admin.packages.create'); // Show form to create a new package
    Route::post('/packages', [PackageController::class, 'store'])->name('admin.packages.store'); // Store a new package
    Route::get('/packages/{package}/edit', [PackageController::class, 'edit'])->name('admin.packages.edit'); // Show form to edit a package
    Route::put('/packages/{package}', [PackageController::class, 'update'])->name('admin.ackages.update'); // Update a package
    Route::delete('/packages/{package}', [PackageController::class, 'destroy'])->name('admin.packages.destroy'); // Delete a package
  
    // user purchases request Routes
    Route::get('/admin/requests/package', [PackageController::class, 'viewRequests'])->name('admin.viewRequests');
    Route::put('/admin/requests/approve/{id}', [PackageController::class, 'approveRequest'])->name('admin.approveRequest');
    Route::put('/admin/requests/reject/{id}', [PackageController::class, 'rejectRequest'])->name('admin.rejectRequest');


    //Admin bill payment routing: pani, electricity, gas
    Route::get('/payments/bill', [AdminBillPaymentController::class, 'index'])->name('admin.payments.index');
    Route::post('/payments/{id}/approve/bill', [AdminBillPaymentController::class, 'approve'])->name('admin.payments.approve');
    Route::patch('/payments/{id}/reject/bill', [AdminBillPaymentController::class, 'reject'])->name('admin.payments.reject');


    //premium controller routing
    Route::get('/premium/index', [PremiumController::class, 'index'])->name('admin.premium.index');
    Route::post('/admin/premium/store', [PremiumController::class, 'store'])->name('admin.premium.store');
    Route::get('/admin/premium/all', [PremiumController::class, 'all'])->name('admin.premium.all');
    Route::patch('/premium/{id}/delete', [PremiumController::class, 'delete'])->name('admin.premium.delete');

    Route::get('premium-orders', [PremiumController::class, 'premiumOrders'])->name('admin.premium.orders'); // Order history
    Route::post('premium-orders/{order}/approve', [PremiumController::class, 'approvePremiumOrder'])->name('admin.premium.approve'); // Approve order
    Route::post('premium-orders/{order}/reject', [PremiumController::class, 'rejectOrder'])->name('admin.premium.reject'); 


    //professional Service Controller
    Route::get('/professional-service', [ProfessionalServiceController::class, 'index'])->name('admin.professional.index');
    Route::post('/professional-service/store', [ProfessionalServiceController::class, 'store'])->name('admin.professional.store');
    Route::get('/admin/professional-service/all', [ProfessionalServiceController::class, 'all'])->name('admin.professional.all');
    Route::delete('/professional-service/{professional_service}/delete', [ProfessionalServiceController::class, 'delete'])->name('admin.professional.delete'); // Delete a package
   
    Route::get('/admin/requests/professional-service', [ProfessionalServiceController::class, 'adminRequests'])->name('admin.requests.index');
    Route::patch('/admin/requests/{serviceRequest}', [ProfessionalServiceController::class, 'updateRequestStatus'])->name('admin.requests.update');
    

    //course Category/section Controller 
    Route::get('/admin/course/category/create', [CourseCategoryCotnroller::class, 'create'])->name('course.category.create');
    Route::post('/admin/course/category', [CourseCategoryCotnroller::class, 'store'])->name('course.category.store');
    Route::delete('/admin/course/category/{id}', [CourseCategoryCotnroller::class, 'destroy'])->name('course.category.destroy');


    //course section controller
    Route::get('/course/sections', [CourseController::class, 'index'])->name('course.sections.index');
    Route::get('/course/sections/create', [CourseController::class, 'create'])->name('course.sections.create');
    Route::post('/course/sections', [CourseController::class, 'store'])->name('course.sections.store');
    Route::get('/course/sections/{id}/edit', [CourseController::class, 'edit'])->name('course.sections.edit');
    Route::put('/course/sections/{id}', [CourseController::class, 'update'])->name('course.sections.update');
    Route::delete('/course/sections/{id}', [CourseController::class, 'destroy'])->name('course.sections.destroy');




});

//Admin Login Page
Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');

//user payment request
Route::post('/submit-payment-request', [PaymentRequestController::class, 'store'])->name('submit-payment-request')->middleware('auth');

//user all refferel
Route::get('/my-referrals', [ReferralController::class, 'my_refer'])->name('my.referrals');


//Admin Route Middleware
Route::middleware(['auth', 'verified', 'role:user'])->group(function () {
    Route::controller(UserController::class)->group(function(){
    Route::get('/dashboard', 'UserDashboard')->name('dashboard');
    Route::get ('/user/logout', 'UserLogout')->name('user.logout');
    Route::get ('/user/profile', 'UserProfile')->name('user.profile');
    Route::post ('/user/profile/store', 'UserProfileStore')->name('user.user_profile_store');
    Route::get('/user/change/password', 'UserChangePassword')->name('user.changePassword');
    Route::post('/user/update/password', 'UserUpdatePassword')->name('user.updatePassword');


    // Withdraw Route
    Route::get('/user/withdraw', 'UserWithdraw')->name('user.withdrawPage');
    Route::post('/withdraw','withdraw')->name('user.withdraw');
    Route::get('/user/withdrwal/history', 'withdrawHistory')->name('user.withdrawHistory');

    Route::post('/user/{id}/add-commission', 'addCommissionToBalance')->name('user.addCommissionToBalance');

    //refferalo tree
    Route::get('/user/{id}/referral-tree', 'showReferralTree')->name('user.referral_tree');

    });

    Route::post('/referral/add', [ReferralController::class, 'addReferral'])->name('referral.add');
    Route::post('/referral/{user}', [ReferralController::class, 'addReferral']);

    //user task controller route
    Route::get('/user/tasks/', [UserTaskController::class, 'index'])->name('user.tasks.index');
    Route::get('/tasks/{id}', [UserTaskController::class, 'showTask'])->name('tasks.show');
    Route::post('/tasks/{id}/submit', [UserTaskController::class, 'submitTask'])->name('tasks.submit');

    //for user contact routing
    Route::get('/user/contacts', [UserContactController::class, 'index'])->name('user.contacts.index');

    Route::get('/user/notifications/{id}', [NotificationController::class, 'show'])->name('notifications.show');

    //for chanel search
    Route::get('/chanel/{id}', [ChanelController::class, 'index'])->name('chanel.index');

    //Route::get('/search/results', [ChanelController::class, 'search'])->name('search');

    //for income route
    Route::get('/income/all', [IncomeController::class, 'index'])->name('income.index');
    Route::get('/income/wallet', [IncomeController::class, 'walletMoney'])->name('income.walletMoney');
    Route::get('/income/today', [IncomeController::class, 'getTodayIncome'])->name('income.today');
    Route::get('/income/yesterday', [IncomeController::class, 'getYesterdayIncome'])->name('income.yesterday');
    Route::get('/income/last7days', [IncomeController::class, 'getLast7DaysIncome'])->name('income.last7days');
    Route::get('/income/last30days', [IncomeController::class, 'getLast30DaysIncome'])->name('income.last30days');
    Route::get('/income/total', [IncomeController::class, 'getTotalIncome'])->name('income.total');
    Route::get('/income/balance', [IncomeController::class, 'getCurrentBalance'])->name('income.balance');
    Route::get('/income/history', [IncomeController::class, 'getIncomeHistory'])->name('income.history');
    Route::get('/income/payment/instruction', [IncomeController::class, 'paymentInstruction'])->name('income.payment.instruction');



    Route::get('/payment', [IncomeController::class, 'showPaymentPage'])->name('payment.page');
    Route::post('/payment/verify', [IncomeController::class, 'verifyTransaction'])->name('payment.verify');
    Route::get('/payment/history', [IncomeController::class, 'paymentHistory'])->name('payment.history');
    
    //wallet transfer ammount
    Route::post('/transfer-to-wallet', [IncomeController::class, 'transferToWallet'])->name('transfer.to.wallet');

    Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');

    //for global bonus = 1000;
    Route::get('/referral/bonus', [ReferralController::class, 'showBonus'])->name('referral.bonus');

    //drive package
    Route::get('/packages', [drivePackageController::class, 'index'])->name('user.package.index');
    Route::get('/buy-package/{id}', [drivePackageController::class, 'showPackageForm'])->name('buy.package');
    Route::post('/process-package-purchase', [drivePackageController::class, 'processPurchase'])->name('process.package.purchase');
    Route::get('/purchases/history', [drivePackageController::class, 'purchaseHistory'])->name('user.package.purchases-history');

    //for user bill payment
    Route::get('/bill-payment', [BillPaymentController::class, 'index'])->name('bill.payment');
    Route::post('/bill-payment/process', [BillPaymentController::class, 'processPayment'])->name('bill.payment.process');
    Route::get('/user/bill/payment-history', [BillPaymentController::class, 'paymentHistory'])->name('user.bill.payment-history');

    
    //for lucky-royel game routing
    Route::get('/lucky-royal', [GameController::class, 'index'])->name('game.index');
    Route::post('/bet', [GameController::class, 'placeBet'])->name('game.placeBet');
    Route::get('/bet-history', [GameController::class, 'betHistory'])->name('game.betHistory');
    
    //START routing for user premium
    Route::get('/premium/show', [PremiumController::class, 'show'])->name('user.premium.show');
    Route::get('/premium/{id}/show', [PremiumController::class, 'buyPremium'])->name('user.premium.buy');
    Route::post('/request-premium/purchase', [PremiumController::class, 'requestPremium'])->name('user.request.premium');
    Route::get('/request-premium/history', [PremiumController::class, 'historyPurchase'])->name('user.history.premium');
    
    
    //user professional service routing
    Route::get('/professional-service/all', [ProfessionalServiceController::class, 'ViewAll'])->name('user.professional.viewAll');
    Route::post('/service-requests/{id}', [ProfessionalServiceController::class, 'storeRequest'])->name('professional.service-requests.store');
    Route::get('/user/requests/history', [ProfessionalServiceController::class, 'userHistory'])->name('user.professional-requests.history');
    
    //user course section routing
    Route::get('/course/section', [userCourseController::class, 'index'])->name('course.section.index'); // Section List
    Route::get('/user/sections/{id}/videos', [userCourseController::class, 'showVideos'])->name('course.sections.videos');    

    //all job controller routing
    Route::get('jobs', [JobController::class, 'index'])->name('job.index'); 
    Route::get('jobs', [JobController::class, 'create'])->name('user.jobs.create'); 
    Route::get('/user/jobs/{id}', [JobController::class, 'show'])->name('job.show'); 
    Route::post('/jobs', [JobController::class, 'store'])->name('user.job.store'); 
    Route::put('/user/jobs/{id}', [JobController::class, 'update'])->name('job.update'); 
    Route::delete('/user/jobs/{id}', [JobController::class, 'destroy'])->name('job.destroy'); 



});
