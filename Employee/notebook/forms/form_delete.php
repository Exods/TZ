<div class="del_form">
    <form action=""  method="GET">
        <h3 class="mb-4">Вы точно хотите удалить элемент?</h3>
        <input class="btn btn-danger" type="submit" value="удалить"></input>
        <a class="btn btn-secondary" href="<?=$homePage?>">отмена</a>
        <input type="hidden" name="cmd" value="del">
        <input type="hidden" name="index" value="<?=$index?>">
    </form>
</div>
