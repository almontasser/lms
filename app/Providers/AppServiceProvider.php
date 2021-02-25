<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
    //
  }

  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot()
  {
    Blade::directive('isAdmin', function () {
      return "<?php if(Auth::user() && Auth::user()->isAdmin()): ?>";
    });

    Blade::directive('_else', function () {
      return "<?php else: ?>";
    });

    Blade::directive('endisAdmin', function () {
      return "<?php endif; ?>";
    });

    Blade::directive('isSelected', function ($field, $value, $model) {
      return "<?php if (old($field, $model ? $model[$field] : null) == $value) { echo 'selected'; }";
    });
  }
}
