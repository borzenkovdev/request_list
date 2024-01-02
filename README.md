Application processing system
-------------------
There is a fixed set of users and 2 roles: manager and supervisor (each user has one role).

An application goes through a linear life cycle: Created - In progress - Under review - Closed.

Any user can create a request.

When creating, fill in: name, detailed description.

Any manager can accept an application.

Only the manager who accepted the application can submit it for review. When submitting for inspection, a description of the work result must be filled out.

Only a supervisor (anyone) can close a task.

The register of applications is available to all users (columns: title, artist, creator, creation date, current status).

Filtering and sorting are available for each column.

There is also a “quick filter” for managers - “My unfinished applications” (i.e. applications in the status In progress or Under review, where the executor is the current manager).

All users can view the application (fields: title, executor, creator, creation date, current status, detailed description, work result). Supervisors also have access to a log of status changes (who, when and to what status the application was transferred).

Supervisors can delete applications, as well as edit application fields: title, description, work result (work result - only for the statuses Under review and Closed)

DIRECTORY STRUCTURE
-------------------

       assets/ contains assets definition
       config/ contains application configurationsls
       controllers/ contains Web controller classes
       runtime/ contains files generated during runtime
       vendor/ contains dependent 3rd-party packages
       views/ contains view files for the Web application
       web/ contains the entry script and Web resources

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
Expand the qiwi database and upload a dump to it - /qiwi.sql. Connection settings in config/db.php

Users:

admin
manager
manager2,
manager3

password for all accounts 12345
~~~

You can then access the application through the following URL:
~~~
http://localhost/web/
~~~
