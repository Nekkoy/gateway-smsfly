<?php

namespace Nekkoy\GatewaySmsfly\DTO;

use Nekkoy\GatewayAbstract\DTO\AbstractConfigDTO;

/**
 *
 */
class ConfigDTO extends AbstractConfigDTO
{
    /**
     * Ключь АПИ
     * @var string
     */
    public $api_key;

    /**
     * Логин
     * @var string
     */
    public $channel;

    /**
     * Имя при отправке через СМС
     * @var string
     */
    public $name_sms;

    /**
     * Имя при отправке через Viber
     * @var string
     */
    public $name_viber;


    /**
     * Время жизни сообщения
     * @var int
     */
    public $ttl;

    /**
     * @var string
     */
    public $handler = \Nekkoy\GatewaySmsfly\Services\SendMessageService::class;
}
