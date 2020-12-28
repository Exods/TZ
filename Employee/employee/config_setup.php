<?
    $CONFIG = [
        [
            'name'       => 'John Doe',
            'department' => 'Administration',
            'phone'      => '(171)555-2222'
        ]
    ];

   $homePage="http://tz2.exods.su/results/laptop/";

   $row = 1;
           foreach($CONFIG as $i => $value) {
           $keyConfig=array_keys($value);//массив ключей
       }
           $value=array();//массив значений

   //читаем файл data.csv и заносим в $CONFIG
   if (($handle = fopen("data.csv", "r")) !== FALSE) {
       while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
           $num = count($data);
           $row++;
           for ($i=0; $i < $num; $i++) {
               $value[]=$data[$i];
           }
       }
       fclose($handle);

   $ar=array_chunk($value, 3);//разбиваем массив на многомерный
   foreach ($ar as $key => $value) {
       $CONFIG[$key]=array_combine($keyConfig, $value);//комбинирую итоговый CONFIG из ключей и значений
   }

   }
   ?>
