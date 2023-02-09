# Тестовое задание

Задача:
Необходимо разработать приложение для парсинга, сохранения и вывода новостей.
Парсинг
Парсер должен обращаться к RSS странице новостей
http://static.feed.rbc.ru/rbc/logical/footer/news.rss. Периодичность запуска парсера - 1 минута,
одновременный запуск не должен происходить, если уже запущен другой экземпляр. Каждая
новость из ленты должна сохраняться в локальную базу данных со следующим набором полей:

1. Название
2. Краткое описание
3. Дата и время публикации
4. Автор (если указан)
5. Изображение (если есть; сам файл должен сохраняться в локальное хранилище)

## Логирование:

Каждый запрос парсера должен логироваться в базу данных. Информация для логирования:

1. Дата и время
2. Request Method
3. Request URL
4. Response HTTP Code
5. Response Body
6. Время выполнения запроса в миллисекундах

## Вывод:

Вывод новостей реализуется через API сервис. GET параметры, влияющие на вывод:

1. Страница (для пагинации)
2. Сортировка по дате публикации
3. Список возвращаемых полей новости

## Требования:

1. Фреймворк Laravel.
2. MySQL/PostgreSQL база данных.
3. Документирование API сервиса в Swagger (не обязательно, но будет плюсом)

## Инструкция по запуску парсера:

php artisan migrate\
php artisan rbc:parse\
go to http://localhost/api/articles?page=1&sort[0][field]=published_at&sort[0][direction]=desc
