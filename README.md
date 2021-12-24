# Astaroth

[![Packagist Stars](https://img.shields.io/packagist/stars/labile/astaroth-core)](https://packagist.org/packages/labile/astaroth-core/stats)
[![PHP](https://img.shields.io/packagist/php-v/labile/astaroth-core)](https://github.com/labi-le/astaroth-core)
[![Download Stats](https://img.shields.io/packagist/dt/labile/astaroth-core)](https://packagist.org/packages/labile/astaroth-core/stats)
[![GitHub license](https://img.shields.io/badge/license-MIT-green.svg)](https://github.com/labi-le/astaroth-core/blob/main/LICENSE)
[![Code Size](https://img.shields.io/github/languages/code-size/labi-le/astaroth-core)](https://github.com/labi-le/astaroth-core)

### Фреймворк для создания ботов

___

## Содержание

1. Конфигурация
    + [Установка](#Installation)
    + [Требования](#Requirement)
2. Примеры и документация
    + [Примеры](app/Command/Example)
    + [Документация по аттрибутам](doc/attribute.md)
    + [Документация по фасадам](doc/facade.md)
    + [Документация по Lilit](doc/lilit.md)

___

### Installation

```
composer create-project labile/astaroth-framework bot
```

### Requirement

> Платформа - `Linux`\
> Версия `PHP` - `>=8.1`

> Обязательные расширения: `ext-mbstring`, `ext-curl`

> Callback mode: Рекомендуемые веб - сервера: `nginx`

> Longpoll mode: обязательные расширения: `ext-pcntl`, `ext-posix`

``Рекомендую использовать связку longpoll + docker, докер файлы уже созданы, необходимо исправить некоторые моменты для своих нужд``