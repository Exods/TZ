<?//подключение сообщений об ошибках
include 'arrError.php';
?>

<div class="edit_dialog">
    <form class="edit_dialog" action="" method="GET">
        <div class="modal-header">
            <h5 class="modal-title">Добавить пользователя</h5>
            <a class="del_form_a" type="button" href="<?=$homePage?>">
                <span class="del_form_span">X</span>
            </a>
        </div>
            <div class="modal-body">
            <div><input type="text" name="name" value="<?=$user['name']?>" placeholder="Name">
            <p class="validation"><?=$arrError[$results['name']]?></p>
            </div>
            <div><input type="text" name="department" value="<?=$user['department']?>" placeholder="Department">
            <p class="validation"><?=$arrError[$results['department']]?></p>
            </div>
            <div><input type="text" name="phone" value="<?=$user['phone']?>" placeholder="Phone">
            <p class="validation"><?=$arrError[$results['phone']]?></p>
            </div>
            <input type="hidden" name="cmd" value="add">
        </div>
        <div class="modal-footer">
            <input  type="submit" class="btn-primary" value="сохранить">
        </div>
    </form>
</div>
