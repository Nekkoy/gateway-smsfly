<?php

namespace Nekkoy\GatewaySmsfly\Services;

use Nekkoy\GatewaySmsfly\DTO\ConfigDTO;

/**
 *
 */
class GatewayService
{
    protected $config;

    public function __construct()
    {
        $this->config = config('gateway-smsfly', []);
    }

    /**
     * @return ConfigDTO
     */
    public function getConfig()
    {
        return new ConfigDTO($this->config);
    }
}
