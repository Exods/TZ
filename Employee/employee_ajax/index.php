<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Document</title>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">

    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="ajax.js?set=<?=time();?>"></script>

</head>
<body>

<?

include 'handler.php';

?>
<div class="form_wrapper">
            <div class="preloader">
                 <div class="spinner"></div>
                 <div class="spinner-2"></div>
            </div>
        <div class="header_form">
        <h2 class="form_title">Employee <b>Details</b></h2>
        <button class="add_button waves-effect waves-light btn btn-default btn-rounded showForm"  data-cmd='showFormAdd'>+ Add New</button>
    </div>
    <?include 'table.php';?>
</div>
</body>
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=onload&hl=ru"
    async defer>
    </script>
</html>
