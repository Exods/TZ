<?php
    $editEmployee =
        
        '<form class="edit_dialog" action="" method="GET">
        <div class="edit_dialog">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Редактирование</h5>
                <a class="del_form_a" type="button" href="'.$homePage.'">
                    <span aria-hidden="true" class="del_form_span">X</span>
                </a>
            </div>
         <div class="modal-body">
                <input type="text" name="name" value="'.$CONFIG[$indexItem]['name'].'">
                <input type="text" name="department" value="'.$CONFIG[$indexItem]['department'].'">
                <input type="text" name="phone" value="'.$CONFIG[$indexItem]['phone'].'">
                <input type="hidden" name="indexItem" value="'.$indexItem.'">
                <input type="hidden" name="cmd" value="edit">
         </div>
            <div class="modal-footer">
                <input type="submit" class="btn-primary">
            </div>
            </div>
        </form>';


