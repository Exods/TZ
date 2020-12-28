<?//подключение сообщений об ошибках
include 'arrError.php';
?>

<form class="edit_dialog" action="" method="GET">
    <div class="edit_dialog">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Редактирование пользователя</h5>
            <a class="del_form_a" type="button" href="<?=$homePage?>">
                <span aria-hidden="true" class="del_form_span">X</span>
            </a>
        </div>
        <div class="modal-body">
                <div>
                    <h6>Name</h6>
                    <input type="text" name="name" value="<?=$userList[$index][0]?>">
                    <p class="validation"><?=$arrError[$results['name']]?></p>
                </div>
                    <div>
                        <h6>Department</h6>
                        <input type="text" name="department" value="<?=$userList[$index][1]?>">
                        <p class="validation"><?=$arrError[$results['department']]?></p>
                </div>
                    <div>
                    <h6>Phone</h6>
                     <input type="text" name="phone" value="<?=$userList[$index][2]?>">
                     <p class="validation"><?=$arrError[$results['phone']]?></p>
                 </div>
                <input type="hidden" name="index" value="<?=$index?>">
                <input type="hidden" name="cmd" value="edit">
        </div>
        <div class="modal-footer">
            <input type="submit" class="btn-primary" value="сохранить">
        </div>
    </div>
</form>
