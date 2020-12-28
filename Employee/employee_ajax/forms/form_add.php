

<div>
    <form id='addForm' class="edit_dialog remove" action="" method="GET">
        <div class="modal-header">
            <h5 class="modal-title">Добавить пользователя</h5>
            <a class="del_form_a"   onclick="closeEditDialog()">
                <span class="del_form_span">X</span>
            </a>
        </div>
            <div class="modal-body">
            <div><input type="text" name="name" value="<?=$this->user['name']?>" required placeholder="Name" >
            </div>
            <div><input type="text" name="department" value="<?=$this->user['department']?>" required placeholder="Department">
            </div>
            <div><input type="text" name="phone" value="<?=$this->user['phone']?>" required placeholder="Phone">
            </div>
            <input type="hidden" name="cmd" value="add">
        </div>
        <div class="modal-footer">
            <div id="blockCapch" class="g-recaptcha" data-size="normal" data-expired-callback="grecaptcha.reset()"  data-badge="bottomright" data-sitekey="6LcumdQZAAAAAO-X7nagbseox5f0o-NOMySGtm-H">
          </div>
           <p id='capch' style="color:red;font-size: 20px;"></p>
            <br/>
            <input  type="submit" class="btn-primary forms" data-cmd='add' onclick="validate()" value="сохранить">
        </div>
    </form>
</div>

