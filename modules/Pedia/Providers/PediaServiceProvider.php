<?php namespace Modules\Pedia\Providers;

use Illuminate\Support\ServiceProvider;
use DB;

class PediaServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerConfig();
        $this->registerTranslations();
        $this->registerViews();

        //create Module table/s when required
        $dbtable = "CREATE TABLE IF NOT EXISTS `pedia` (
        `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
          `pedia_id` varchar(60) COLLATE utf8_unicode_ci NOT NULL ,
          `allday` varchar(1) COLLATE utf8_unicode_ci DEFAULT '0',
          `start` datetime NOT NULL,
          `end` datetime NOT NULL,
          `title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
          `description` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
          `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
          `color` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
          `textcolor` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
          `facility_id` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
          `user_id` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
          `deleted_at` timestamp NULL DEFAULT NULL,
          `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
          `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
          PRIMARY KEY (id),
          UNIQUE KEY `pedia_pedia_id_unique` (`pedia_id`)
        ) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";

        DB::statement($dbtable);

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__.'/../Config/config.php' => config_path('pedia.php'),
        ]);
        $this->mergeConfigFrom(
            __DIR__.'/../Config/config.php', 'pedia'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = base_path('views/modules/pedia');

        $sourcePath = __DIR__.'/../Resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ]);

        $this->loadViewsFrom([$viewPath, $sourcePath], 'pedia');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = base_path('resources/lang/modules/pedia');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'pedia');
        } else {
            $this->loadTranslationsFrom(__DIR__ .'/../Resources/lang', 'pedia');
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

}
