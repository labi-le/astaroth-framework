<?php

declare(strict_types=1);

namespace App\Command\Example;

use Astaroth\Attribute\ClassAttribute\Conversation;
use Astaroth\Attribute\ClassAttribute\Event;
use Astaroth\Attribute\Method\Attachment;
use Astaroth\Attribute\Method\Message;
use Astaroth\Commands\BaseCommands;
use Astaroth\Foundation\Enums\Events;

/**
 * Class ClassForConcreteUser
 * Этот класс будет доступен только для id418618
 * @package app\Command
 */
#[Conversation(Conversation::PERSONAL_DIALOG, 418618)]
#[Event(Events::MESSAGE_NEW)]
class ClassForConcreteUser extends BaseCommands
{
    #[Message("привет")]
    public function method(): void
    {
        $this->message("Ого! Привет давно не виделись!")->send();
    }

    #[Attachment(Attachment::PHOTO)]
    public function photoAction(): void
    {
        $this->message("Красотища!")->send();
    }
}