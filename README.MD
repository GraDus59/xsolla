# Тестовое задание 2021
## Xsolla School 2021. Backend

- [Ссылка](https://github.com/xsolla/xsolla-school-backend-2021) - Ссылка на тестовое задание
- [Ссылка](http://dev.live-back.ru) - Ссылка на демонстрационный вариант

## Текст тестового задания

**Задача:** реализация системы управления товарами для площадки электронной коммерции (от англ. e-commerce).

Представь, что ты решил основать компанию. Вы занимаетесь реализацией решений, которые помогают разработчикам и издателям игр (ваша целевая аудитория). Главная задача представителей целевой аудитории — это продажа таких товаров, как игры, мерч, виртуальная валюта и др. Таким образом, ваша первая задача — дать возможность управлять товарами с помощью RESTful API.

Для реализации прототипа системы напишите:

Методы API для управления товарами — операции CRUD. Товар определяется уникальным идентификатором и обязательно должен иметь SKU, имя, тип, стоимость. Предполагается наличие следующих REST-методов:
- **Создание товара.** Метод генерирует и возвращает уникальный идентификатор товара.
- **Редактирование товара.** Метод изменяет все данные о товаре по его идентификатору или SKU.
- **Удаление товара** по его идентификатору или SKU.
- **Получение информации о товаре** по его идентификатору или SKU.
- **Получение каталога товаров.** Метод возвращает список всех добавленных товаров.

Обратите внимание, что товаров может быть много. Необходимо предусмотреть возможность снизижения нагрузки на сервис. Вариант реализации: возвращайте список товаров по частям.
Документацию в README. Обязательно укажите последовательность действий для запуска и локального тестирования API.

## Последовательность действий
## Авторизация
**Демонстрационный вариант получения токена** - метод лишь демонстрационный в рамках реализации прототипа
**Ошибки:**
```sh
http://dev.live-back.ru/api/auth/
http://dev.live-back.ru/api/auth/?login=1
http://dev.live-back.ru/api/auth/?login=1&password=1
```
**Верный вариант:**
```sh
http://dev.live-back.ru/api/auth/?login=admin&password=password
```

## CREATE
**Демонстрационный вариант добавления записи**
**Ошибки:**
```sh
http://dev.live-back.ru/api/create/
http://dev.live-back.ru/api/create/?token=token
http://dev.live-back.ru/api/create/?token=token&title=Game%20Over
```
**Верный вариант:**
```sh
http://dev.live-back.ru/api/create/?token=token&title=StarCraft2&type=1
http://dev.live-back.ru/api/create/?token=token&title=title&type=2&price=400&description=Описание
```

## DELETE
**Демонстрационный вариант удаления записи**
**Ошибки:**
```sh
http://dev.live-back.ru/api/delete/
http://dev.live-back.ru/api/delete/?token=token
```
**Верный вариант:**
```sh
http://dev.live-back.ru/api/delete/?token=token&ID=40
http://dev.live-back.ru/api/delete/?token=token&SKU=SH-52-T-2
```

## INFO
**Демонстрационный вариант информации записи**
**Ошибки:**
```sh
http://dev.live-back.ru/api/info/
http://dev.live-back.ru/api/info/?token=token
```
**Верный вариант:**
```sh
http://dev.live-back.ru/api/info/?token=token&SKU=SH-52-T-2
```

## READ
**Демонстрационный вариант получения всех записей**
**Ошибки:**
```sh
http://dev.live-back.ru/api/read/
http://dev.live-back.ru/api/read/?token=token&page=100
```
**Верный вариант:**
```sh
http://dev.live-back.ru/api/read/?token=token
http://dev.live-back.ru/api/read/?token=token&page=1
```

## UPDATE
**Демонстрационный вариант изменения записи**
**Ошибки:**
```sh
http://dev.live-back.ru/api/update/
http://dev.live-back.ru/api/update/?token=token
```
**Верный вариант:**
```sh
http://dev.live-back.ru/api/update/?token=token&ID=40
http://dev.live-back.ru/api/update/?token=token&SKU=SH-52-T-2
```