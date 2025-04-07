<?php

namespace Nekkoy\GatewaySmsfly\Services;

use Nekkoy\GatewayAbstract\Services\AbstractSendMessageService;
use Nekkoy\GatewaySmsfly\DTO\ConfigDTO;

/**
 *
 */
class SendMessageService extends AbstractSendMessageService
{
    /** @var string */
    protected $api_url = 'https://sms-fly.ua/api/v2/api.php';

    /** @var ConfigDTO */
    protected $config;

    /**
     * @return false|string[]
     */
    private function getChannels() {
        $channels = $this->config->channel;
        $channels = array_map(function($channel) {
            return trim($channel);
        }, explode(",", $channels));

        return $channels;
    }

    /** @return mixed */
    protected function data()
    {
        $channels = $this->getChannels();
        $request = [
            "auth" => [
                "key" => $this->config->api_key,
            ],
            "action" => "SENDMESSAGE",
            "data" => [
                "recipient" => $this->message->destination,
                "channels" => $channels,
            ]
        ];

        foreach($channels as $channel_name) {
            $method = "channel".$channel_name;
            if( method_exists($this, $method) ) {
                $request["data"][$channel_name] = $this->$method();
            }
        }

        return json_encode($request);
    }

    /** @return array */
    private function channelviber() {
        $request = [
            "ttl" => 300,
            "text" => $this->message->text
        ];

        $SenderName = $this->config->name_viber;
        if( !empty($SenderName) ) {
            $request['source'] = $SenderName;
        }

        $ttl = $this->config->ttl;
        if( !empty($ttl) ) {
            $request['ttl'] = $ttl;
        }

        return $request;
    }

    /** @return array */
    private function channelsms() {
        $request = [
            "ttl" => 300,
            "text" => $this->message->text
        ];

        $SenderName = $this->config->name_sms;
        if( !empty($SenderName) ) {
            $request['source'] = $SenderName;
        }

        $ttl = $this->config->ttl;
        if( !empty($ttl) ) {
            $request['ttl'] = $ttl;
        }

        return $request;
    }

    /** @return mixed */
    protected function development()
    {
        return '{
            "success": 1,
            "date": "2021-12-17 10:36:07 +0200",
            "data": {
                "messageID": "FAPI00040A3AFA000002",
                "viber": {
                    "status": "ACCEPTD",
                    "date": "2021-12-17 10:36:07 +0200",
                    "label": "transaction:1",
                    "cost": 0.750
                },
                "sms": {
                    "status": "ACCEPTD",
                    "date": "2021-12-17 10:36:07 +0200",
                    "cost": 0.475
                }
            }
        }';
    }

    /** @return array */
    protected function response()
    {
        $response = json_decode($this->response, true);
        if( isset($response["success"]) && $response["success"] == 1 ) {
            $this->response_code = 0;
        } else {
            $this->response_message = $response["error"]["code"];
        }

        return $response;
    }
}
