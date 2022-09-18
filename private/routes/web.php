<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/ajax-element', function () {
    $element = (string)request()->query('element');

    $elements = [
        'block1',
        'block2',
        'block3',
        'block4',
        'block5',
        'block6',
        'block7',
        'block8',
        'block9',
        'block10',
        'grid1',
        'grid2',
        'grid3',
        'grid4',
        'grid5',
    ];

    if (!in_array($element, $elements)) {
        return null;
    }

    $attributes = array(
        'cats' => (string)request()->query('cats', ''),
        'per_page' => (int)request()->query('per_page', 6),
        'order_by' => (string)request()->query('orderby', 'published_at'),
        'order' => (string)request()->query('order', 'desc'),
        'summary_length' => (int)request()->query('excerpt', null),
        'page' => (int)request()->query('page', 1),
        'pagination' => (string)request()->query('pagination', 'numeric'),
    );

    return call_user_func([\App\Helpers\Elements::class, $element], $attributes);
})->name('ajax.element');


// Authentication Routes...
Route::match(['get', 'post'], '/login', 'AuthController@login')->name('login');
Route::get('logout', 'AuthController@logout')->name('logout');

// Registration Routes...
Route::match(['get', 'post'], '/register', 'AuthController@register')->name('register');

Route::get('email-verify/{username}/{key}', 'AuthController@emailVerify')->name('email.verify');

Route::match(['get', 'post'], 'password/reset/{username?}/{key?}', 'AuthController@resetPassword')
    ->name('password.reset');

Route::get('/auth/{provider}', 'AuthController@redirectToSocialProvider')->name('social.login');
Route::get('/auth/{provider}/callback', 'AuthController@handleSocialProviderCallback')->name('social.callback');

Route::post('upload/editor', 'UploadController@editor')->name('upload.editor');

// Install Routes
Route::name('')->group(function () {
    Route::get('/install', 'InstallController@index')->name('install.index');
    Route::match(['get', 'post'], '/install/database', 'InstallController@database')->name('install.database');
    Route::get('/install/data', 'InstallController@data')->name('install.data');
    Route::match(['get', 'post'], '/install/admin', 'InstallController@admin')->name('install.admin');
    Route::get('/install/finish', 'InstallController@finish')->name('install.finish');
});

// Public Routes
Route::name('')->group(function () {
    Route::get('/', 'HomeController@index')->name('homepage');

    Route::post('/visitor-check', 'VisitorCheckController@index')->name('visitor-check');

    Route::get('/feed', 'HomeController@feed')->name('feed');

    Route::get('/ref/{username}', 'UserController@ref')->name('referral.url');

    Route::post('/article/go', 'ArticleController@go')->name('article-go');

    Route::get('/category/{slug}-{category}', 'CategoryController@show')
        ->where(['slug' => '(.+)', 'category' => '[0-9]+'])
        ->name('category.show');
    Route::get('/category/{slug}-{category}/feed', 'CategoryController@feed')
        ->where(['slug' => '(.+)', 'category' => '[0-9]+'])
        ->name('category.feed');

    Route::get('/tag/{slug}-{tag}', 'TagController@show')
        ->where(['slug' => '(.+)', 'tag' => '[0-9]+'])
        ->name('tag.show');
    Route::get('/tag/{slug}-{tag}/feed', 'TagController@feed')
        ->where(['slug' => '(.+)', 'tag' => '[0-9]+'])
        ->name('tag.feed');

    Route::get('/page/{slug}', 'PageController@show')->name('page.show');

    Route::post('/comment/store', 'CommentController@store')->name('comment.add');
    Route::post('/reply/store', 'CommentController@replyStore')->name('reply.add');

    Route::get('/author/{username}', 'AuthorController@show')->name('author.show');
    Route::get('/author/{username}/feed', 'AuthorController@feed')->name('author.feed');
    Route::post('/author/{username}/follow', 'AuthorController@follow')->name('author.follow');
    Route::post('/author/{username}/unFollow', 'AuthorController@unFollow')->name('author.unfollow');

    Route::post('/newsletter/subscribe', 'NewsletterController@subscribe')->name('newsletter.subscribe');
    Route::match(['get', 'post'], '/search', 'SearchController@index')->name('search');

    Route::get('/contact', 'ContactController@show')->name('contact.show');
    Route::post('/contact/process', 'ContactController@process')->name('contact.process');

    Route::get('/sitemap', 'SitemapController@index')->name('sitemap');

    Route::get('/{slug}-{article}', 'ArticleController@show')->where(['slug' => '(.+)', 'article' => '[0-9]+'])
        ->name('article.show');
});

