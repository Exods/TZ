
<div >
    <form id='addForm' class="edit_dialog remove" action="" method="GET">
        <div class="edit_dialog">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Редактирование пользователя</h5>
                <a class="del_form_a forms" type="button" onclick="closeEditDialog()">
                    <span aria-hidden="true" class="del_form_span">X</span>
                </a>
            </div>
            <div class="modal-body">
                    <div>
                        <h6>Name</h6>
                        <input type="text" name="name" required value="<?=$userList['Name']?>">

                    </div>
                    <div>
                        <h6>Department</h6>
                        <input type="text" name="department" required value="<?=$userList['Department']?>">
                    </div>
                    <div>
                        <h6>Phone</h6>
                         <input type="text" name="phone" required value="<?=$userList['Phone']?>">
                    </div>
                    <input type="hidden" name="index" value="<?=$this->user['index']?>">
                    <input type="hidden" name="cmd" value="edit">
            </div>
            <div class="modal-footer">
                <div id="blockCapch" class="g-recaptcha" data-size="normal" data-expired-callback="grecaptcha.reset()" data-badge="bottomright" data-sitekey="6LcumdQZAAAAAO-X7nagbseox5f0o-NOMySGtm-H"></div>
                <p id='capch' style="color:red;font-size: 20px;"></p>
                <br/>
                <input type="submit" class="btn-primary forms" data-cmd='edit' onclick="validate()" value="сохранить">
            </div>
        </div>
    </form>
</div>
