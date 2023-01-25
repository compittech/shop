<?php


namespace App\Services\Telegram;


use Illuminate\Support\Facades\Http;

class TelegramBotApi
{
    public const HOST = 'https://api.telegram.org/bot';

    public static function sendMessage(string $token, string $chat_id, string $text) :void
    {
        Http::get(self::HOST . $token . '/sendMessage', [
            'chat_id' => $chat_id,
            'text' => $text
        ]);
        //TODO ДЗ Урок 1
        /*
         * В этом методе получать json ответ и возвращать boolean
         * Добавить try catch и свой exeption
         * В случае неудачи отправки в телегу возращать свой exception
         * */
    }

}