// Admin Routes
Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware(['role:admin'])->group(function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');

    Route::get('/upgrade', 'UpgradeController@index')->name('upgrade');
    Route::post('/upgrade/process', 'UpgradeController@process')->name('upgrade.process');

    Route::get('/activation', 'ActivationController@index')->name('activation');
    Route::post('/activation/process', 'ActivationController@process')->name('activation.process');

    Route::resource('ads', 'AdController')->except(['show']);

    Route::match(['get', 'post'], '/articles/pay/{article}', 'ArticleController@pay')->name('articles.pay');

    Route::match(['get', 'post'], '/articles/index/new-pending', 'ArticleController@indexNewPending')
        ->name('articles.indexNewPending');
    Route::get('/articles/{article}/new-pending/edit', 'ArticleController@newPendingEdit')
        ->where(['article' => '[0-9]+'])->name('articles.newPendingEdit');
    Route::put('/articles/{article}/new-pending/process', 'ArticleController@newPendingProcess')
        ->where(['article' => '[0-9]+'])->name('articles.newPendingProcess');
    Route::match(['get', 'post'], '/articles/index/update-pending', 'ArticleController@indexUpdatePending')
        ->name('articles.indexUpdatePending');
    Route::get('/articles/{article}/update-pending/edit', 'ArticleController@updatePendingEdit')
        ->where(['article' => '[0-9]+'])->name('articles.updatePendingEdit');
    Route::put('/articles/{article}/update-pending/process', 'ArticleController@updatePendingProcess')
        ->where(['article' => '[0-9]+'])->name('articles.updatePendingProcess');

    Route::resource('articles', 'ArticleController')->except(['show']);

    Route::resource('comments', 'CommentController')->except(['show']);

    Route::resource('categories', 'CategoryController')->except(['show']);
    Route::resource('tags', 'TagController')->except(['show']);

    Route::get('pages/homepage', 'PageController@homepage')->name('pages.homepage');
    Route::post('pages/homepage/store', 'PageController@homepageStore')->name('pages.homepage.store');
    Route::resource('pages', 'PageController')->except(['show']);

    //Route::get('/files', 'FileController@index')->name('files.index');
    Route::resource('files', 'FileController')->except(['show']);

    Route::get('withdraws', 'WithdrawController@index')->name('withdraws.index');
    Route::match(['get', 'post'], 'withdraws/methods', 'WithdrawController@methods')->name('withdraws.methods');
    Route::get('withdraws/{withdraw}', 'WithdrawController@show')->where(['withdraw' => '[0-9]+'])
        ->name('withdraws.show');
    Route::post('withdraws/{withdraw}/approve', 'WithdrawController@approve')->where(['withdraw' => '[0-9]+'])
        ->name('withdraws.approve');
    Route::post('withdraws/{withdraw}/complete', 'WithdrawController@complete')->where(['withdraw' => '[0-9]+'])
        ->name('withdraws.complete');
    Route::post('withdraws/{withdraw}/cancel', 'WithdrawController@cancel')->where(['withdraw' => '[0-9]+'])
        ->name('withdraws.cancel');

    Route::get('/menus', 'MenuController@index')->name('menus.index');
    Route::post('/add-menu-item', 'MenuController@addMenuItem')->name('menu.item.add');
    Route::post('/menus/create', 'MenuController@create')->name('menus.create');
    Route::put('/menus/{menu}/edit', 'MenuController@edit')->where(['menu' => '[0-9]+'])
        ->name('menus.edit');
    Route::delete('/menus/{menu}/destroy', 'MenuController@destroy')->where(['menu' => '[0-9]+'])
        ->name('menus.destroy');

    Route::get('/sidebars', 'SidebarController@index')->name('sidebars.index');
    Route::post('/add-widget', 'SidebarController@addWidget')->name('sidebar.widget.add');
    Route::post('/sidebars/create', 'SidebarController@create')->name('sidebars.create');
    Route::put('/sidebars/{sidebar}/edit', 'SidebarController@edit')->where(['sidebar' => '[0-9]+'])
        ->name('sidebars.edit');
    Route::delete('/sidebars/{sidebar}/destroy', 'SidebarController@destroy')->where(['sidebar' => '[0-9]+'])
        ->name('sidebars.destroy');

    Route::match(['get', 'post'], '/users/referrals', 'UsersController@referrals')->name('users.referrals');
    Route::resource('users', 'UsersController');

    Route::match(['get', 'post'], '/options', 'OptionController@index')->name('options.index');
    Route::match(['get', 'post'], '/options/style', 'OptionController@style')->name('options.style');
    Route::match(['get', 'post'], '/payout-rates', 'OptionController@prices')->name('prices');
    Route::get('/options/system', function () {
        return view('admin.options.system');
    })->name('options.system');

    Route::get('/language', 'LanguageController@index')->name('language.index');
    Route::post('/language/create', 'LanguageController@create')->name('language.create');
    Route::delete('/language/{language}/destroy', 'LanguageController@destroy')->name('language.destroy');
    Route::post('/translation/update', 'LanguageController@translationUpdate')->name('translation.update');
    Route::delete('/translation/delete', 'LanguageController@translationDelete')->name('translation.delete');
});

// Member Routes
Route::namespace('Member')->prefix('member')->name('member.')->middleware(['role:admin,member'])->group(function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');

    Route::get('feed', 'UserController@feed')->name('feed');

    Route::resource('articles', 'ArticleController')->except(['show']);

    Route::get('withdraws', 'WithdrawController@index')->name('withdraws.index');
    Route::post('withdraws/request', 'WithdrawController@request')->name('withdraws.request');

    Route::get('referrals', 'UserController@referrals')->name('referrals');

    Route::match(['get', 'post'], 'username', 'UserController@setusername')->name('set.username');

    Route::match(['get', 'post'], 'settings', 'UserController@settings')->name('settings');

    Route::post('email-change', 'UserController@emailChangeRequest')->name('email.change.request');

    Route::get('email-change/{username}/{key}', 'UserController@emailChangeProcess')->name('email.change.process');

    Route::post('password-change', 'UserController@passwordChange')->name('password.change');
});
