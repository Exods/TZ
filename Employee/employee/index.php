<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php


    $name=$_REQUEST['name'];
    $department=$_REQUEST['department'];
    $phone=$_REQUEST['phone'];

    $cmd=$_REQUEST['cmd'];//add-добавление del-удаление edit-редактирование
    $indexItem=$_REQUEST['indexItem'];//номер строки для удаления или редактирования


    include 'config_setup.php';//формирование списка сотрудников согласно data.csv




        if ($cmd=='del') { //удаление строки

                include 'forms/form_delete.php';//форма подверждения удаления
                $num = $indexItem;//номер строки в csv
                if (isset($_REQUEST['delConfirm']) == 1) {//подверждение удаления


                    $confirmWindow = '';

                    $row = 1;
                    $handle = fopen("data.csv", "r");//открываем файл

                    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                        $dataMain[] = $data;//кладу в массив
                    }
                    fclose($handle);//закрываю файл
                    unset($dataMain[$num]);//удалем элемент

                    $fp = fopen('data.csv', 'w');
                    foreach ($dataMain as $iter) {
                        fputcsv($fp, $iter);
                    }
                    fclose($fp);
                }



        }

        if ($cmd=='add') {//добавление данных

            include 'forms/form_add.php';//форма добавления

            $modalData = $_REQUEST;
            array_pop($modalData);
            if ($name and $department and $phone) { //проверка на пустые строки
                $addDataFile = fopen('data.csv', 'a');
                fputcsv($addDataFile, $modalData);
                fclose('data.csv');
                $addEmployee = '';
            }

        }


        if ($name or $department or $phone) {//отлавливаю редактирование

            $editEmployee = '';

            $num = $indexItem;//номер строки в csv
            $row = 1;
            $handle = fopen("data.csv", "r");//открываем файл

            while (($data = fgetcsv($handle, 1000, ",")) !== false) {
                $dataMain[] = $data;//кладём в массив
            }

            fclose($handle);//закрываю файл

            for ($i = 0; $i < count($dataMain[$indexItem]); $i++) {//заполняем массив новыми данными
                $dataMain[$indexItem][$i] = array_values($_REQUEST)[$i];
            }

            $fp = fopen('data.csv', 'w');
            foreach ($dataMain as $iter) {
                fputcsv($fp, $iter);
            }
            fclose($fp);

        }



        if ($cmd=='edit') {//редактирование данных
            $editEmployeeIndex = $indexItem;
            include 'forms/form_edit.php';
            if ($name) {
                $editEmployee = '';
            }

        }
        include 'config_setup.php';


     //массив иконок
    $iconList    = [
        'pen'    => 'img/pen.jpg',
        'basket' => 'img/basket.jpg'
    ];

?>
            <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
            <link rel="stylesheet" type="text/css" href="style.css">

                    <div class="form_wrapper">
                        <div class="header_form">
                            <h2 class="form_title">Employee <b>Details</b></h2>
                            <a class="add_button waves-effect waves-light btn btn-default btn-rounded" href="<?=$homePage?>?cmd=add">+ Add New</a>
                            </div>
                         <table class="table_employee">
                            <?=$editEmployee;?>
                            <?=$confirmWindow;?>
                             <?=$addEmployee?>
                            <tr>
                                <th>Name</th>
                                <th>Department</th>
                                <th>Phone</th>
                                <th>Actions</th>
                            </tr>
                            <?
                            foreach ($CONFIG as $employee => $value):?>
                            <tr>
                                <td><?=$value['name']?></td>
                                <td><?=$value['department']?></td>
                                <td><?=$value['phone']?></td>
                                <td>
                                      <a href="<?=$homePage?>?cmd=edit&indexItem=<?=$employee?>"><img src="<?=$iconList['pen'];?>"></a>
                                      <a href="<?=$homePage?>?cmd=del&indexItem=<?=$employee?>"><img class="img_basket" src="<?=$iconList['basket'];?>"></a>
                                </td>
                            </tr>
                            <?endforeach;?>
                        </table>
                    </div>
