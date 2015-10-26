<?php
//Conexão
include_once('../../../oracle/connec.php');
?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Relatório Mapa Cirúrgico</title>

    <!-- Bootstrap -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
    <link href="../../css/datepicker.css" rel="stylesheet">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="../../js/html5shiv.min.js"></script>
    <script src="../../js/respond.min.js"></script>
    <![endif]-->



</head>
<body>


<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">

            <a class="navbar-brand" href="#">Mapa Cirúrgico</a>
        </div>
    </div>
</nav>

<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron">
    <div class="container">
        <h1>Bem vindo!</h1>
        <p>Nesse painel é possível selecionar uma data e exportar os dados do mapa cirurgico para excel</p>

    </div>
</div>

<div class="container">
    <!-- Example row of columns -->
    <form id="exporta" name="exporta" method="post" action="exportar.php">
        <div class="row">
            <div class="col-md-4">
                <h2>Data:</h2>

                <p><input class="form-control"  type="text" id="data" name="data" placeholder="DD/MM/YYYY"></p>
                <p><a class="btn btn-primary btn-lg" role="button" onclick="document.getElementById('exporta').submit(); alert('Seu download ficará disponível em instantes'); ">Exportar dados &raquo;</a></p>
            </div>

        </div>
    </form>

    <hr>

    <footer>
        <p>&copy; Casa de Saúde São José - RJ</p>
    </footer>
</div> <!-- /container -->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="../../js/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->

<script src="../../js/bootstrap-datepicker.js"></script>
<script src="../../js/bootstrap-datepicker.pt-BR.min.js"></script>
<script type="text/javascript">
    $( document ).ready(function() {
        $('#data').datepicker({
            format: "dd/m/yyyy",
            language: "pt-BR"
        });

    });

</script>

</body>


</html>