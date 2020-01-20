<?php
declare(strict_types=1);

namespace GuzabaPlatform\Twitter\Login;

use GuzabaPlatform\Components\Base\BaseComponent;
use Guzaba2\Base\Base;
use Guzaba2\Mvc\Controller;
use GuzabaPlatform\Components\Base\Interfaces\ComponentInitializationInterface;
use GuzabaPlatform\Components\Base\Interfaces\ComponentInterface;
use GuzabaPlatform\Platform\Authentication\Controllers\Auth;
use GuzabaPlatform\Twitter\Login\Hooks\AfterLoginMain;
use GuzabaPlatform\Twitter\Login\Hooks\TestNestedHook;

/**
 * Class Component
 * @package GuzabaPlatform\Twitter\Login
 */
class Component extends BaseComponent implements ComponentInterface, ComponentInitializationInterface
{

    protected const COMPONENT_NAME = "Twitter Login";
    //https://components.platform.guzaba.org/component/{vendor}/{component}
    protected const COMPONENT_URL = 'https://components.platform.guzaba.org/component/guzaba-platform/twitter-login';
    //protected const DEV_COMPONENT_URL//this should come from composer.json
    protected const COMPONENT_NAMESPACE = 'GuzabaPlatform\\Twitter\\Login';
    protected const COMPONENT_VERSION = '0.0.1';//TODO update this to come from the Composer.json file of the component
    protected const VENDOR_NAME = 'Azonmedia';
    protected const VENDOR_URL = 'https://azonmedia.com';
    protected const ERROR_REFERENCE_URL = 'https://github.com/AzonMedia/component-twitter-login/tree/master/docs/ErrorReference/';


    public static function run_all_initializations() : array
    {
        self::register_login_hook();
        return ['register_login_hook'];
    }

    public static function register_login_hook() : void
    {
        Controller::register_after_hook(Auth::class, '_after_main', [ new AfterLoginMain(), 'execute_hook' ] );
        Controller::register_after_hook(AfterLoginMain::class, '_after_execute_hook', [ new TestNestedHook(), 'execute_hook' ] );
    }
}