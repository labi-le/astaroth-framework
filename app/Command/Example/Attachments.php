<?php

declare(strict_types=1);

namespace App\Command\Example;

use Astaroth\Attribute\Conversation;
use Astaroth\Attribute\Event\MessageNew;
use Astaroth\Attribute\Message;
use Astaroth\Commands\BaseCommands;
use Astaroth\DataFetcher\Events\MessageNew as Data;
use Astaroth\Support\Facades\Upload;
use Astaroth\VkUtils\Builders\Attachments\Photo;

#[Conversation(Conversation::ALL)]
#[MessageNew]
class Attachments extends BaseCommands
{
    /**
     * @throws \Exception
     * @throws \Throwable
     */
    #[Message("котика")]
    public function cat(Data $data, Upload $upload): void
    {
        $api = static fn() => $this->catApi();

        $twoCats = [
            new Photo($api()),
            new Photo($api()),
        ];

        $this->message($data->getPeerId(), attachment: $upload(...$twoCats));
    }

    private function catApi(): ?string
    {
        return json_decode(file_get_contents("https://aws.random.cat/meow"), true)["file"] ?? null;
    }
}