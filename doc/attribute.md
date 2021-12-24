# Astaroth

___

## Содержание

1. [Что такое аттрибуты?](https://www.php.net/manual/ru/language.attributes.overview.php)
2. Список аттрибутов
    1. Для классов
        + [Event](#Event)
            + [Action](#Action)
        + [Conversation](#Conversation)

    2. Для методов
        - [Message](#Message)
        - [MessageRegex](#MessageRegex)
        - [Attachment](#Attachment)
        - [Payload](#Payload)
        - [ClientInfo](#ClientInfo)
        - [State](#State)
        - [Description](#Description)
        - [Debug](#Debug)

### Event

Указывается вначале класса, является событием, которое присылает вконтакте

```php
use Astaroth\Attribute\ClassAttribute\Event;
use Astaroth\Foundation\Enums\Events;

#[Event(Events::MESSAGE_NEW)]
class HelloWorld
{
    //...
}
```

### Action

Указывается для метода\
Эксклюзивно только для message_new события

Необходим для обработки событий которые происходят в беседах

```php
use Astaroth\Attribute\ClassAttribute\Event;
use Astaroth\Enums\Events;
use Astaroth\Enums\ActionEnum;
use Astaroth\Commands\BaseCommands;
use Astaroth\Attribute\Method\Action;

#[Event(Events::MESSAGE_EVENT)]
class HelloWorld extends BaseCommands
{
    #[Action(ActionEnum::CHAT_TITLE_UPDATE)]
    public function titleUpdate(Data $data): void
    {
        $this->message($data->getPeerId(), "Классное название");
    }}
```


### Conversation

Указывается вначале класса\
Необходим для определения типа конференции\
Можно указать id объектов для которых будут доступны методы

```php
use Astaroth\Attribute\ClassAttribute\Conversation;
use Astaroth\Attribute\ClassAttribute\Event;
use Astaroth\Enums\Events;
use Astaroth\Enums\ConversationType;

#[Event(Events::MESSAGE_EVENT)]
#[Conversation(ConversationType::PERSONAL, 418618, 1234)]
class Foo
{
    //...
}
```

### Message

Указывается для метода\
Необходим для определения текста сообщения\
Можно указать тип валидации

```php
use Astaroth\DataFetcher\Events\MessageNew as Data;
use Astaroth\Attribute\ClassAttribute\Event;
use Astaroth\Attribute\Method\Message;
use Astaroth\Enums\Events;
use Astaroth\Enums\MessageValidation;

#[Event(Events::MESSAGE_EVENT)]
class Bar
{
    #[Message("содержится ли подстрока в другой подстроке", MessageValidation::CONTAINS)]
    #[Message("заканчивается на", MessageValidation::END_AS)]
    #[Message("начинается с", MessageValidation::START_AS)]
    #[Message("похоже на", MessageValidation::SIMILAR_TO)]
    #[Message("без валидации, сравнивает точь в точь")]
    public function method(Data $data){//...}
}
```

### MessageRegex

То же самое что и аттрибут выше, но поиск по регулярным выражениям

```php
use Astaroth\Attribute\Method\MessageRegex;
use Astaroth\DataFetcher\Events\MessageNew as Data;
use Astaroth\Attribute\ClassAttribute\Event;
use Astaroth\Enums\Events;

#[Event(Events::MESSAGE_NEW)]
class Bar
{
    #[MessageRegex('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i')]
    public function method(Data $data, MessageRegex $regex){
        $videoId = $regex[0];
    }
}
```

### Attachment

Указывается для метода\
Необходим для определения типа вложения\
Можно указать количество вложений для определённого аттрибута

```php
use Astaroth\DataFetcher\Events\MessageNew as Data;
use Astaroth\Attribute\Method\Attachment;
use Astaroth\Attribute\ClassAttribute\Event;
use Astaroth\Enums\Events;
use Astaroth\Enums\AttachmentEnum;

#[Event(Events::MESSAGE_NEW)]
class Foo
{
    #[Attachment(AttachmentEnum::AUDIO)]
    #[Attachment(AttachmentEnum::AUDIO_MESSAGE)]
    #[Attachment(AttachmentEnum::DOC)]
    #[Attachment(AttachmentEnum::GRAFFITI)]
    #[Attachment(AttachmentEnum::PHOTO, 2)]
    #[Attachment(AttachmentEnum::STICKER)]
    #[Attachment(AttachmentEnum::VIDEO)]
    public function method(Data $data)
}
```

### Payload

Указывается для метода\
Необходим для определения payload (нажатие на кнопку)\
Указывается массив

Можно указать тип сравнения

```php
PayloadValidation::STRICT //строгое сравнение "точь-в-точь"
PayloadValidation::KEY_EXISTS // проверка на содержания ключей
PayloadValidation::CONTAINS // проверка на схожесть массивов
```

```php
use Astaroth\Attribute\Method\Payload;
use Astaroth\DataFetcher\Events\MessageNew as Data;
use Astaroth\Attribute\ClassAttribute\Event;
use Astaroth\Enums\Events;
use Astaroth\Enums\PayloadValidation;

#[Event(Events::MESSAGE_NEW)]
class Foo
{
    #[Payload(["button" => 12])]
    #[Payload(["button" => ["user_id" => 418618]])]
    #[Payload(["button" => ["user_id" => 418618]], PayloadValidation::KEY_EXISTS)]
    public function method(Data $data){}
}

```

### ClientInfo

Указывается для метода\
Необходим, для того чтобы узнать поддерживает ли клиент пользователя новые фичи вконтакте (https://vk.com/faq15855) \
`Для button_actions указывается массив`

```php
use Astaroth\Attribute\Method\ClientInfo;
use Astaroth\DataFetcher\Events\MessageNew as Data;
use Astaroth\Attribute\ClassAttribute\Event;
use Astaroth\Enums\Events;
use Astaroth\Enums\ClientInfoEnum;

#[Event(Events::MESSAGE_NEW)]
class Foo
{
    #[ClientInfo([ClientInfoEnum::CALLBACK, ClientInfoEnum::VKPAY], keyboard: true, inline_keyboard: true)]
    public function method(Data $data){//...}
}
```

### State

Указывается как для метода, так и для класса\
Доступ к классу\вызов метода если в сессии есть это состояние\n

```php
use Astaroth\Attribute\General\State;
use Astaroth\Attribute\Method\Message;
use Astaroth\Attribute\ClassAttribute\Event;
use Astaroth\Enums\Events;
use Astaroth\Enums\MessageValidation;

#[Event(Events::MESSAGE_NEW)]
#[State("buy")]
class Foo
{
    #[Message("носки", MessageValidation::CONTAINS)]
    public function method(){}
}
```

### Description

Указывается как для метода, так и для класса\
Описывает свойство класса или аттрибута

```php
use Astaroth\Attribute\General\Description;
use Astaroth\Attribute\Method\Message;
use Astaroth\Attribute\ClassAttribute\Event;
use Astaroth\Enums\Events;
use Astaroth\Enums\MessageValidation;

#[Event(Events::MESSAGE_NEW)]
#[Description("описание для класса")]
class Foo
{
    #[Message("носки", MessageValidation::CONTAINS)]
    #[Description("описание метода\команды")]
    public function method(Description $description)
    {
        $description->getDescription() //описание метода\команды
    }
}

```
### Debug

Указывается как для метода\
Выполняет данный метод при любом условии\
Если указать в параметрах, то можно получить полезные данные для дебага

```php
use Astaroth\Attribute\Method\Debug;
use Astaroth\Attribute\Method\Message;
use Astaroth\Attribute\ClassAttribute\Event;
use Astaroth\Enums\Events;
use Astaroth\Enums\MessageValidation;

#[Event(Events::MESSAGE_NEW)]
class Foo
{
    #[Message("носки", MessageValidation::CONTAINS)]
    #[Debug]
    public function method(Debug $debug)
    {
        $debug->getResult() //описание метода\команды
    }
}
```

