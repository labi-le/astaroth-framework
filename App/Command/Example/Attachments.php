<?php

declare(strict_types=1);

namespace App\Command\Example;

use Astaroth\Attribute\Conversation;
use Astaroth\Attribute\Event\MessageNew;
use Astaroth\Attribute\Message;
use Astaroth\DataFetcher\Events\MessageNew as Data;
use Astaroth\Support\Facades\Create;
use Astaroth\Support\Facades\Upload;
use Astaroth\VkUtils\Builders\Attachments\Photo;

#[Conversation(Conversation::ALL)]
#[MessageNew]
class Attachments
{
    /**
     * @throws \Exception
     * @throws \Throwable
     */
    #[Message("котика")]
    public function cat(Data $data, Create $create, Upload $upload): void
    {
        $api = static fn() => json_decode(file_get_contents("https://aws.random.cat/meow"), true)["file"];

        $twoCats = [
            new Photo($api()),
            new Photo($api()),
        ];

        $create(
            (new \Astaroth\VkUtils\Builders\Message())
            ->setPeerId($data->getPeerId())
            ->setAttachment(...$upload(...$twoCats))
        );
    }
}