<?//подключение сообщений об ошибках
include 'arrError.php';
?>

<div class="edit_dialog">
    <form class="edit_dialog" action="" method="GET">
        <div class="modal-header">
            <h5 class="modal-title">Добавить пользователя</h5>
            <a class="del_form_a" type="button" href="<?=$this->homePage?>">
                <span class="del_form_span">X</span>
            </a>
        </div>
            <div class="modal-body">
            <div><input type="text" name="name" value="<?=$this->user['name']?>" placeholder="Name">
            <?if(in_array("name", $errorFields)):?>
            	<p class="validation"><?=$arrError["name"]?></p>
            <?endif;?>
            </div>
            <div><input type="text" name="department" value="<?=$this->user['department']?>" placeholder="Department">
            <?if(in_array("department", $errorFields)):?>
            	<p class="validation"><?=$arrError["department"]?></p>
            <?endif;?>
            </div>
            <div><input type="text" name="phone" value="<?=$this->user['phone']?>" placeholder="Phone">
            <?if(in_array("phone", $errorFields)):?>
            	<p class="validation"><?=$arrError["phone"]?></p>
            <?endif;?>
            </div>
            <input type="hidden" name="cmd" value="add">
        </div>
        <div class="modal-footer">
            <input  type="submit" class="btn-primary" value="сохранить">
        </div>
    </form>
</div>
