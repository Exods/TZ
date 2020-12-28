<!DOCTYPE html>
<html>
<meta charset="utf-8" />
    <head>
        <title>
            CHESS
        </title>

        <style type="text/css">
            .grey{
                background: grey;
                width: 25px;
                height: 25px;
                text-align: center;
            }
            .blackColor{
                background: black;
                width: 70px;
                height: 70px;
            }
            .whiteColor{
                background: white;
                width: 70px;
                height: 70px;
            }
        </style>
    </head>
    <body>

   <?
    if (isset($_POST['cellVertical']) and  isset($_POST['cellHorizontal']) and isset($_POST['transform'])){
    $form = [

        'cellVertical'        =>  $_POST['cellVertical'],
        'cellHorizontal'      =>  $_POST['cellHorizontal'],
        'transform'           =>  $_POST['transform']


           ];

for ($radioButton=0; $radioButton <= $_POST['transform']; $radioButton++) {
    if($radioButton==$_POST['transform']){
        $form['radioButton'][$radioButton]='checked';

    }

}

}else{

       $form = [
        'cellVertical'         =>  '5',
        'cellHorizontal'       =>  '5'

       ];
       $form['radioButton'][0]='checked';
   }
?>
                       <form action="chess.php" method="post">
                <div style="margin:30px auto;display: flex;flex-direction: column;">
                    <div style="margin:20px auto;font-size: 22px;">
                        <input type="number" name="cellHorizontal"  style="width: 40px;font-size: 20px;" value="<?echo $form['cellHorizontal']?>">Количество клеток по горизонтали <br>
                        <input type="number" name="cellVertical"  style="margin-top: 20px;width: 40px;font-size: 20px;" value="<?echo $form['cellVertical']?>">Количество клеток по вертикали
                        <br>
                    </div>
                    <div style="margin: auto;font-size: 19px;">
                    <? echo '<input type="radio" name="transform" value="0"'.$form['radioButton'][0].'/>Шахматы' ?>
                    <? echo '<input type="radio" name="transform" value="1"'.$form['radioButton'][1].'/>По верткали'?>
                    <? echo '<input type="radio" name="transform" value="2"'.$form['radioButton'][2].'/>По горизонтали <br>'?>


                        <!-- <input type="radio" name="transform" value="1" />Шахматы
                        <input type="radio" name="transform" value="2" />По верткали
                        <input type="radio" name="transform" value="3"/>По горизонтали <br> -->
                        <input type="submit" value="Сформируй" style="font-size: 20px;margin: 20px auto">
                    </div>
                </form>

        <div>



        <table style="border:1px solid black;margin:20px auto;">
            <?php

// Параметры поля



if (isset($_POST['cellVertical']) and  isset($_POST['cellHorizontal']) and isset($_POST['transform'])) {
    $board = [

        'cellVertical'        =>  $_POST['cellVertical'],
        'cellHorizontal'      =>  $_POST['cellHorizontal'],
        'field'               =>  2,
        'transform'           =>  $_POST['transform'],
        'count'               =>  true,
        'colorCellBackground' =>  '',
        'titleCell'           =>  ''

    ];

}
// Генерация символов для заполнения клеток с полями

$leters       =   range('A','Z');
$numbers      =   range(1,$board['cellVertical']);

// Добавление дополнительных клеток для полей

$board['cellVertical']   += $board['field'];
$board['cellHorizontal'] += $board['field'];


for ($cellVertical=0; $cellVertical<$board['cellVertical'];$cellVertical++)
{


      echo '<tr>';

    for($cellHorizontal = 0;$cellHorizontal<$board['cellHorizontal'];$cellHorizontal++)
    {
        // Обнуляю переменую на каждой итерации

        $board['titleCell'] = '';



        if($cellVertical==0 or $cellVertical==$board['cellVertical']-1)
        {


            if($cellHorizontal ==0 or $cellHorizontal==$board['cellHorizontal']-1)
            {
              // Добавление пустых угловых клеток

                $board['colorCellBackground'] = 'class="grey"';


            }else
            {
               // Добавление клеток с буквами
                $board['titleCell'] = $leters[$cellHorizontal-1];

                $board['colorCellBackground'] = 'class="grey"';

            }

        }else
        {

            if (($cellVertical>=1 or $cellVertical==$board['cellVertical']-1) and ($cellHorizontal==0 or $cellHorizontal==$board['cellHorizontal']-1))
            {
               // Добавление клеток с цифрами

                $board['titleCell']           = $numbers[$cellVertical-1];
                $board['colorCellBackground'] = 'class="grey"';


            }else

            {
               // Добавление чернобелых клеток

                if ($board['transform']=='0') {


                    if (($cellVertical + $cellHorizontal) % 2) {
                        $board['colorCellBackground'] = 'class="whiteColor"';
                    } else {
                        $board['colorCellBackground'] = 'class="blackColor"';
                    }



                    // Добавление чернобелых клеток по горизонтали

            }elseif($board['transform']=='2'){

                    if ($board['count']) {

                        $board['colorCellBackground'] = 'class="whiteColor"';


                    } else {
                        $board['colorCellBackground'] = 'class="blackColor"';
                    }



                }else
                    {
                        // Добавление чернобелых клеток по вертикали

                        if (($board['count'] + $cellVertical +  $cellHorizontal) % 2) {


                            $board['colorCellBackground'] = 'class="whiteColor"';

                        } else{
                            $board['colorCellBackground'] = 'class="blackColor"';

                        }

                }


            }

        }
       echo "<td ".$board['colorCellBackground'].">".$board['titleCell']."</td>";
    }
    echo "</tr>";
    $board['count'] = !$board['count'];

}
            ?>

        </table>
    </div>
    </body>
</html>
