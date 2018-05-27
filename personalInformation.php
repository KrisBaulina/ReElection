<?php
$db = require('connect.php');
?>

<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
          integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB"
          crossorigin="anonymous">
    <meta charset="utf-8">
    <title>Персональные данные</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand">Персональные данные</a>
</nav>
<div class="container">
    <form action="/index.php">
        <button class="btn btn-primary" type="submit">Вернуться на главную</button>
    </form>
    <div class="Jumbotron">

        <?php
        if (isset($_GET['id'])) {
            $query = $db->prepare('
				SELECT Teacher.lastName, Teacher.FirstName, Teacher.patronymic, Contract.ExpirationOfTheTerm
				FROM Teacher 
				inner join Contract on Teacher.PersonnelNumber = Contract.Teacher
				where Teacher.PersonnelNumber = :id
			');
            $query->execute(['id' => $_GET['id']]);
            $teacher = $query->fetch();
            echo "<h1>";
            echo htmlspecialchars($teacher['lastName']) . " " . htmlspecialchars($teacher['FirstName']) . " " . htmlspecialchars($teacher['patronymic']);
            echo "</h1>";
            echo "Последовательность действий:<br>";
            $date = date_create($teacher['ExpirationOfTheTerm']);
            echo "<table class='table'>";
            echo "<tbody>";
            $date = date_add($date, date_interval_create_from_date_string("-72 days"));
            echo "<tr><td>До " . $date->format("d.m.Y") . " подача СЛЗ на объявление конкурса</td>";
            echo "<td><a href=\"Служебная записка на объявление конкурса.docx\">Шаблон СЛЗ</a></td></tr>";
            $date = date_add($date, date_interval_create_from_date_string("7 days"));
            echo "<tr><td>До " . $date->format("d.m.Y") . " объявление конкурса на замещение вакантных должностей</td></tr>";
            $date = date_add($date, date_interval_create_from_date_string("45 days"));
            echo "<tr><td>До " . $date->format("d.m.Y") . " подача пакета документов на конкурс педагогическим работником</td>";
            echo "<td><a href=\"Пакет документов.rar\">Пакет докмуентов</a></td></tr>";
            $date = date_add($date, date_interval_create_from_date_string("2 days"));
            echo "<tr><td>До " . $date->format("d.m.Y") . " передача пакета документов из управления кадровой политики заведующему кафедрой</td></tr>";
            $date = date_add($date, date_interval_create_from_date_string("3 days"));
            echo "<tr><td> До " . $date->format("d.m.Y") . " рассмотрение пакета документов</td></tr>";
            $date = date_add($date, date_interval_create_from_date_string("7 days"));
            echo "<tr><td>До " . $date->format("d.m.Y") . " рассмотрение кандидата на ученом совете </td></tr>";
            $date = date_add($date, date_interval_create_from_date_string("7 days"));
            echo "<tr><td>До " . $date->format("d.m.Y") . " перезаключение трудового договора</td></tr>";
            echo "</tbody>";
            echo "</table>";

        }
        ?>
    </div>
</div>
</body>
</html>
