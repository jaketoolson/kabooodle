<?php
//Route::get('/', function () {
//
//    $x = new \Kabooodle\Libraries\LLRClient\LLRClient;
//    $r = $x->login(new \Kabooodle\Libraries\LLRClient\LLRCredentials(\Kabooodle\Models\LLRUser::find(1)));
//
//    dd($r, $x->getConnectionError());
//});

    Route::get('/', function(){
        if(webUser()) {
            return redirect()->route('user.profile', [webUser()->username]);
        }
        return redirect('/home');
    });

    Route::get('/legal/privacy', function(){
       return view('content.legal.privacy');
    });
    Route::get('/legal/terms-service', function(){
        return view('content.legal.terms');
    });

    // TODO: Replace require_once to require when caching routes.
    require_once __DIR__ . DIRECTORY_SEPARATOR . 'auth' . DIRECTORY_SEPARATOR . 'routes.php';
    require_once __DIR__ . DIRECTORY_SEPARATOR . 'claims' . DIRECTORY_SEPARATOR . 'routes.php';
    require_once __DIR__ . DIRECTORY_SEPARATOR . 'inventory' . DIRECTORY_SEPARATOR . 'routes.php';
    require_once __DIR__ . DIRECTORY_SEPARATOR . 'inventory-groupings' . DIRECTORY_SEPARATOR . 'routes.php';
    require_once __DIR__ . DIRECTORY_SEPARATOR . 'flashsales' . DIRECTORY_SEPARATOR . 'routes.php';
    require_once __DIR__ . DIRECTORY_SEPARATOR . 'groups' . DIRECTORY_SEPARATOR . 'routes.php';
    require_once __DIR__ . DIRECTORY_SEPARATOR . 'profile' . DIRECTORY_SEPARATOR . 'routes.php';
    require_once __DIR__ . DIRECTORY_SEPARATOR . 'social' . DIRECTORY_SEPARATOR . 'facebook-routes.php';
    require_once __DIR__ . DIRECTORY_SEPARATOR . 'shipping' . DIRECTORY_SEPARATOR . 'routes.php';
    require_once __DIR__ . DIRECTORY_SEPARATOR . 'sales' . DIRECTORY_SEPARATOR . 'routes.php';
    require_once __DIR__ . DIRECTORY_SEPARATOR . 'analytics' . DIRECTORY_SEPARATOR . 'routes.php';
    require_once __DIR__ . DIRECTORY_SEPARATOR . 'listings' . DIRECTORY_SEPARATOR . 'routes.php';
    require_once __DIR__ . DIRECTORY_SEPARATOR . 'watching' . DIRECTORY_SEPARATOR . 'routes.php';
    require_once __DIR__ . DIRECTORY_SEPARATOR . 'webhooks' . DIRECTORY_SEPARATOR . 'routes.php';
    require_once __DIR__ . DIRECTORY_SEPARATOR . 'notices' . DIRECTORY_SEPARATOR . 'routes.php';
    require_once __DIR__ . DIRECTORY_SEPARATOR . 'home' . DIRECTORY_SEPARATOR . 'routes.php';
    require_once __DIR__ . DIRECTORY_SEPARATOR . 'messenger' . DIRECTORY_SEPARATOR . 'routes.php';
    require_once __DIR__ . DIRECTORY_SEPARATOR . 'users' . DIRECTORY_SEPARATOR . 'routes.php';
    require_once __DIR__ . DIRECTORY_SEPARATOR . 'follow' . DIRECTORY_SEPARATOR . 'routes.php';

    Route::get('/referrals', [
        'as' => 'referrals.index',
        'uses' => \Kabooodle\Http\Controllers\Web\Referrals\ReferralsController::class.'@index'
    ]);

    Route::get('/invite/{username}', [
        'as' => 'invite.index',
        'middleware' => 'referral',
        'uses' => \Kabooodle\Http\Controllers\Web\Referrals\ReferralsController::class.'@invite'
    ]);

    Route::get('/users/{username}', [
        'as' => 'user.profile',
        'uses' => \Kabooodle\Http\Controllers\Web\Users\UsersController::class.'@userProfile'
    ]);
