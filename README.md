# gateway-smsfly
SMS Gateway для сервиса [sms-fly.ua](https://sms-fly.ua)

Установка:
```
composer require nekkoy/gateway-smsfly
```

Конфигурация `.env`
===============
```
# Включить/выключить модуль
SMSFLY_ENABLED=true

# Ключь API
SMSFLY_API_KEY=

# Канал отправки (sms/viber)
SMSFLY_CHANNEL=sms

# Имя отправителя в СМС
SMSFLY_SMS_NAME=

# Имя отправителя в Viber
SMSFLY_VIBER_NAME=
```

Использование
===============

Создайте DTO сообщения, передав первым параметром текст, а вторым — номер получателя:
```
$message = new \Nekkoy\GatewayAbstract\DTO\MessageDTO("test", "+380123456789");
```

Затем вызовите метод отправки сообщения через фасад:
```
/** @var \Nekkoy\GatewayAbstract\DTO\ResponseDTO $response */
$response = \Nekkoy\GatewaySmsfly\Facades\GatewaySmsfly::send($message);
```

Метод возвращает DTO-ответ с параметрами:
 - message - сообщение об успешной отправке или ошибке
 - code - код ответа:
   - code < 0 - ошибка модуля
   - code > 0 - ошибка HTTP
   - code = 0 - успех
 - id - ID сообщения
