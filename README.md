Application processing system   Система обработки заявок
============================п
There is a fixed set of users and 2 roles: manager and supervisor (each user has one role).
The application passes a linear lifecycle: Created - In work - At checkout - Closed
Any user can create an application. When creating, fill in: title, detailed description.
Any manager can take a job. Send only the manager who took the application to work for verification. When submitting for inspection, a description of the result of the work must be completed.
Close the task can only supervisor (any)
All users can access the register of applications (columns: title, artist, creator, creation date, current status). For each column, filtering and sorting are available. Also for managers there is a "quick filter" - "My pending applications" (ie applications in the status In work or On the check, where the executor is the current manager)
All users can view the application (fields: name, artist, creator, creation date, current status, detailed description, work result). Supervisors also have a log of status changes (who, when, and to what status the application was transferred)
Supervisors can delete applications, and also edit the fields of the application: title, description, result of work (the result of work is only for the statuses On the Verification and Closed)

Есть фиксированный набор пользователей и 2 роли: менеджер и супервайзер (у каждого юзера - одна роль).
Заявка проходит линейный жизненный цикл: Создана - В работе - На проверке - Закрыта
Любой пользователь может создать заявку. При создании заполняются: название, подробное описание.
Взять заявку в работу может любой менеджер. Передать на проверку может только тот менеджер, который взял заявку в работу. При передаче на проверку обязательно заполняется описание результата работы.
Закрыть задачу может только супервайзер (любой)
Всем пользователям доступен реестр заявок (колонки: название, исполнитель, создатель, дата создания, текущий статус). По каждой колонке доступны фильтрация и сортировка. Также для менеджеров есть "быстрый фильтр" - "Мои незавершенные заявки" (т.е. заявки в статусе В работе либо На проверке, где исполнителем является текущий менеджер)
Всем пользователям доступен просмотр заявки (поля: название, исполнитель, создатель, дата создания, текущий статус, подробное описание, результат работы). Супервайзерам также доступен журнал изменения статусов (кто, когда и в какой статус перевел заявку)
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

### Install via Composer

If you do not have [Composer](http://getcomposer.org/), you may install it by following the instructions
at [getcomposer.org](http://getcomposer.org/doc/00-intro.md#installation-nix).

You can then install this project template using the following command:

~~~
php composer.phar install
~~~

You can then access the application through the following URL:
~~~
http://localhost/web/
~~~

