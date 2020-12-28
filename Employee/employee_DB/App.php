<?php


class App
{
   private $user;
   private $PDO;
   private $dataBase;
   private $homePage;



    function __construct($user, $PDO, $dataBase, $homePage)
   {
      $this->user = $user;
      $this->PDO = $PDO;
      $this->dataBase = $dataBase;
      $this->homePage = $homePage;

   }

//показ формы добавления

   public function showAdd($errorFields){ 
      include 'forms/form_add.php';
   }

//показ формы удаления

   public function showDel() {
      include 'forms/form_delete.php';
   }

//валидация

   public function checkFieldsValidation(){
      $results = [];
      foreach ($this->user as $key => $value){
          if (empty($value) && $key!="index"){
             $results[] = $key;
        }
      }
      return $results;

   }

//показ формы редактирования

   public function showEdit($errorFields) {
      $userList = $this->readUserRow();
      include 'forms/form_edit.php';
   }


// проверка на наличие таблицы в базе данных

   public function checkDataBaseTable() {
    extract($this->dataBase);
    $tableDB = false;
    $sql = 'SHOW TABLES LIKE "' . $db_table . '"';
    $q = $this->PDO->query($sql);
    if($q->rowCount()){
      $tableDB=true;

    }

    return $tableDB; // true or false

   }
// чтение из базы данных

   public function readDb() {
       extract($this->dataBase);
       $dataMain = [];
       $sql = 'SELECT * FROM ' . $db_table;
       $showBase = $this->PDO->query($sql);

       while ($row = $showBase->fetchAll(PDO::FETCH_ASSOC)){
           $dataMain = $row;
       }

       return $dataMain; // возвращает массив данных

   }
// запись в базу данных

   private function writeDb() {
       extract($this->dataBase);
       extract($this->user);
       $sql = $this->PDO->prepare('INSERT INTO ' . $db_table . ' (`Name`, `Department`, `Phone`) VALUES (?, ?, ?)');
       $sql->execute(array(
           $name,
           $department,
           $phone
       ));

   }

//добавление пользователя

   public function addUser() {
      $this->writeDb();
   }

//редактирование пользователя

   public function editUser() {
    extract($this->dataBase);
    extract($this->user);
    $sql = $this->PDO->prepare('UPDATE ' . $db_table . ' SET Name=?, Department=?, Phone=? WHERE id= ?');
    $sql->execute(array(
        $name,
        $department,
        $phone,
        $index
    ));
   }

//удаление пользователя

   public function deleteUser() {
    extract($this->dataBase);
    $sql = $this->PDO->prepare('DELETE FROM employ WHERE id = ?');
    $sql->execute(array(
        $this->user['index']
    ));

   }

//чтение пользователя по ID

  public function readUserRow() {
    $userRow = [];
    extract($this->dataBase);
    $sql = 'SELECT * FROM ' . $db_table . ' WHERE id = "' . $this->user['index'] . '"';
    $userRow = $this->PDO->query($sql);
    while ($row = $userRow->fetch(PDO::FETCH_ASSOC)){
        $dataMain = $row;
    }
    return $dataMain; //массив данных контретного юзера

   }
}
///////DEBUGER///////
 function debug($item) {
    echo '<pre>';
    print_r($item);
    echo '</pre>';
}

?>
