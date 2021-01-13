let loader = '.preloader';
let sitekey = '6LcumdQZAAAAAO-X7nagbseox5f0o-NOMySGtm-H';
let data = {};
var errorFields = [];


$(function() {
    $(document).on('click', '.showForm', function(e) {
        e.preventDefault();
        if (errorFields.length == 0) {
            data = {
                recaptcha: $('.g-recaptcha-response').val(),
                cmd: $(this).attr('data-cmd'),
                index: $(this).attr('index') || $('[name="index"]').val(),
                name: $('[name="name"]').val(),
                department: $('[name="department"]').val(),
                phone: $('[name="phone"]').val()
            }
            loaderShow();
            setTimeout(function() {
                $.ajax({
                    method: "POST",
                    url: "handler.php",
                    cache: false,
                    data: data, // Данные, отправляемые на сервер,
                    dataType: "html", // xml, json, script (тип получаемых от сервера данных)

                }).done(successResultForm).fail(failResult);
            }, 300);
        } else {
            validate();
        }
    });


    $(document).on('submit',".remove", function(e) {
        e.preventDefault();
        if (errorFields.length == 0) {
            data = $(this).serialize();
            loaderShow();
            setTimeout(function() {
                $.ajax({
                    method: "POST",
                    url: "handler.php",
                    cache: false,
                    data: data, // Данные, отправляемые на сервер,
                    dataType: "html", // xml, json, script (тип получаемых от сервера данных)


                }).done(successResultCapch).fail(failResult);
            }, 300);
        } else {
            validate();
        }
    });

});



function beforeSendAJAX() {
    loaderShow();
}



// Данные пришли с сервера (успешно)
function successResultForm(resultHTML) {
    loaderHide();
    console.log("Ответ..." + resultHTML.length);

    if (resultHTML.match(/id='addForm'/)) {
        $('.table_employee').before(resultHTML)
    }

    setTimeout(function() {
        onloadCallback();
    }, 400);
}




function successResultCapch(resultHTML) {
    loaderHide();
    console.log("Ответ..." + resultHTML.length);

   if (resultHTML.match(/class="table_employee"/)) {
        closeEditDialog();
        $('.table_employee').html(resultHTML);
    } else {
        $('#capch').text(resultHTML);

    }

    setTimeout(function() {
        onloadCallback();
    }, 400);
}

// Обработчик Ошибок
function failResult() {
    loaderHide();
    $("#result").html('<p style="color:red;">Возникла ошибка!</p>');
}

function closeEditDialog() {

    $('.remove').fadeToggle('400', function() {
        this.remove();
    });


}

function loaderShow() {
    console.log("Запуск прелоадера...");
    $(loader).css("display", "block");
}

function loaderHide() {
    console.log("Закрытие прелоадера...");
    $(loader).css("display", "none");
}
var onloadCallback = function() {
    if ($('.edit_dialog').length) {
        grecaptcha.render('blockCapch', {
            'sitekey': sitekey
        });
    }
};

function validate() {

    $('p.validation').remove();
    errorFields = [];

    let fields = $("[required]");
    for (i = 0; i < fields.length; i++) {
        if (fields[i].value.trim().length == '') {
            $(fields[i]).after('<p class="validation">Поле обязательное для заполнения!</p>');
            errorFields.push(fields[i].name);

        }else if ($('.g-recaptcha-response').val() == "") {
            $("#blockCapch").css('border','5px solid red');
            errorFields.push(1);

        } else if (!fields[i].value.trim().length == ''&!$('.g-recaptcha-response').val() == "") {
            $('p.validation').eq(i).remove();
            $("#blockCapch").css('border','none');

        }
    }
    return;
}
