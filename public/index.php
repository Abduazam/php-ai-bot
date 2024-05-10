<?php

const BASE_PATH = __DIR__ . '/../';

require BASE_PATH . '/vendor/autoload.php';
require BASE_PATH . 'app/functions.php';

$geminiConfig = require BASE_PATH . '/config/gemini.php';
$telegramConfig = require BASE_PATH . '/config/telegram.php';

$client = Gemini::client($geminiConfig['api-key'])->geminiPro();

$telegram = new Telegram($telegramConfig['api-token']);

$text = $telegram->Text();
$chatId = $telegram->ChatID();

if ($text) {
    $result = $client->generateContent($text);

    if ($chatId) {
        $telegram->sendMessage([
            'chat_id' => $chatId,
            'text' => $result->text(),
            'parse_mode' => 'markdown'
        ]);
    }
}





