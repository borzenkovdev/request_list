<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Главная';
$this->params['breadcrumbs'][] = $this->title;
?>

<h1>Система обработки заявок</h1>

<ul>
    <li> Есть фиксированный набор пользователей и 2 роли: менеджер и супервайзер (у каждого юзера - одна роль).</li>

    <li>Заявка проходит линейный жизненный цикл: Создана - В работе - На проверке - Закрыта.</li>

    <li>Любой пользователь может создать заявку.</li>

    <li>При создании заполняются: название, подробное описание.</li>

    <li>Взять заявку в работу может любой менеджер.</li>

    <li>Передать на проверку может только тот менеджер, который взял заявку в работу. При передаче на проверку
        обязательно заполняется описание результата работы.
    </li>

    <li>Закрыть задачу может только супервайзер (любой).</li>

    <li>Всем пользователям доступен реестр заявок (колонки: название, исполнитель, создатель, дата создания, текущий
        статус).
    </li>

    <li>По каждой колонке доступны фильтрация и сортировка.</li>

    <li>Также для менеджеров есть "быстрый фильтр" - "Мои незавершенные заявки" (т.е. заявки в статусе В работе либо На
        проверке, где исполнителем является текущий менеджер).
    </li>

    <li>Всем пользователям доступен просмотр заявки (поля: название, исполнитель, создатель, дата создания, текущий
        статус, подробное описание, результат работы). Супервайзерам также доступен журнал изменения статусов (кто,
        когда и в какой статус перевел заявку).
    </li>

    <li>Супервайзеры могут удалять заявки, а также редактировать поля заявки: название, описание, результат работы
        (результат работы - только для статусов На проверке и Закрыта)
    </li>
</ul>