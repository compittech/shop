<?php


namespace App\Services\Telegram;


use App\Exceptions\Telegram\SendMessageException;
use Illuminate\Support\Facades\Http;

class TelegramBotApi
{
    public const HOST = 'https://api.telegram.org/bot';

    //getUpdates чтобы получить chat_id

    public static function sendMessage(string $token, string $chat_id, string $text) :bool
    {
        $response = Http::get(self::HOST . $token . '/sendMessage', [
            'chat_id' => $chat_id,
            'text' => $text
        ]);
        if (!$response->json(['ok'])) {
            throw new SendMessageException($response->json(['description']), $response->json(['error_code']));
        }
        return $response->json(['ok']);
    }
}
