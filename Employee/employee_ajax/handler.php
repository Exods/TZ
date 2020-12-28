<?php
$cmd = $_REQUEST['cmd'];
$user = [
    'name'       => trim($_REQUEST['name']),
    'department' => trim($_REQUEST['department']),
    'phone'      => trim($_REQUEST['phone']),
    'index'      => trim($_REQUEST['index'])
];
$homePage = "http://tz2.exods.su/results/notebook_ajax/";
$iconList = ['pen' => 'img/pen.jpg', 'basket' => 'img/basket.jpg'];
$userList = []; // Cписок всех пользователей
$validFields = ['name', 'department', 'phone'];
$capchFalse= '';
$file = "data.csv";
$dataBase = [
    'db_host'     => 'localhost',
    'db_name'     => 'exodss_db',
    'db_table'    => 'employ',
    'db_user'     => 'exodss_db',
    'db_password' => 'Qwerty7'
];


//подключение функций
include_once  'App.php';


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
    $app->showAdd();
}
//добавление пользователя
if ($cmd == 'add'){
    $capchFalse = recapcha($capchFalse);
    // debug($capchFalse);
    if(!$capchFalse[1]){
    $app->validCapch($capchFalse);
   }else{
       $app->addUser($iconList,$capchFalse);
   }


}


// ----- EDIT -------
//показ формы - редактирование
if ($cmd == 'showFormEdit'){
    $app->showEdit();

}
//редактироване пользователя
if ($cmd == 'edit'){
     $capchFalse = recapcha($capchFalse);
    if(!$capchFalse[1]){
    $app->validCapch($capchFalse);
    }else{
        $app->editUser($iconList, $capchFalse);
    }

}
// ----- DELETE -------
//показ формы -  удаление
if ($cmd == 'showFormDel'){
    $app->showDel();
}
//удаление пользователя
if ($cmd == 'del'){
    $app->deleteUser($iconList);
}
if ($cmd == 'closeEditDialog'){
   echo 'closeEditDialog';
}
// Получить список всех пользователей
$userList = $app->readDB();

function recapcha($capchFalse){
    $recaptcha = $_POST['g-recaptcha-response'];
    if(!empty($recaptcha)) {
        //Получаем HTTP от recaptcha
        $recaptcha = $_REQUEST['g-recaptcha-response'];

        $secret = '6LcumdQZAAAAADw04kGNleaH7KB3XNwuNQlLJx6T';
        //Формируем utl адрес для запроса на сервер гугла
        $url = "https://www.google.com/recaptcha/api/siteverify?secret=".$secret ."&response=".$recaptcha."&remoteip=".$_SERVER['REMOTE_ADDR'];

        //Инициализация и настройка запроса
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, 10);
        curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.16) Gecko/20110319 Firefox/3.6.16");
        //Выполняем запрос и получается ответ от сервера гугл
        $curlData = curl_exec($curl);

        curl_close($curl);
        //Ответ приходит в виде json строки, декодируем ее
        $curlData = json_decode($curlData, true);

        //Смотрим на результат
        if($curlData['success']) {
            $capchFalse=['',true ];

           return  $capchFalse;

        } else {
        //Капча не пройдена
            $capchFalse=['wrong',false ];
          return $capchFalse ;
        }
    }else {
        //Капча не введена
        $capchFalse=['empty',false ];
       return $capchFalse;

    }
}

