Система обработки заявок
-------------------
Есть фиксированный набор пользователей и 2 роли: менеджер и супервайзер (у каждого юзера - одна роль). 

Заявка проходит линейный жизненный цикл: Создана - В работе - На проверке - Закрыта. 

Любой пользователь может создать заявку. 

При создании заполняются: название, подробное описание.

Взять заявку в работу может любой менеджер. 

Передать на проверку может только тот менеджер, который взял заявку в работу. При передаче на проверку обязательно заполняется описание результата работы. 

Закрыть задачу может только супервайзер (любой). 

Всем пользователям доступен реестр заявок (колонки: название, исполнитель, создатель, дата создания, текущий статус).

По каждой колонке доступны фильтрация и сортировка. 

Также для менеджеров есть "быстрый фильтр" - "Мои незавершенные заявки" (т.е. заявки в статусе В работе либо На проверке, где исполнителем является текущий менеджер). 

Всем пользователям доступен просмотр заявки (поля: название, исполнитель, создатель, дата создания, текущий статус, подробное описание, результат работы). Супервайзерам также доступен журнал изменения статусов (кто, когда и в какой статус перевел заявку). 

Супервайзеры могут удалять заявки, а также редактировать поля заявки: название, описание, результат работы (результат работы - только для статусов На проверке и Закрыта) 

DIRECTORY STRUCTURE
-------------------

      assets/             contains assets definition
      config/             contains application configurationsls
      controllers/        contains Web controller classes
      runtime/            contains files generated during runtime
      vendor/             contains dependent 3rd-party packages
      views/              contains view files for the Web application
      web/                contains the entry script and Web resources

REQUIREMENTS
------------

The minimum requirement by this project template that your Web server supports PHP 5.4.0.


INSTALLATION
------------

1.
~~~
php composer.phar install
~~~

If you do not have [Composer](http://getcomposer.org/), you may install it by following the instructions
at [getcomposer.org](http://getcomposer.org/doc/00-intro.md#installation-nix).

2.
~~~
Развернуть базу qiwi  и залить в  неё дамп - /qiwi.sql. Настройки подключения в config/db.php

Пользователи:

admin
manager
manager2,
manager3

пароль от всех учёток 12345
~~~

You can then access the application through the following URL:
~~~
http://localhost/web/
~~~

