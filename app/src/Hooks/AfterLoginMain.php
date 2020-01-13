<?php
declare(strict_types=1);

namespace GuzabaPlatform\Twitter\Login\Hooks;

use Guzaba2\Base\Base;
use Guzaba2\Http\Body\Structured;
//use Guzaba2\Mvc\ActiveRecordController;
//use Guzaba2\Mvc\AfterControllerMethodHook;
use Psr\Http\Message\ResponseInterface;

//class AfterLoginMain extends ActiveRecordController
//class AfterLoginMain extends AfterControllerMethodHook
class AfterLoginMain extends Base
{
    public function execute_hook(ResponseInterface $Response) : ResponseInterface
    {
        //$Response = $this->get_response();
        $Body = $Response->getBody();
        $struct = $Body->getStructure();

        $struct['hooks']['_after_main'][] = [
            'name'  => '@GuzabaPlatform.Twitter.Login/TwitterLoginHook.vue',
            'data'  => 'twitter hook data',
        ];

        $Response = $Response->withBody( new Structured($struct) );
        return $Response;
    }
}
/*
class AfterLoginMain extends AfterControllerMethodHook
{
    public function process(ResponseInterface $Response) : ResponseInterface
    {
        $Body = $Response->getBody();
        $struct = $Body->getStructure();

        $struct['hooks']['_after_main'][] = [
            'name'  => '@GuzabaPlatform.Twitter.Login/TwitterLoginHook.vue',
            'data'  => 'twitter hook data',
        ];
        $Response = $Response->withBody( new Structured($struct) );
        return $Response;
    }
}
*/