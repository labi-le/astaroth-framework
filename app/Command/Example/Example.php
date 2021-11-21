<?php

declare(strict_types=1);

namespace App\Command\Example;

use Astaroth\Attribute\Conversation;
use Astaroth\Attribute\Event\MessageNew;
use Astaroth\Attribute\Message;
use Astaroth\Commands\BaseCommands;
use Astaroth\DataFetcher\Events\MessageNew as Data;
use Astaroth\Support\Facades\Create;

#[Conversation(Conversation::ALL)]
#[MessageNew]
class Example extends BaseCommands
{
    #[Message("привет")]
    public function hello(Data $data): void
    {
        $this->message($data->getPeerId(), "Ого! Привет %@name давно не виделись!");

//        или так
//        Create::new(
//            (new \Astaroth\VkUtils\Builders\Message())
//                ->setPeerId($data->getPeerId())
//                ->setMessage("Ого! Привет %@name давно не виделись!")
//        );
    }
}