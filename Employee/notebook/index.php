
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
$user = ['name' => $_REQUEST['name'], 'department' => $_REQUEST['department'], 'phone' => $_REQUEST['phone'], 'index' => $_REQUEST['index']];
$homePage = "http://tz2.exods.su/results/notebook/";
$iconList = ['pen' => 'img/pen.jpg', 'basket' => 'img/basket.jpg'];
$userList = []; // Cписок всех пользователей
$validFields = ['name', 'department', 'phone'];
$file = "data.csv";
//подключение функций
include ('func.php');
// ОБЩИЙ СПИСОК ДЕЙСТВИЙ (КОМАНД)
// ----- ADD --------
//показ формы - добавление
if ($cmd == 'showFormAdd') {
    showAdd($results, $homePage, $user);
}
//добавление пользователя
if ($cmd == 'add') {
    $results = checkFieldsValidation($user, $validFields);
    if (!empty($results)) {
        showAdd($results, $homePage, $user);
    } else {
        addUser($user, $file);
    }
}
// ----- EDIT -------
//показ формы - редактирование
if ($cmd == 'showFormEdit') {
    showEdit($user["index"], $homePage, $results);
}
//редактироване пользователя
if ($cmd == 'edit') {
    $results = checkFieldsValidation($user, $validFields);
    if (!empty($results)) {
        showEdit($user["index"], $homePage, $results);
    } else {
        editUser($user, $file);
    }
}
// ----- DELETE -------
//показ формы -  удаление
if ($cmd == 'showFormDel') {
    showDel($user["index"], $homePage);
}
//удаление пользователя
if ($cmd == 'del') {
    deleteUser($user["index"], $file);
}
// Получить список всех пользователей
$userList = getListUsers($file);
?>
<div class="form_wrapper">
    <div class="header_form">
        <h2 class="form_title">Employee <b>Details</b></h2>
        <a class="add_button waves-effect waves-light btn btn-default btn-rounded" href="<?=$homePage
?>?cmd=showFormAdd">+ Add New</a>
    </div>
    <table class="table_employee">
        <?=$editEmployee; ?>
        <?=$confirmWindow; ?>
        <?=$addEmployee ?>
        <tr>
            <th>Name</th>
            <th>Department</th>
            <th>Phone</th>
            <th>Actions</th>
        </tr>
        <?
        foreach ($userList as $employee => $value):?>
            <tr>
                <td><?=$value[0] ?></td>
                <td><?=$value[1] ?></td>
                <td><?=$value[2] ?></td>
                <td>
                    <a href="<?=$homePage ?>?cmd=showFormEdit&index=<?=$employee ?>"><img src="<?=$iconList['pen']; ?>"></a>
                    <a href="<?=$homePage ?>?cmd=showFormDel&index=<?=$employee ?>"><img class="img_basket" src="<?=$iconList['basket']; ?>"></a>
                </td>
            </tr>
        <?endforeach;?>
    </table>
</div>
</body>
</html>
