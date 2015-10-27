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
    <title>Relatório Notas Consignado</title>

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

            <a class="navbar-brand" href="#">Relatório de notas do consignado</a>
        </div>
    </div>
</nav>

<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron">
    <div class="container">
        <h1>Bem vindo!</h1>
        <p>Nesse painel é possível exportar para excel os dados do periodo de 2014</p>

    </div>
</div>

<div class="container">
    <!-- Example row of columns -->
    <form id="exporta" name="exporta" method="post" action="exportar.php">
        <div class="row">
            <div class="col-md-4">
                <h2>Data inicial:</h2>

                <p><input class="form-control" required  type="text" id="dataa" name="data_inicial" placeholder="DD/MM/YYYY" maxlength="10"  pattern="[0-9]{2}\/[0-9]{2}\/[0-9]{4}$" min="2012-01-01" max="2014-02-18" ></p>

                <h2>Data final:</h2>
                <p><input class="form-control" required  type="text" id="datab" name="data_final" placeholder="DD/MM/YYYY" maxlength="10"  pattern="[0-9]{2}\/[0-9]{2}\/[0-9]{4}$" min="2012-01-01" max="2014-02-18" ></p>
                <button class="btn btn-primary btn-lg" type="submit">Exportar dados</button>

            </div>

        </div>
    </form>

    <hr>

    <footer>
        <p>&copy; Casa de Saúde São José - RJ </p>
    </footer>
</div> <!-- /container -->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="../../js/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->

<script src="../../js/bootstrap-datepicker.js"></script>
<script src="../../js/bootstrap-datepicker.pt-BR.min.js"></script>
<script type="text/javascript">
    $( document ).ready(function() {
        $('#dataa').datepicker({
            format: "dd/mm/yyyy",
            language: "pt-BR"
        });
        $('#datab').datepicker({
            format: "dd/mm/yyyy",
            language: "pt-BR"
        });

    });

</script>

</body>


</html>