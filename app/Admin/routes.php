<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');

    $router->resources([
        // 净水器订单详情
        'sciclean-orders' => ScicleanOrdersController::class,
        // 净水器分类管理
        'skj-cate' => ScicleanCatesController::class,
        // 净水器价格管理
        'skj-price' => ScicleanPriceController::class,
        // 意见反馈
        'suggestions' => SkbSuggestionsController::class,
        // 会员管理
        'vip-users'  => UsersController::class,
        // 水可邦 文章列表
        'skb_article_list' => SkbArticleController::class,
        // 水可邦 文章分类
        'skb_article_cate' => SkbArticleCateController::class,
        // 水可邦 广告管理
        'skb_ad' => SkbAdController::class,
        // 水可邦 银行卡管理
        'skb_bank_card' => SkbBankCardController::class,
    ]);
});
