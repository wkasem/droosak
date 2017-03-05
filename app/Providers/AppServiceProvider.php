<?php

namespace droosak\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

use droosak\Videos;
use droosak\Playlist;
use droosak\View as v;
use droosak\Events\Viewing;

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

      v::created(function ($video)  {
        broadcast(new Viewing($video));
      });


      $this->app->singleton('Dacast', function ($app) {
          return new \Dacast\Api(env('DACAST_API'));
      });

      View::composer(['partials.footer' , 'mail.layout'], function ($view) {
        $welcome = \droosak\Welcome::first();

        $view->with(compact('welcome'));
      });

        View::composer('partials.home.nav', function ($view) {

          $isLive = \droosak\Videos::where(['by' => \Auth::id() , 'live' => 1])->first();

          $view->with(compact('isLive'));
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
