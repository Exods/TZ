<?//подключение сообщений об ошибках
include 'arrError.php';
?>

<form class="edit_dialog" action="" method="GET">
    <div class="edit_dialog">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Редактирование пользователя</h5>
            <a class="del_form_a" type="button" href="<?=$this->homePage?>">
                <span aria-hidden="true" class="del_form_span">X</span>
            </a>
        </div>
        <div class="modal-body">
                <div>
                    <h6>Name</h6>
                    <input type="text" name="name" value="<?=$userList['Name']?>">
                    <?if(in_array("name", $errorFields)):?>
                        <p class="validation"><?=$arrError["name"]?></p>
                    <?endif;?>
                </div>
                <div>
                    <h6>Department</h6>
                    <input type="text" name="department" value="<?=$userList['Department']?>">
                    <?if(in_array("department", $errorFields)):?>
                        <p class="validation"><?=$arrError["department"]?></p>
                    <?endif;?>
                </div>
                <div>
                    <h6>Phone</h6>
                     <input type="text" name="phone" value="<?=$userList['Phone']?>">
                     <?if(in_array("phone", $errorFields)):?>
                        <p class="validation"><?=$arrError["phone"]?></p>
                    <?endif;?>
                 </div>
                <input type="hidden" name="index" value="<?=$this->user['index']?>">
                <input type="hidden" name="cmd" value="edit">
        </div>
        <div class="modal-footer">
            <input type="submit" class="btn-primary" value="сохранить">
        </div>
    </div>
</form>
