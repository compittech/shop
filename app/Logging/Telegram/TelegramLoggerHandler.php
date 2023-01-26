<?php


namespace App\Logging\Telegram;


use App\Exceptions\Telegram\SendMessageException;
use App\Services\Telegram\TelegramBotApi;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;

class TelegramLoggerHandler extends AbstractProcessingHandler
{
    protected int $chat_id;
    protected string $token;

    public function __construct(array $config)
    {
        $level = Logger::toMonologLevel($config['level']);
        parent::__construct($level);
        $this->chat_id = $config['chat_id'];
        $this->token = $config['token'];
    }

    protected function write(array $record): void
    {
        try {
            $result = TelegramBotApi::sendMessage(
                $this->token,
                $this->chat_id,
                $record['formatted']
            );
        } catch (SendMessageException $e) {
            logger('Поймали исключение: '.$e->getMessage().' | code = '. $e->getCode());
            //todo заменить лог на мейл адммину
        }
    }
}
