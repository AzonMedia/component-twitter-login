<?php
declare(strict_types=1);

namespace GuzabaPlatform\Twitter\Login;

use Guzaba2\Base\Base;
use Guzaba2\Event\Event;
use Guzaba2\Kernel\Interfaces\ClassInitializationInterface;
//use Guzaba2\Mvc\AfterControllerMethodHook;
use Guzaba2\Mvc\Controller;
use Guzaba2\Mvc\ExecutorMiddleware;
use GuzabaPlatform\Twitter\Login\Hooks\AfterLoginMain;
use GuzabaPlatform\Platform\Authentication\Controllers\Auth;
use GuzabaPlatform\Twitter\Login\Hooks\TestNestedHook;

/**
 * Class ClassInitialization
 * @package GuzabaPlatform\Twitter\Login
 */
class ClassInitialization extends Base implements ClassInitializationInterface
{

//    protected const CONFIG_DEFAULTS = [
//        'services' => [
//            'Events',
//        ],
//    ];
//
//    protected const CONFIG_RUNTIME = [];

    public static function run_all_initializations() : array
    {
        self::register_login_hook();
        return ['register_login_hook'];
    }

    public static function register_login_hook() : void
    {

//        $Callback = static function(Event $Event) : void
//        {
//            $Controller = $Event->get_subject();
//            $Controller->set_response( (new AfterLoginMain($Controller->get_response()))() );
//        };
//        $Events = self::get_service('Events');
//        $Events->add_class_callback(Auth::class, '_after_main', $Callback);
        //Controller::register_after_hook(Auth::class, '_after_main', AfterLoginMain::class, 'execute_hook');

        Controller::register_after_hook(Auth::class, '_after_main', [ new AfterLoginMain(), 'execute_hook' ] );


        Controller::register_after_hook(AfterLoginMain::class, '_after_execute_hook', [ new TestNestedHook(), 'execute_hook' ] );
    }
}