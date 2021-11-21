<?php

declare(strict_types=1);

namespace App\Command\Example;

use Astaroth\Attribute\Attachment;
use Astaroth\Attribute\Conversation;
use Astaroth\Attribute\Event\MessageNew;
use Astaroth\Attribute\Message;
use Astaroth\Commands\BaseCommands;
use Astaroth\DataFetcher\Events\MessageNew as Data;

/**
 * Class ClassForConcreteUser
 * Этот класс будет доступен только для id418618
 * @package app\Command
 */
#[Conversation(Conversation::PERSONAL_DIALOG, 418618)]
#[MessageNew]
class ClassForConcreteUser extends BaseCommands
{
    #[Message("привет")]
    public function method(Data $data): void
    {
        $this->message($data->getPeerId(), "Ого! Привет давно не виделись!");
    }

    #[Attachment(Attachment::PHOTO)]
    public function photoAction(Data $data): void
    {
        $this->message($data->getPeerId(), "Красотища!");
    }
}