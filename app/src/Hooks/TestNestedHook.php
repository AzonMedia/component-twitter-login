<?php
declare(strict_types=1);

namespace GuzabaPlatform\Twitter\Login\Hooks;


use Guzaba2\Base\Base;
use Guzaba2\Http\Body\Structured;
//use Guzaba2\Mvc\ActiveRecordController;
//use Guzaba2\Mvc\AfterControllerMethodHook;
use Psr\Http\Message\ResponseInterface;

//class TestNestedHook extends ActiveRecordController
//class TestNestedHook extends AfterControllerMethodHook
class TestNestedHook extends Base
{
    public function execute_hook(ResponseInterface $Response) : ResponseInterface
    {
        $Body = $Response->getBody();
        $struct = $Body->getStructure();

        $struct['hooks']['_after_main'][] = [
            'name' => '@GuzabaPlatform.Platform/views/hooks/templates/TextHook.vue',
            //'data'  => 'nested hook data',
            'data'  => ['text' => 'nested hook text data'],
        ];

        $Response = $Response->withBody( new Structured($struct) );
        return $Response;
    }
}