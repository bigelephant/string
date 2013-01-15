<?php namespace BigElephant\String;

use Illuminate\Support\ServiceProvider;
use BigElephant\String\Pluralizer\English as Pluralizer;

class StringServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app['pluralizer'] = $this->app->share(function($app) 
        { 
            return new Pluralizer; 
        });

        $this->app['string'] = $this->app->share(function($app) 
        { 
            return new String($app['pluralizer']); 
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('string', 'pluralizer');
    }

}