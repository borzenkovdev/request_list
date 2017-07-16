Application processing system   ������� ��������� ������
============================�
There is a fixed set of users and 2 roles: manager and supervisor (each user has one role).
The application passes a linear lifecycle: Created - In work - At checkout - Closed
Any user can create an application. When creating, fill in: title, detailed description.
Any manager can take a job. Send only the manager who took the application to work for verification. When submitting for inspection, a description of the result of the work must be completed.
Close the task can only supervisor (any)
All users can access the register of applications (columns: title, artist, creator, creation date, current status). For each column, filtering and sorting are available. Also for managers there is a "quick filter" - "My pending applications" (ie applications in the status In work or On the check, where the executor is the current manager)
All users can view the application (fields: name, artist, creator, creation date, current status, detailed description, work result). Supervisors also have a log of status changes (who, when, and to what status the application was transferred)
Supervisors can delete applications, and also edit the fields of the application: title, description, result of work (the result of work is only for the statuses On the Verification and Closed)

���� ������������� ����� ������������� � 2 ����: �������� � ����������� (� ������� ����� - ���� ����).
������ �������� �������� ��������� ����: ������� - � ������ - �� �������� - �������
����� ������������ ����� ������� ������. ��� �������� �����������: ��������, ��������� ��������.
����� ������ � ������ ����� ����� ��������. �������� �� �������� ����� ������ ��� ��������, ������� ���� ������ � ������. ��� �������� �� �������� ����������� ����������� �������� ���������� ������.
������� ������ ����� ������ ����������� (�����)
���� ������������� �������� ������ ������ (�������: ��������, �����������, ���������, ���� ��������, ������� ������). �� ������ ������� �������� ���������� � ����������. ����� ��� ���������� ���� "������� ������" - "��� ������������� ������" (�.�. ������ � ������� � ������ ���� �� ��������, ��� ������������ �������� ������� ��������)
���� ������������� �������� �������� ������ (����: ��������, �����������, ���������, ���� ��������, ������� ������, ��������� ��������, ��������� ������). ������������� ����� �������� ������ ��������� �������� (���, ����� � � ����� ������ ������� ������)
������������ ����� ������� ������, � ����� ������������� ���� ������: ��������, ��������, ��������� ������ (��������� ������ - ������ ��� �������� �� �������� � �������)
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

