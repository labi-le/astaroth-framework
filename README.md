# Astaroth

[![Packagist Stars](https://img.shields.io/packagist/stars/labile/astaroth-core)](https://packagist.org/packages/labile/astaroth-core/stats)
[![PHP](https://img.shields.io/packagist/php-v/labile/astaroth-core)](https://github.com/labi-le/astaroth-core)
[![Download Stats](https://img.shields.io/packagist/dt/labile/astaroth-core)](https://packagist.org/packages/labile/astaroth-core/stats)
[![GitHub license](https://img.shields.io/badge/license-MIT-green.svg)](https://github.com/labi-le/astaroth-core/blob/main/LICENSE)
[![Code Size](https://img.shields.io/github/languages/code-size/labi-le/astaroth-core)](https://github.com/labi-le/astaroth-core)

Личный фреймворк для создания ботов

___

## Содержание

1. Конфигурация
    + [Установка](#Installation)
    + [Требования](#Requirement)
    + [Содержание env](#Env)
2. Примеры и документация
    + [Примеры](App/Command/Example)
    + [Документация по аттрибутам](doc/attribute.md)
    + [Документация по фасадам](doc/facade.md)

___

### Installation

```
composer create-project labile/astaroth-framework bot
```

### Requirement

> Платформа - `Linux`\
> Версия `PHP` - `>=8`\
> Расширения: `ext-pcntl`, `ext-posix`, `mbstring`\
> Веб сервер callback:\
> for debug `composer serve` (php -S x.x.x.x)\
> nginx, apache

## Env

```dotenv
######################## System section ########################
# тип работы бота. Возможны только два типа - CALLBACK, LONGPOLL
TYPE = CALLBACK
# бросать ошибки в лицо, либо скрывать их. yes or no
DEBUG = yes
# обрабатывать ли повторные запросы от вк (callback). yes or no
HANDLE_REPEATED_REQUESTS = no
#Where to save session and queue files?
#Default sys_get_temp_dir()
CACHE_PATH = cache
# Количество параллельных действий
# Used by Create, Upload Facades
# Default 0
# будет полезно для longpoll
COUNT_PARALLEL_OPERATIONS = 3

# Базовый неймпспейс приложения
APP_NAMESPACE = App\Command
# Базовый неймпспейс сущностей (doctrine)
ENTITY_NAMESPACE = App\Entity

######################## VK Section ########################
# access_token сообщества
ACCESS_TOKEN = swusjkbqnodwnpwdmwqpmd902q0nq2dqnpmxmslxssawjiowjwdhw8qd7dw8dgqidbw
# версия vk api
API_VERSION = 5.131
# строка, которую должен вернуть сервер для события confirmation
CONFIRMATION_KEY = sxo1kij9
# произвольная строка, которая будет передаваться с каждым запросом (необязательный параметр)
SECRET_KEY = asdwi9d90dw9dwudja

######################## Database section ########################
DATABASE_DRIVER = pdo_mysql
DATABASE_HOST = 127.0.0.1
DATABASE_NAME = example
DATABASE_USER = example
DATABASE_PASSWORD = veryStrongPassword
```
