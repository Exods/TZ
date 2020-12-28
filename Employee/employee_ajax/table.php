
<table class="table_employee">

        <?=$editEmployee?>
        <?=$confirmWindow?>
        <?=$addEmployee?>

        <tr>
            <th>Nam</th>
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
                    <a class="cursor showForm" data-cmd='showFormEdit' index="<?=$value['id']?>"><img src="<?=$iconList['pen']; ?>"></a>
                    <a class="cursor showForm" data-cmd='showFormDel' index="<?=$value['id']?>"><img class="img_basket" src="<?=$iconList['basket']; ?>"></a>
                </td>
            </tr>
        <?endforeach; ?>
    </table>
