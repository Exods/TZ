<div>
    <form id='addForm' class="del_form remove" action=""  method="GET">
        <h3 class="mb-4">Вы точно хотите удалить элемент?</h3>
        <input class="btn btn-danger forms" type="submit" data-cmd='del' onclick="closeEditDialog()" value="удалить"></input>
        <a class="btn btn-secondary" type="button" onclick="closeEditDialog()">отмена</a>
        <input type="hidden" name="cmd" value="del">
        <input type="hidden" name="index" value="<?=$this->user['index']?>">
    </form>
</div>
