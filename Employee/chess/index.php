<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
//
//  https://igorcomputer.ru/test_dev/chess/
include "func.php";

$CONFIG = [
    'countCellsVertical'    =>  5,
    'countCellsHorizontal'  =>  5,
    'typeTransform'         =>  0// 0-шахматы, 1-горизонтальные полоски, 2-вертикальные полоски

];


$dir=__DIR__.'/conf';//дириктория конфигов
$listConfigFiles=array();




if(isset($_REQUEST['count_cells_vertical'])){
    $CONFIG['countCellsVertical']   = $_REQUEST['count_cells_vertical'];
}

if(isset($_REQUEST['count_cells_horizontal'])){
    $CONFIG['countCellsHorizontal'] = $_REQUEST['count_cells_horizontal'];
}

if(isset($_REQUEST['type_transform'])){
    $CONFIG['typeTransform']        = $_REQUEST['type_transform'];
}
if(isset($_REQUEST['saveConfigButton'])){
    $saveConfig=json_encode($CONFIG);
      file_put_contents($dir.'/'.time().'', $saveConfig);

    debug2($listConfig);
}

if(isset($_REQUEST['del'])){ // удаление конфигов
$fileDel=$dir.'/'.$_REQUEST['del'];
// debug2($fileDel);
    unlink($fileDel);

}
if(isset($_REQUEST['conf'])){// применяем сохранёный конфиг
    $listConfig=implode(file($dir .'/'.$_REQUEST['conf']));
    $CONFIG=json_decode($listConfig,true);


}

$typesTransform = [
  [ "NAME"=>"Шахматы",         "VALUE"=>0 ],
  [ "NAME"=>"По верткали",     "VALUE"=>1 ],
  [ "NAME"=>"По горизонтали",  "VALUE"=>2 ]
];

$leters  =  range('A','Z');
$numbers =  range(1, $CONFIG['countCellsVertical']);



?>

<!DOCTYPE html>
<html>
<meta charset="utf-8" />
    <head>
        <title>CHESS</title>
        <style type="text/css">
        .main_container {margin:30px auto;display: flex;flex-direction: column;}
        .chess_table {border:1px solid black;margin:20px auto;}
        .wrap_inner {margin:20px auto;font-size: 22px;}
        .wrap_inner_two {margin: auto;font-size: 19px;}
        .grey{ background: grey; width: 25px; height: 25px; text-align: center; }
        .blackColor{ background: black; width: 70px; height: 70px; }
        .whiteColor{ background: white; width: 70px; height: 70px; }
        .cellHorizontal{width: 40px;font-size: 20px;}
        .cellVertical{margin-top: 20px;width: 40px;font-size: 20px;}
        .send_button {font-size: 20px;margin: 20px auto}
        .save_config_button{ font-size: 20px; }
        .saved_config_block{width: 280px;margin:auto}
        .loading_saved_config{list-style: none;font-size: 25px;text-decoration: none;}
        .loading_saved_config li a{text-decoration: none;color: darkgrey;}
        .loading_saved_config li a:hover{color: black}
        .loading_saved_config li a a:hover{color: black}
        .del_saved_config{color: red;position: absolute;}
        .del_saved_config:hover{color: black;}
        </style>
    </head>
    <body>
    <form action="" method="get">
         <div class="main_container">
             <div class="wrap_inner">
                 <input type="number" name="count_cells_vertical"  class="field_vertical"
                        value="<?=$CONFIG['countCellsVertical']?>">Количество клеток по вертикали
                 <br>
                 <input type="number" name=count_cells_horizontal  class="field_horizontal"
                        value="<?=$CONFIG['countCellsHorizontal']?>">Количество клеток по горизонтали <br>
             </div>
             <div class="wrap_inner_two">
             <?foreach($typesTransform as $ITEM):?>
                <?
                $checked = '';
                if($CONFIG['typeTransform'] == $ITEM["VALUE"]){
                   $checked = ' checked';
                }
                ?>
                <input type="radio"<?=$checked?> name="type_transform" value="<?=$ITEM["VALUE"]?>"/><?=$ITEM["NAME"]?>
             <?endforeach;?>
                <br>
                 <input type="submit" value="Сформировать" class="send_button">
                 <input type="submit" name="saveConfigButton" value="Сохранить" class="save_config_button">
             </div>
         </div>
    </form>
<!--    вывод конфигов-->
    <div class="saved_config_block">
    <ul class="loading_saved_config">
    <?foreach (glob($dir .'/*') as $files): //получаем список конфигов?>
     <li>
            <a  href="http://tz2.exods.su/results/chess_igor/?conf=<?=basename($files)?>">Конфиг -<?=basename($files)?></a>
            <a  href="http://tz2.exods.su/results/chess_igor/?del=<?=basename($files)?>"><div style="float: right" ><span class="del_saved_config">X</span></div></a>
            </li>

    <?endforeach;?>
    </ul>

    </div>
<table class="chess_table">

<?php
// $titleCell        = "";
// $classCell        = "";
// $countCellsTitles = 2;
// $isShiftFlag      = true;

// Добавляем к количеству ячеек количество заголовочных ячеек.
$CONFIG['countCellsVertical']   += $countCellsTitles;
$CONFIG['countCellsHorizontal'] += $countCellsTitles;

for ($cellVertical=0; $cellVertical < $CONFIG['countCellsVertical']; $cellVertical++)
{
    echo '<tr>';

    for($cellHorizontal=0; $cellHorizontal<$CONFIG['countCellsHorizontal']; $cellHorizontal++)
    {
        $titleCell = '';
        if($cellVertical==0 or $cellVertical==$CONFIG['countCellsVertical']-1)
        {
            if($cellHorizontal ==0 or $cellHorizontal==$CONFIG['countCellsHorizontal']-1)
            {
                // Добавление пустых угловых клеток
                $classCell = "grey";
            } else {
                // Добавление клеток с буквами
                $titleCell = $leters[$cellHorizontal-1];
                $classCell = "grey";
            }

        } else {

            if (($cellVertical>=1 or $cellVertical==$CONFIG['countCellsVertical']-1) and ($cellHorizontal==0 or $cellHorizontal==$CONFIG['countCellsHorizontal']-1))
            {
               // Добавление клеток с цифрами
                $titleCell = $numbers[$cellVertical-1];
                $classCell = "grey";

            } else {

                // Добавление чернобелых клеток
                if ($CONFIG['typeTransform']=='0') {

                    if (($cellVertical + $cellHorizontal) % 2) {
                        $classCell = "whiteColor";
                    } else {
                        $classCell = "blackColor";
                    }

                    // Добавление чернобелых клеток по горизонтали
                } elseif ($CONFIG['typeTransform']=='2') {

                   if ($isShiftFlag) {
                       $classCell = "whiteColor";
                   } else {
                       $classCell = "blackColor";
                   }

                } else {
                   // Добавление чернобелых клеток по вертикали
                   if (($isShiftFlag + $cellVertical +  $cellHorizontal) % 2) {
                       $classCell = "whiteColor";
                   } else{
                       $classCell = "blackColor";
                   }

                }
            }
        }
        echo "<td class=".$classCell.">".$titleCell."</td>";
    }
    echo "</tr>";
    $isShiftFlag = !$isShiftFlag;
}
?>

        </table>
    </div>
    </body>
</html>
