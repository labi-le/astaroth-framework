# Astaroth

___

## Содержание

1. [Что такое аттрибуты?](https://www.php.net/manual/ru/language.attributes.overview.php)
2. Список аттрибутов
   + [MessageNew](#MessageNew)
   + [MessageEvent](#MessageEvent)

   - [Conversation](#Conversation)
   - [Message](#Message)
   - [MessageRegex](#MessageRegex)
   - [Attachment](#Attachment)
   - [Payload](#Payload)
   - [ClientInfo](#ClientInfo)
   - [State](#State)

### MessageNew

Указывается вначале класса, является событием

```php
use Astaroth\Attribute\Event\MessageNew;

#[MessageNew]
class HelloWorld
{
    //...
}
```

### MessageEvent

Указывается вначале класса, является событием

```php
use Astaroth\Attribute\Event\MessageEvent;

#[MessageEvent]
class Event
{
    //...
}
```

### Conversation

Указывается вначале класса\
Необходим для определения типа конференции\
Можно указать id объектов для которых будут доступны методы

```php
use Astaroth\Attribute\Conversation;
use Astaroth\Attribute\Event\MessageNew;

#[Conversation(Conversation::PERSONAL_DIALOG, 418618, 1234)]
#[MessageNew]
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
use Astaroth\Attribute\Conversation;
use Astaroth\Attribute\Message;
use Astaroth\Attribute\Event\MessageNew;
use Astaroth\DataFetcher\Events\MessageNew as Data;

#[Conversation(Conversation::ALL)]
#[MessageNew]
class Bar
{
    #[Message("содержится ли подстрока в другой подстроке", Message::CONTAINS)]
    #[Message("заканчивается на", Message::END_AS)]
    #[Message("начинается с", Message::START_AS)]
    #[Message("похоже на", Message::SIMILAR_TO)]
    #[Message("без валидации, сравнивает точь в точь")]
    public function method(Data $data){//...}
}
```

### MessageRegex

То же самое что и аттрибут выше, но поиск по регулярным выражениям

```php
use Astaroth\Attribute\Conversation;
use Astaroth\Attribute\MessageRegex;
use Astaroth\Attribute\Event\MessageNew;
use Astaroth\DataFetcher\Events\MessageNew as Data;

#[Conversation(Conversation::ALL)]
#[MessageNew]
class Bar
{
    #[Message('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i')]
    public function method(Data $data){//...}
}
```

### Attachment

Указывается для метода\
Необходим для определения типа вложения\
Можно указать количество вложений для определённого аттрибута

```php
use Astaroth\Attribute\Conversation;
use Astaroth\DataFetcher\Events\MessageNew as Data;
use Astaroth\Attribute\Attachment;
use Astaroth\Attribute\Event\MessageNew;

#[Conversation(Conversation::ALL)]
#[MessageNew]
class Foo
{
    #[Attachment(Attachment::AUDIO)]
    #[Attachment(Attachment::AUDIO_MESSAGE)]
    #[Attachment(Attachment::DOC)]
    #[Attachment(Attachment::GRAFFITI)]
    #[Attachment(Attachment::PHOTO, 2)]
    #[Attachment(Attachment::STICKER)]
    #[Attachment(Attachment::VIDEO)]
    public function method(Data $data)
}
```

### Payload

Указывается для метода\
Необходим для определения payload (нажатие на кнопку)\
Указывается массив

Можно указать тип сравнения

```php
Payload::STRICT //строгое сравнение "точь в точь"
Payload::KEY_EXISTS // проверка на содержания ключей
Payload::CONTAINS // проверка на схожесть массивов
```

```php
use Astaroth\Attribute\Conversation;
use Astaroth\Attribute\Payload;
use Astaroth\DataFetcher\Events\MessageNew as Data;
use Astaroth\Attribute\Event\MessageNew;

#[Conversation(Conversation::ALL)]
#[MessageNew]
class Foo
{
    #[Payload(["button" => 12])]
    #[Payload(["button" => ["user_id" => 418618]])]
    #[Payload(["button" => ["user_id" => 418618]], Payload::KEY_EXISTS)]
    public function method(Data $data){//...}
}

```
### ClientInfo

Указывается для метода\
Необходим, для того чтобы узнать поддерживает ли клиент пользователя новые фичи вконтакте (https://vk.com/faq15855) \
`Для button_actions указывается массив`

```php
use Astaroth\Attribute\Conversation;
use Astaroth\Attribute\ClientInfo;
use Astaroth\DataFetcher\Events\MessageNew as Data;
use Astaroth\Attribute\Event\MessageNew;

#[Conversation(Conversation::ALL)]
#[MessageNew]
class Foo
{
    #[ClientInfo([ClientInfo::CALLBACK, ClientInfo::VKPAY], keyboard: true, inline_keyboard: true)]
    public function method(Data $data){//...}
}
```

### State
Указывается как для метода, так и для класса\
Доступ к классу\вызов метода если в сессии есть это состояние\n

```php
use Astaroth\Attribute\State;
use Astaroth\DataFetcher\Events\MessageNew as Data;
use Astaroth\Attribute\Event\MessageNew;
use Astaroth\Attribute\Message as Message;

#[Conversation(Conversation::ALL)]
#[MessageNew]
#[State("buy")]
class Foo
{
    #[Message("носки", Message::CONTAINS)]
    public function method(Data $data){//...}
}
```