<?php
$db = require('connect.php');

$rankQuery = $db->prepare(
    'select * FROM Rank'
);
$rankQuery
    ->execute();
$ranks = $rankQuery
    ->fetchAll();

$PositionQuery = $db->prepare(
    'select * FROM Position'
);
$PositionQuery
    ->execute();
$Positions = $PositionQuery
    ->fetchAll();

$DegreeQuery = $db->prepare(
    'select * FROM Degree'
);
$DegreeQuery
    ->execute();
$Degrees = $DegreeQuery
    ->fetchAll();

$ConditionOfAttractionQuery = $db->prepare(
    'select * FROM `Contract_type`'
);
$ConditionOfAttractionQuery
    ->execute();
$ConditionOfAttractions = $ConditionOfAttractionQuery
    ->fetchAll();

if (isset($_POST['valueDate'])) {
    $myDate = DateTime::createFromFormat('Y-m-d', $_POST['valueDate']);
}
?>

<?php
$error = '';
if (count($_POST) > 0) {
    if (
        $_POST['LastName'] != '' &&
        $_POST['FirstName'] != '' &&
        $_POST['Position'] != ''
    ) {
        $sql = " 
			INSERT INTO `Teacher` 
			(`LastName`, `FirstName`, `Patronymic`, `Address`, `Phone`, `Rank`, `Position`, `Degree`) 
			VALUES (:LastName, :FirstName, :Patronymic, :Address, :Phone, :Rank, :Position, :Degree)				
			";
        $query = $db->prepare($sql);
        $result = $query->execute([
            'LastName' => $_POST['LastName'],
            'FirstName' => $_POST['FirstName'],
            'Patronymic' => $_POST['Patronymic'],
            'Address' => $_POST['Address'],
            'Phone' => $_POST['Phone'],
            'Rank' => $_POST['Rank'],
            'Position' => $_POST['Position'],
            'Degree' => $_POST['Degree'],
        ]);
        if ($result) {
            $id = $db->lastInsertId();            
            $dateContract = $_POST['valueDate'];
            $dateContract = DateTime::createFromFormat('Y-m-d', $dateContract);
            $dateContract = date_add($dateContract, date_interval_create_from_date_string("1 year"));
            $sqlContract = " 
							INSERT INTO `Contract` 
							(`Teacher`, `ConditionOfAttraction`, `ExpirationOfTheTerm`) 
							VALUES (:Teacher, :ConditionOfAttraction, :ExpirationOfTheTerm)				
							";
            $queryContract = $db->prepare($sqlContract);
            $result = $queryContract->execute([
                'Teacher' => $id,
                'ConditionOfAttraction' => $_POST['ConditionOfAttraction'],
                'ExpirationOfTheTerm' => $dateContract->Format('Y-m-d')
            ]);
            If (!$result) {
                var_dump($queryContract->errorInfo());
            } else {
                $success = 'Успешное сохранение.';
            }

        } else {
            var_dump($query->errorInfo());
        }
    } else {
        $error = "Проверьте, чтобы были заполнены поля: Фамилия, Имя, Должность";
    };

};
?>

<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
          integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB"
          crossorigin="anonymous">
    <meta charset="utf-8">
    <title>Регистрация преподавателя</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand">Регистрация преподавателя</a>
