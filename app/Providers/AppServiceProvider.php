<?php

namespace droosak\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

use droosak\Videos;
use droosak\Playlist;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

      Videos::deleting(function ($video)  {
        foreach (['_thumbs' , '_videos'] as $path) {
          \Storage::delete(
            sprintf("playlists/%s/%s/%s",
            request()->route()->parameter('id'),
            $path,
            ($path == '_thumbs') ? $video->thumb_src : $video->src
          ));
        }
      });


      Playlist::deleting(function ($playlist)  {
        \Storage::deleteDirectory(
          sprintf("playlists/%s/", request()->route()->parameter('id') )
        );
      });


      $this->app->singleton('Dacast', function ($app) {
          return new \Dacast\Api(env('DACAST_API'));
      });

      View::composer('partials.footer', function ($view) {
        $welcome = \droosak\Welcome::first();

        $view->with(compact('welcome'));
      });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
