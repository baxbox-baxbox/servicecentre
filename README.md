# servicecentre

Ставим openserver.
Копируем папку servicentre в c:\OpenServer\domains\

Настройка openserver:
1. Сервер 

Если 80-й порт занят, меняем его на 81.

2. Модули

Apache-2.4

PHP-5.5

MySQL-5.5

 
Создаем базу данных servicecentre в phpmyadmin.
Импортируем базу из servicecentre.sql (кодировка utf-8).
Запускаем сайт через подменю «мои сайты» openserver.

Описание: сайт для поддержки работы сервисного центра. Несколько ролей (клиент, менеджер, работник, админ).
Написан на php + БД MySQL.
