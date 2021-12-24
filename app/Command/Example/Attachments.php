<?php

declare(strict_types=1);

namespace App\Command\Example;

use Astaroth\Attribute\ClassAttribute\Conversation;
use Astaroth\Attribute\ClassAttribute\Event;
use Astaroth\Attribute\Method\Message;
use Astaroth\Commands\BaseCommands;
use Astaroth\Enums\ConversationType;
use Astaroth\Enums\Events;

#[Conversation(ConversationType::ALL)]
#[Event(Events::MESSAGE_NEW)]
class Attachments extends BaseCommands
{
    #[Message("котика")]
    public function cat(): void
    {
        $api = static fn() => $this->catApi();

        $twoCats = [
            $api(),
            $api(),
        ];

        $this->message("meow")->addImg($twoCats)->send();
    }

    private function catApi(): ?string
    {
        return json_decode(file_get_contents("https://aws.random.cat/meow"), true)["file"] ?? null;
    }
}