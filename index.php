<?php

$db = require('connect.php');
$yearsQuery = $db->prepare(
    'select distinct Extract(YEAR from ExpirationOfTheTerm) FROM Contract'
);
$yearsQuery
    ->execute();
$years = $yearsQuery
    ->fetchAll();

?>
<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
          integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB"
          crossorigin="anonymous">
    <meta charset="utf-8">
    <title>Переизбрание</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" >Конкурс на замещение должностей педагогических работников</a>
</nav>
<div class="container">
    <div class="Jumbotron">
        <form method="GET">
            Окончание срока трудового договора на
            <select class="form-control-sm" name="year">
                <?php foreach ($years as $year) { ?>
                    <option
                            value="<?= htmlspecialchars($year[0]) ?>"
                        <?php
                        if (
                            isset($_GET['year']) &&
                            $_GET['year'] == $year[0]
                        ) {
                            echo ' selected';
                        }
                        ?>
                    >
                        <?= htmlspecialchars($year[0]) ?>
                    </option>
                <?php } ?>
            </select>
            год
            <input class="btn btn-primary" type="submit" value="Найти">
        </form>
        <?php
        if (isset($_GET['year'])) {
            $query = $db->prepare('
				SELECT
                      Teacher.PersonnelNumber,
                      Teacher.lastName,
                      Teacher.FirstName,
                      Teacher.patronymic,
                      Contract.ExpirationOfTheTerm
                    FROM Teacher
                      INNER JOIN Contract ON Teacher.PersonnelNumber = Contract.Teacher
                    WHERE year(Contract.ExpirationOfTheTerm) = :year
			');
            $query->execute(['year' => $_GET['year']]);
            $teachers = $query->fetchAll();
            if (count($teachers) > 0) {
                ?>
                <ul>
                    <table class="table" style="text-align:center;">
                        <tbody>
                        <?php foreach ($teachers as $teacher) { ?>
                            <tr>
                                <td><?= htmlspecialchars($teacher['lastName']) . ' ' .
                                    htmlspecialchars($teacher['FirstName']) . ' ' .
                                    htmlspecialchars($teacher['patronymic']) ?></td>
                                <?php
                                $myDate = DateTime::createFromFormat('Y-m-d', $teacher['ExpirationOfTheTerm']);
                                $Date = $myDate->format('d.m.Y');
                                ?>
                                <td><?= htmlspecialchars($Date) ?></td>
                                <td> <?php echo "<a href=\"personalInformation.php?id=" .
                                        $teacher['PersonnelNumber'] . "\">Показать список действий</a>"; ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </ul>
                <?php
            } else {
                ?>
                <div class="alert alert-warning" role="alert">
                    Преподаватели в этом году не переизбираются.
                </div>
                <?php
            }
        }
        ?>
        <form action="/registration.php">
            <button class="btn btn-primary" type="submit">Зарегистрировать преподавателя</button>
        </form>
    </div>
</div>
</body>
</html>	
