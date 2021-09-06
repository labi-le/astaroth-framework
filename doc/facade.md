# Astaroth

1. [Генератор клавиатуры](https://github.com/labi-le/astaroth-vk-keyboard)
2. Нативные фасады
    + [Отправить сообщение, опубликовать пост](#send-message)
    + [Сделать запрос](#create-request)
    + [Загрузить вложение](#create-attachments)
    + [Entity](#entity)
    + [Session](#session)
    + [Queue](#queue)

### Send Message

Фасад облегчающий отправку сообщений\
Можно использовать плейсхолдеры для динамики сообщений

````
Имя - %name
Имя с упоминанием "%@name"
Имя Фамилия "%full-name"
Имя Фамилия с упоминанием "%@full-name"
Фамилия "%last-name"
Фамилия с упоминанием "%@last-name"
````

```php
use Astaroth\Support\Facades\Create;
use Astaroth\VkUtils\Builders\Message;
use Astaroth\VkUtils\Builders\Post;

Create::new(
    (new Message())
        ->setPeerId(418618)
        ->setMessage("приветик %@name"),
        
     (new Post())
        ->setMessage("Привет моим папищикам!")
);

```

### Create request

Сделать запрос к vk api

```php
use Astaroth\Support\Facades\Request;

Request::call("users.get", ["user_ids" => 418618, "fields" => "sex"], "token");
```

### Create attachments

Фасад облегчающий загрузку вложений

```php
use Astaroth\Support\Facades\Upload;
use Astaroth\VkUtils\Builders\Attachments\Message\PhotoMessages;

Upload::attachments(
    new PhotoMessages("path"),
    new PhotoMessages("path"),
    new PhotoMessages("path"),
    new PhotoMessages("path"),
    new PhotoMessages("path"),
    new PhotoMessages("path"),
    new PhotoMessages("path"),
);

//string[]
```

### Entity

Entity manager из doctrine

```php
use Astaroth\Support\Facades\Entity;

$entity = new Entity;

//pseudo entity
$videoStorage = (new VideoStorage)
    ->setId("xij8x8whijn")
    ->setTitle("beer")
    ->setDescription("I drink beer and walk around St. Petersburg");
    
$entity->persist($videoStorage)''
$entity->flush();
```

### Session

Сессия которые позволяют сохранять любое состояние (при должном опыте можно засунуть анонимную функцию)

```php
use Astaroth\Support\Facades\Session;

$session = new Session(418618, "anime");

$current_episode = $session->get("current_episode");
$session->put("current_episode", ++$current_episode);
```

### Queue

Очереди (также известные как сцены)\
Механизм с помощью которого можно добавить интерактивности диалогу

```php
use Astaroth\Support\Facades\Queue;

new Queue(418618, "pay",
    static function(Queue $q){
        //первая сцена
        $q->next();
    },
    
    static function(Queue $q){
        //вторая сцена
        if ($q->get("year") < 18){
            $q->rewind();
        }
        
        $q->next();
    },
    
    //...
    
    );
```

