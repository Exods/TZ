<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Document</title>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php
$cmd = $_REQUEST['cmd'];
$user = [
    'name'       => trim($_REQUEST['name']),
    'department' => trim($_REQUEST['department']),
    'phone'      => trim($_REQUEST['phone']),
    'index'      => trim($_REQUEST['index'])
];
$homePage = "http://tz2.exods.su/results/notebook_DB/";
$iconList = ['pen' => 'img/pen.jpg', 'basket' => 'img/basket.jpg'];
$userList = []; // Cписок всех пользователей
$validFields = ['name', 'department', 'phone'];
$file = "data.csv";
$dataBase = [
    'db_host'     => 'localhost',
    'db_name'     => 'exodss_db',
    'db_table'    => 'employ',
    'db_user'     => 'exodss_db',
    'db_password' => 'Qwerty7'
];

$errorFields = [];

//подключение функций
// include ('func.php');
include 'App.php';
// подключение к базе данных
try
{
    extract($dataBase);
    $PDO = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $app = new App($user,$PDO,$dataBase,$homePage);

}
catch(PDOException $e)
{
    echo "Error DB connection";
    die;
}

if (!$app->checkDataBaseTable()){
    echo "Has no table ";
    die;

}

// ОБЩИЙ СПИСОК ДЕЙСТВИЙ (КОМАНД)
// ----- ADD --------
//показ формы - добавление
if ($cmd == 'showFormAdd'){
    $app->showAdd($errorFields);
}
//добавление пользователя
if ($cmd == 'add'){

    $errorFields = $app->checkFieldsValidation();

    if (!empty($errorFields)){
        $app->showAdd($errorFields);
    } else{
        $app->addUser();
    }
}
// ----- EDIT -------
//показ формы - редактирование
if ($cmd == 'showFormEdit'){
    $app->showEdit($errorFields);
}
//редактироване пользователя
if ($cmd == 'edit'){

    $errorFields = $app->checkFieldsValidation();

    if (!empty($errorFields)){
        $app->showEdit($errorFields);
    } else{
        $app->editUser();
    }
}
// ----- DELETE -------
//показ формы -  удаление
if ($cmd == 'showFormDel'){
    $app->showDel();
}
//удаление пользователя
if ($cmd == 'del'){
    $app->deleteUser();
}
// Получить список всех пользователей
$userList = $app->readDB();
?>
<div class="form_wrapper">
    <div class="header_form">
        <h2 class="form_title">Employee <b>Details111</b></h2>
        <a class="add_button waves-effect waves-light btn btn-default btn-rounded" href="<?=$homePage
?>?cmd=showFormAdd">+ Add New</a>
    </div>
    <table class="table_employee">
        <?=$editEmployee?>
        <?=$confirmWindow?>
        <?=$addEmployee?>
        <tr>
            <th>Name</th>
            <th>Department</th>
            <th>Phone</th>
            <th>Actions</th>
        </tr>
        <?foreach ($userList as $employee => $value): ?>
            <tr>
                <td><?=$value['Name'] ?></td>
                <td><?=$value['Department'] ?></td>
                <td><?=$value['Phone'] ?></td>
                <td>
                    <a href="<?=$homePage ?>?cmd=showFormEdit&index=<?=$value['id'] ?>"><img src="<?=$iconList['pen']; ?>"></a>
                    <a href="<?=$homePage ?>?cmd=showFormDel&index=<?=$value['id'] ?>"><img class="img_basket" src="<?=$iconList['basket']; ?>"></a>
                </td>
            </tr>
        <?endforeach; ?>
    </table>
</div>
</body>
</html>
