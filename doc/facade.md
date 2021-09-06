# Astaroth

1. [Генератор клавиатуры](https://github.com/labi-le/astaroth-vk-keyboard)
2. Нативные фасады
    + [Отправить сообщение, опубликовать пост](#send-message)
    + [Создать пост](#create-post)
    + [Сделать запрос](#create-request)
    + [Загрузить вложение](#create-attachments)
    + [Entity](#entity)

### Send Message

Фасад облегчающий отправку сообщений
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

Фасад облегчающий запросы к vk api
```php
use Astaroth\Support\Facades\Request;

Request::request("users.get", ["user_ids" => 418618, "fields" => "sex"], "token");
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

//string[]
```