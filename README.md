# Blog

Блог, написанный на PHP. Посмотреть можно по [ссылке](niceblog.webtm.ru).

## Функции

- Регистрация аккаунта
- Авторизация
- Создание, редактирование и удаление постов
- Написание и удаление комментариев
- Просмотр всех постов и комментариев конкрентного пользователя
- Пагинация

## Технологии

- PHP
- MySQL
- Docker
- Bootstrap

## Структура проекта

- migrations: файлы для миграции датабазы
- public: index.php, .htaccess и css-файлы
- src/Controllers: контроллеры
- src/Exceptions: исключения
- src/Models: модели
- src/Views: виды

## Сборка проекта на своём устройстве

Необходимы Docker и Docker Composer. После загрузки проекта на своё устройство необходимо собрать проект, используя эту комманду в корневой папке проекта:
`docker compose up -d --build`
После нужно войти в консоль внутри контейнера:
`docker exec -it blog-blog-1 /bin/bash`
Создать .env-файл:
`touch .env`
И добавить в него необходимые данные:
`echo "DB_HOST=db
DB_USER=blog_user
DB_PASS=password
DB_DATABASE=blog_db
DB_DRIVER=mysql" >> .env`
После необходимо запустить миграции датабазы:
`php migrate.php`