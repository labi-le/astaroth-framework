<?php

declare(strict_types=1);

namespace App\Command\Example;

use Astaroth\Attribute\ClassAttribute\Conversation;
use Astaroth\Attribute\ClassAttribute\Event;
use Astaroth\Attribute\Method\Message;
use Astaroth\Commands\BaseCommands;
use Astaroth\DataFetcher\Events\MessageNew as Data;
use Astaroth\Enums\ConversationType;
use Astaroth\Enums\Events;

#[Conversation(ConversationType::ALL)]
#[Event(Events::MESSAGE_NEW)]
class Example extends BaseCommands
{
    #[Message("привет")]
    public function hello(Data $data): void
    {
        $this->message("Ого! Привет %@name давно не виделись!")->send();

//        или так
//        Create::new(
//            (new \Astaroth\VkUtils\Builders\Message())
//                ->setPeerId($data->getPeerId())
//                ->setMessage("Ого! Привет %@name давно не виделись!")
//        );
    }
}