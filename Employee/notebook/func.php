<?php
// ---- ADD -----
// показ формы добавления
function showAdd($results, $homePage, $user) {
    include 'forms/form_add.php';
}


// добавление нового пользователя, принимает параметр массив данных
function addUser($user, $filePath) {
    $dataMain = fileRead($filePath);
    $modalData = $user;
    array_pop($modalData);
    array_push($dataMain, $modalData);
    fileWrite($dataMain, $filePath);
}


// ---- EDIT ---------
// показ формы редактирования
function showEdit($index, $homePage, $results) {
    $userList = getListUsers('data.csv');
    include 'forms/form_edit.php';
}


// редактирование пользователя, принимает $user пользователя для редактирования
function editUser($user, $filePath) {
    $dataMain = fileRead($filePath);
    for ($i = 0;$i < count($dataMain[$user['index']]);$i++) { //заполняем массив новыми данными
        $dataMain[$user['index']][$i] = array_values($user) [$i];
    }
    fileWrite($dataMain, $filePath);
}


// ----- DELETE -----
// показ формы удаления
function showDel($index, $homePage) {
    include 'forms/form_delete.php';
}


// удаление пользователя, принимает параметр  удаления
function deleteUser($index, $filePath) {
    $dataMain = fileRead($filePath);
    unset($dataMain[$index]);
    fileWrite($dataMain, $filePath);
}


// ----- Validation ----
//проверка на пустые поля
function checkFieldsValidation($user, $validFields) {
    $results = [];
    array_pop($user);
    foreach ($user as $key => $value) {
        if (empty($value)) {
            $results[$key] = $key;
        }
    }
    return $results;
}


// ----- GET LIST USERS ----
// возвращает массив всех пользователей
function getListUsers($filePath) {
    return $dataMain = fileRead($filePath);
}


// ---- FILE OPERATIONS ------
// Чтение файла возвращает массив пользователей
function fileRead($filePath) {
    $file = fopen($filePath, "r");
    while (($data = fgetcsv($file, 1000, ",")) !== false) {
        $dataMain[] = $data;
    }
    fclose($file);
    return $dataMain;
}


// Запись в файл
function fileWrite($user, $filePath) {
    $fp = fopen($filePath, 'w');
    foreach ($user as $iter) {
        fputcsv($fp, $iter);
    }
    fclose($fp);
}
function debug($item) {
    echo '<pre>';
    print_r($item);
    echo '</pre>';
}
