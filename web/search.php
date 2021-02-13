<?php
include_once "connectDB.php";
?>
<!--Developed by pthon-->
<!--Разработано pthon-->
<html>
<head>
    <title>Raspberry433 Search</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script type="application/javascript" src="js/bootstrap.min.js"></script>
    <script type="application/javascript" src="js/jquery-3.5.1.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<!--Modal Send-->
<div class="modal fade" id="sendModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Send</h5>
            </div>
            <div class="modal-body">
                <form id="sendForm" name="sendFormName">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Code</label>
                        <input required name="code" type="text" class="form-control" id="CodeInput" aria-describedby="emailHelp" placeholder="Code">

                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Pulselength</label>
                        <input required name="pulselength" type="text" class="form-control" id="PulseInput" placeholder="Pulselength">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Protocol</label>
                        <input required name="protocol" type="text" class="form-control" id="ProtocolInput" placeholder="Protocol">
                        <small id="emailHelp" class="form-text text-muted">Use 1 if u are not sure</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Repeat</label>
                        <input name="repeat" type="text" class="form-control" id="ProtocolInput" placeholder="Repeat">
                        <small id="emailHelp" class="form-text text-muted">Default: 10</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Length</label>
                        <input name="length" type="text" class="form-control" id="LengthInput" placeholder="Length">
                        <small id="emailHelp" class="form-text text-muted">Leave it empty if you don't know what it's for.</small>
                    </div>
                    <button type="submit" class="btn btn-success">Send</button>
                </form>
                <img src="gif/loading.gif" id="progressBar" style="display: none">
                <div id="result_form">

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeModal()">Close</button>

            </div>
        </div>
    </div>
</div>
<!--Menu-->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Raspberry433</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/">Live update</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" active href="/search.php">Search</a>
                </li>
                <li class="nav-item">
                    <button class="btn btn-info" onclick="openModal()">Send</button>
                </li>
                <li class="nav-item" id="service_status">

                </li>
            </ul>
        </div>
    </div>
</nav>

<form id="searchForm" class="col-md-1">
    <div class="form-group col-sm">
        <label for="exampleFormControlSelect1" class="col-form-label-lg">Date 1</label>
        <input type="date" name="date1">
        <input type="time" name="time1">
        <label for="exampleFormControlSelect1" class="col-form-label-lg">Date 2</label>
        <input type="date" name="date2">
        <input type="time" name="time2">
    </div>
    <button type="submit" class="btn btn-info">Search</button>
</form>

<table class="table table-hover" id="searchForm">
    <thead>
    <tr>
        <th scope="col">code</th>
        <th scope="col">pulselenght</th>
        <th scope="col">protocol</th>
        <th scope="col">date</th>
        <th scope="col">time</th>
    </tr>
    </thead>
    <tbody id="ajaxData">

    </tbody>

</table>

</body>
<footer>

</footer>

<script type="application/javascript">
$("#searchForm").submit(function () {
    $.ajax({
        url: '/search_processer.php',
        type: "POST",
        cache: false,
        data: $('#searchForm').serialize(),
        success: function (data) {
            $('#ajaxData').html(data);
        }
    });
    return false;
});

$("#sendForm").submit(function(){
    $('#progressBar').show();
    $('#result_form').html('');
    $.ajax({
        url: "/send.php", //url страницы (action_ajax_form.php)
        type:     "POST", //метод отправки
        dataType: "html", //формат данных
        data: $("#sendForm").serialize(),  // Сеарилизуем объект
        success: function(data, textStatus, xhr) { //Данные отправлены успешно
            $('#progressBar').hide();
            $('#result_form').html('OK');
        },
        error: function(data, textStatus, xhr) { // Данные не отправлены
            $('#progressBar').hide();
            $('#result_form').html('Error, idk why.');
        }
    });
    return false;
})




setInterval(function () {
    $.ajax({
        url: '/service.php',
        type: "POST",
        cache: false,
        data: null,
        success: function (data) {
        $('#service_status').html(data);
    }
    });
}, 1000);

function openModal() {
    $('#sendModal').modal('show')
}

function sendModal(code, pulse, protocol) {
    console.log("Code: " + code);
    console.log("pulse: " + pulse);
    console.log("protocol: " + protocol);

    let codeinp = document.getElementById('CodeInput');
    let pulseinp = document.getElementById('PulseInput');
    let protocolinp = document.getElementById('ProtocolInput');
    codeinp.value=code;
    pulseinp.value=pulse;
    protocolinp.value=protocol;
    $('#sendModal').modal('show');
}

function closeModal() {
    $('#sendModal').modal('hide');
}


</script>

</html>

