# simple blog
=====================

## Задача
Реализовать на laravel простой блог и API для доступа к данным.
Структура проекта

Автор:
- Имя
- Slug

Новость:
- Название
- Slug
- Описание
- Автор
- Дата публикации

API должен содержать следующие роуты:
- Список авторов
- Автор детально (Имя автора, его новости с пагинацией)
- Список новостей
- Новость детально


## Инструкция по запуску
Клонируйте проект и выполните команду:
```
composer install
```

переименуйте .env.example в .env.:
```bash
cp .env.example .env
```

Установите ключ шифрования командой:
```bash
php artisan key:generate
```

Запустите приложение:
```bash
./vendor/bin/sail up -d
```

Выполните миграции:
```bash
./vendor/bin/sail artisan migrate
```

Заполните базу:
```bash
./vendor/bin/sail artisan db:seed
```

Для остановки приложения:
```bash
./vendor/bin/sail stop
```

Для запуска тестов:
```bash
./vendor/bin/sail test
```

Документация к API расположена в файле simple-blog.postman_collection.json

### Использованные технологии

- PHP
- Laravel
- MySQL
- Docker 