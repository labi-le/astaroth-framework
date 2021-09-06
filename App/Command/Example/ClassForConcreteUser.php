<?php

declare(strict_types=1);

namespace App\Command\Example;

use Astaroth\Attribute\Attachment;
use Astaroth\Attribute\Conversation;
use Astaroth\Attribute\Event\MessageNew;
use Astaroth\Attribute\Message;
use Astaroth\DataFetcher\Events\MessageNew as Data;
use Astaroth\Support\Facades\Create;

/**
 * Class ClassForConcreteUser
 * Этот класс будет доступен только для id418618
 * @package App\Command
 */
#[Conversation(Conversation::PERSONAL_DIALOG, 418618)]
#[MessageNew]
class ClassForConcreteUser
{
    /**
     * @throws \Throwable
     */
    #[Message("привет")]
    public function method(Data $data, Create $create): void
    {
        $create(
            (new \Astaroth\VkUtils\Builders\Message())
                ->setPeerId($data->getPeerId())
                ->setMessage("Ого! Привет давно не виделись!")
        );
    }

    /**
     * @throws \Throwable
     */
    #[Attachment(Attachment::PHOTO)]
    public function photoAction(Data $data, Create $create): void
    {
        $create(
            (new \Astaroth\VkUtils\Builders\Message())
                ->setPeerId($data->getPeerId())
                ->setMessage("Красотища!")
        );
    }
}