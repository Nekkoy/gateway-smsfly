<?php

namespace Nekkoy\GatewaySmsfly\Services;

use Nekkoy\GatewaySmsfly\DTO\ConfigDTO;
use Nekkoy\GatewayAbstract\DTO\MessageDTO;
use Nekkoy\GatewayAbstract\DTO\ResponseDTO;

/**
 *
 */
class GatewaySmsflyService
{
	/**
	* @return ResponseDTO
	*/
    public function send(MessageDTO $message)
    {
        /** @var ConfigDTO $config */
        $config = app(GatewayService::class)->getConfig();

        /** @var SendMessageService $gateway */
        $gateway = new $config->handler($config, $message);

        return $gateway->send();
    }
}
