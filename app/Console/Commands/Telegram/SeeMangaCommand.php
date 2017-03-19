<?php

namespace App\Console\Commands\Telegram;

use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Keyboard\Keyboard;

use App\Manga;

class SeeMangaCommand extends Command
{
    protected $name = 'see_mangas';

    protected $description = 'See all the mangas of a source, write the source please.';

    public function handle($arguments)
    {
        $update = $this->getUpdate();

        if (strlen($arguments) > 0) {
            $mangas = Manga::belongsSource($arguments)->pluck('name');

            if ($update->isType('callback_query')) {
                $query = $update->getCallbackQuery();
                $keyboard = Keyboard::make()->inline();
                $mangas->each(function ($manga) use ($keyboard) {
                    $keyboard->row(Keyboard::inlineButton(['text' => $manga, 'callback_data' => $manga]));
                });
                $keyboard->row(Keyboard::inlineButton(['text' => 'Back', 'callback_data' => '/see_sources']));

                $this->getTelegram()->editMessageText([
                    'message_id' => $query->getMessage()->getMessageId(),
                    'chat_id' => $query->getMessage()->getChat()->getId(),
                    'reply_markup' => $keyboard,
                    'text' => 'Mangas of '. $arguments,
                ]);
            } else {
                $this->replyWithMessage(['text' => "List \n".$mangas->implode('\n')]);
            }
        } else {
            $this->replyWithMessage(['text' => 'Please write a valid source.']);
        }
    }
}
