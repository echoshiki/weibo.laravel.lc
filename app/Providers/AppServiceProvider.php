<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        # 部分 mysql 版本索引长度报错
        Schema::defaultStringLength(191);
        \Illuminate\Pagination\Paginator::useBootstrap();
    }
}
