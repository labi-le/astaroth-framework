<?php

declare(strict_types=1);

namespace App\Command\Example;

use Astaroth\Attribute\ClassAttribute\Conversation;
use Astaroth\Attribute\ClassAttribute\Event;
use Astaroth\Attribute\Method\Attachment;
use Astaroth\Attribute\Method\Message;
use Astaroth\Commands\BaseCommands;
use Astaroth\Enums\AttachmentEnum;
use Astaroth\Enums\ConversationType;
use Astaroth\Enums\Events;

/**
 * Class ClassForConcreteUser
 * Этот класс будет доступен только для id418618
 * @package app\Command
 */
#[Event(Events::MESSAGE_NEW)]
#[Conversation(ConversationType::PERSONAL, 418618)]
class ClassForConcreteUser extends BaseCommands
{
    #[Message("привет")]
    public function method(): void
    {
        $this->message("Ого! Привет labile aaaa не виделись!")->send();
    }

    #[Attachment(AttachmentEnum::PHOTO)]
    public function photoAction(): void
    {
        $this->message("Красотища!")->send();
    }
}