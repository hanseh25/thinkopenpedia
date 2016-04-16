<?php

namespace ShineOS;

/**
 * Application class
 *
 * Class that loads other classes
 *
 * @package  Application
 * @category Application
 * @desc
 *
 * @property \ShineOS\Providers\UrlManager                    $url_manager
 * @property \ShineOS\Utils\Format                            $format
 * @property \ShineOS\Providers\ContentManager                $content_manager
 * @property \ShineOS\Providers\CategoryManager               $category_manager
 * @property \ShineOS\Providers\MediaManager                  $media_manager
 * @property \ShineOS\Providers\ShopManager                   $shop_manager
 * @property \ShineOS\Providers\OptionManager                 $option_manager
 * @property \Database                                        $database
 * @property \ShineOS\Providers\CacheManager                  $cache_manager
 * @property \ShineOS\Providers\UserManager                   $user_manager
 * @property \ShineOS\Providers\Modules                       $modules
 * @property \ShineOS\Providers\DatabaseManager               $database_manager
 * @property \ShineOS\Providers\NotificationsManager          $notifications_manager
 * @property \ShineOS\Providers\LayoutsManager                $layouts_manager
 * @property \ShineOS\Providers\LogManager                    $log_manager
 * @property \ShineOS\Providers\FieldsManager                 $fields_manager
 * @property \ShineOS\Providers\Template                      $template
 * @property \ShineOS\Providers\Event                         $event_manager
 * @property \ShineOS\Providers\ConfigurationManager          $config_manager
 * @property \ShineOS\Providers\TemplateManager               $template_manager
 * @property \ShineOS\Providers\Ui                            $ui
 * @property \ShineOS\Utils\Captcha                           $captcha
 * @property \ShineOS\Providers\FormsManager                  $forms_manager
 *
 */
class Application {

    public static $instance;

    public function __construct($params = null) {
        $instance       = app();
        self::$instance = $instance;

        return self::$instance;
    }

    public static function getInstance($params = null) {
        if (self::$instance==null){
            self::$instance = app();
        }

        return self::$instance;
    }

    public function make($property) {
        return app()->make($property);
    }

    public function __get($property) {
        return $this->make($property);
    }
}