</nav>
<div class="container">
    <div class="row">
        <div class="form-group">
            <form action="/index.php">
                <button type="submit" class="form-control btn btn-primary">Вернуться на главную</button>
            </form>
        </div>
    </div>
    <form class="form-horizontal" method="POST" action="">
        <fieldset>
            <!-- Form Name -->
            <legend>Данные о преподавателе</legend>
            <?php if (isset($error) && $error): ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>
            <?php if (isset($success) && $success): ?>
                <div class="alert alert-success"><?= $success ?></div>
            <?php endif; ?>

            <!-- Select Date -->
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label class="control-label" for="Position">Дата избрания</label>
                        <input class="form-control" type="date" name="valueDate" value="<?php
                        if (isset($myDate)) {
                            echo htmlspecialchars($myDate->format('Y-m-d'));
                        } else {
                            echo date('Y-m-d');
                        }
                        ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <!-- Text input-->
                    <div class="form-group">
                        <label class="control-label" for="LastName">Фамилия</label>
                        <input id="LastName" name="LastName" placeholder="Иванов" class="form-control input-md" type="text"
						value="<?= htmlspecialchars($_POST['LastName']) ?>"
                                    <?php
                                    if (
                                        isset($_POST['LastName']) &&
                                        $_POST['LastName'] ==  $_POST['LastName']
                                    ) {
                                        echo $_POST['LastName'];
                                    }
                                    ?>
                       >						
                    </div>
                </div>
                <!-- Text input-->
                <div class="col-2">
                    <div class="form-group">
                        <label class="control-label" for="FirstName">Имя</label>
                        <input id="FirstName" name="FirstName" placeholder="Иван" class="form-control input-md" type="text"
						value="<?= htmlspecialchars($_POST['FirstName']) ?>"
                                    <?php
                                    if (
                                        isset($_POST['FirstName']) &&
                                        $_POST['FirstName'] ==  $_POST['FirstName']
                                    ) {
                                        echo $_POST['FirstName'];
                                    }
                                    ?>
						>
                    </div>
                </div>
                <!-- Text input-->
                <div class="col-2">
                    <div class="form-group">
                        <label class="control-label" for="Patronymic">Отчество</label>
                        <input id="Patronymic" name="Patronymic" placeholder="Иванович"
                               class="form-control input-md" type="text"
							   value="<?= htmlspecialchars($_POST['Patronymic']) ?>"
                                    <?php
                                    if (
                                        isset($_POST['Patronymic']) &&
                                        $_POST['Patronymic'] ==  $_POST['Patronymic']
                                    ) {
                                        echo $_POST['Patronymic'];
                                    }
                                    ?>
						>
                    </div>
                </div>
            </div>
            <!-- Text input-->
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label class="control-label" for="Address">Адрес</label>
                        <input id="Address" name="Address" placeholder="Город, улица, дом, квартира"
                               class="form-control input-md" type="text">
                    </div>
                </div>
            </div>
            <!-- Text input-->
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label class="control-label" for="Phone">Телефон</label>
                        <input id="Phone" name="Phone" placeholder="79529114015" class="form-control input-md"
                               type="text">
                    </div>
                </div>
            </div>
            <!-- Multiple Radios -->
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label class="control-label" for="Rank">Ученое звание</label>
                        <select class="form-control input-md" name="Rank">
                            <?php foreach ($ranks as $rank) { ?>
                                <option
                                        value="<?= htmlspecialchars($rank[0]) ?>"
                                    <?php
                                    if (
                                        isset($_POST['rank']) &&
                                        $_POST['rank'] == $rank[0]
                                    ) {
                                        echo ' selected';
                                    }
                                    ?>
                                >
                                    <?= htmlspecialchars($rank[1]) ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <!-- Text input-->
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label class="control-label" for="Degree">Ученая степень</label>
                        <select class="form-control input-md" name="Degree">
                            <?php foreach ($Degrees as $Degree) { ?>
                                <option
                                        value="<?= htmlspecialchars($Degree[0]) ?>"
                                    <?php
                                    if (
                                        isset($_POST['Degree']) &&
                                        $_POST['Degree'] == $Degree[0]
                                    ) {
                                        echo ' selected';
                                    }
                                    ?>
                                >
                                    <?= htmlspecialchars($Degree[1]) ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <!-- Select Multiple -->
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label class="control-label" for="Position">Должность</label>
                        <select class="form-control input-md" name="Position">
                            <?php foreach ($Positions as $Position) { ?>
                                <option
                                        value="<?= htmlspecialchars($Position[0]) ?>"
                                    <?php
                                    if (
                                        isset($_POST['Position']) &&
                                        $_POST['Position'] == $Position[0]
                                    ) {
                                        echo ' selected';
                                    }
                                    ?>
                                >
                                    <?= htmlspecialchars($Position[1]) ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <!-- Select Multiple -->
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label class="control-label" for="Position">Условие привлечения</label>
                        <select class="form-control input-md" name="ConditionOfAttraction">
                            <?php foreach ($ConditionOfAttractions as $ConditionOfAttraction) { ?>
                                <option
                                        value="<?= htmlspecialchars($ConditionOfAttraction[0]) ?>"
                                    <?php
                                    if (
                                        isset($_POST['ConditionOfAttraction']) &&
                                        $_POST['ConditionOfAttraction'] == $ConditionOfAttraction[0]
                                    ) {
                                        echo ' selected';
                                    }
                                    ?>
                                >
                                    <?= htmlspecialchars($ConditionOfAttraction[1]) ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <!-- Button -->
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label class="control-label" for="singlebutton"></label>
                        <button id="singlebutton" name="singlebutton" class="btn btn-primary">Сохранить</button>
                    </div>
                </div>
            </div>
        </fieldset>
    </form>
</div>
</body>
</html>
