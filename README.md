# Тестовое задание Book24

## Общее описание:
Основной акцент при реализации был сделан на Domain, старался придерживаться DDD

Баланс специально выделил в отдельную сущность из-за ключевой бизнес логики +
необходимость связать изменение баланса с транзакциями.

Возможно, сущности Transaction и TransactionGroup названы неточно и есть смысл пересмотреть именование:
- Transaction -> Operation
- TransactionGroup -> Transaction

При реализации не предусмотрел локи транзакций на уровне базы

Остальные спорные моменты оформил в @todo блоки

REST method:

POST http://localhost:8080/balance/transfer/{senderId}/{receiverId}/{amount}

## Инициализация проекта:
- git clone https://github.com/qqsicky/books-test-task.git
- cd books-test-task
- cp docker-compose.yaml.dist docker-compose.yaml
- cp phpunit.xml.dist phpunit.xml
- make up
- make composer-install
- make recreate-db
- make start-tests


## Связь:
Телеграм: _@qqsicky_

Почта: _qqsicky@gmail.com_
