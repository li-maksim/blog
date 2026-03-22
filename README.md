# Blog

Блог на PHP с MVC-архитектурой и серверным рендерингом страниц.  
Включает пользовательскую аутентификацию, страницы профилей, публикацию постов и комментариев.  
Маршрутизация реализована через собственный роутер, данные хранятся в MySQL.
Посмотреть можно по [ссылке](http://niceblog.webtm.ru/).

## Функции

- Регистрация, вход и выход пользователей (сессии + хэширование паролей).
- Главная страница со списком постов и пагинацией.
- Просмотр отдельного поста и комментариев к нему.
- Создание, редактирование и удаление постов.
- Добавление и удаление комментариев.
- Личная страница пользователя и страницы других пользователей.
- Просмотр постов и комментариев конкретного пользователя с пагинацией.

## Структура проекта

- `public/` - точка входа.
- `public/assets/css/` - стили интерфейса.
- `src/Controllers/` - контроллеры: обработка HTTP-запросов и координация логики.
- `src/Models/` - модели работы с БД (PDO, SQL-запросы).
- `src/Views/` - PHP-шаблоны страниц и компонентов.
- `src/Exceptions/` - пользовательские исключения.
- `migrations/` - SQL-миграции и seed-данные.

### `HomeController`

| Метод | Путь | Обработчик | Назначение |
|---|---|---|---|
| GET | `/` | `HomeController::render` | Отображение главной страницы со списком постов и пагинацией. |

### `AuthController`

| Метод | Путь | Обработчик | Назначение |
|---|---|---|---|
| GET | `/login` | `AuthController::renderLogin` | Рендеринг страницы авторизации. |
| POST | `/login` | `AuthController::login` | Аутентификация пользователя. |
| GET | `/logout` | `AuthController::logout` | Выход из учетной записи. |
| GET | `/signup` | `AuthController::renderSignUp` | Рендеринг страницы регистрации. |
| POST | `/signup` | `AuthController::signUp` | Регистрация нового пользователя. |

### `PostController`

| Метод | Путь | Обработчик | Назначение |
|---|---|---|---|
| GET | `/post` | `PostController::renderPost` | Просмотр поста по `id`. |
| POST | `/post` | `PostController::postNewComment` | Добавление нового комментария к посту. |
| GET | `/post/create` | `PostController::renderCreatePage` | Рендеринг страницы создания поста. |
| POST | `/post/create` | `PostController::createNewPost` | Создание поста. |
| GET | `/post/edit` | `PostController::renderEditPage` | Рендеринг страницы редактирования поста. |
| POST | `/post/edit` | `PostController::updatePost` | Сохранение изменений поста. |
| GET | `/post/delete` | `PostController::deletePost` | Удаление поста. |

### `UserPageController`

| Метод | Путь | Обработчик | Назначение |
|---|---|---|---|
| GET | `/my_page` | `UserPageController::renderMyPage` | Страница текущего пользователя. |
| GET | `/user` | `UserPageController::renderOtherUsersPage` | Страница другого пользователя. |
| GET | `/user/posts` | `UserPageController::renderUserPosts` | Список постов пользователя с пагинацией. |
| GET | `/user/comments` | `UserPageController::renderUserComments` | Список комментариев пользователя с пагинацией. |

### `CommentController`

| Метод | Путь | Обработчик | Назначение |
|---|---|---|---|
| GET | `/comment/delete` | `CommentController::deleteComment` | Удаление комментария. |

## Используемые технологии

- PHP 8.1.
- MySQL 8.0.
- PDO.
- Docker, Docker Compose.
- Bootstrap.

## Установка и запуск

Необходимы Docker и Docker Composer. После загрузки проекта на своё устройство нужно собрать проект, используя эту команду в корневой папке проекта:  
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
