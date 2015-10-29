<?php
//Conexão
include_once('../../../oracle/connec.php');
include_once('buscaProcedimentos.php');
echo json_encode($arrProcedimentos);
?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Relatório - Conferência lançamentos</title>

    <!-- Bootstrap -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
    <link href="../../css/datepicker.css" rel="stylesheet">
    <link href="../../css/jquery-ui.css" rel="stylesheet">


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

            <a class="navbar-brand" href="#">Conferência de lançamentos</a>
        </div>
    </div>
</nav>

<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron">
    <div class="container">
        <h1>Bem vindo!</h1>
        <p>Nesse painel é possível  exportar os dados da conferência de lançamentos </p>

    </div>
</div>

<div class="container">
    <!-- Example row of columns -->
    <form id="exporta" name="exporta" method="post" action="exportar.php">
        <div class="row">

            <div class="col-md-4">

                <h4>Atendimento:</h4>
                <p><input class="form-control"  type="text" id="atendimento" name="atendimento" required  pattern="[0-9]+$"></p>

                <h4>Conta:</h4>
                <p><input class="form-control"  type="text" id="conta"  name="conta" required  pattern="[0-9]$" ></p>



                <h4>Convênio:</h4>
                <p>
                    <select class="form-control" name="convenio">
                        <option value="1">Convênio 1</option>
                        <option value="2">Convênio 2</option>
                    </select>
                </p>

                <h4>Grupo de procedimento:</h4>
                <p>
                    <select class="form-control" name="gprocedimento">
                        <option value="1">Convênio 1</option>
                        <option value="2">Convênio 2</option>
                    </select>
                </p>

                <h4>Procedimento:</h4>
                <p>
                    <input class="form-control" type="text" name="procedimento" id="procedimento">
                </p>
                <button class="btn btn-primary btn-lg" type="submit">Exportar dados</button>
            </div>
            <div class="col-md-4">
                <h4>Setor:</h4>
                <p>
                    <select class="form-control" name="setor" id="setor">
                        <option value="1">Setor 1</option>
                        <option value="2">Setor 2</option>
                    </select>
                </p>

                <h4>Competência:</h4>
                <p><input class="form-control"  type="text" id="competencia" name="competencia" placeholder="MM/YYYY" required maxlength="6"  pattern="[0-9]{2}\/[0-9]{4}$"></p>




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
<script src="../../js/jquery-ui.js"></script>


<script src="../../js/bootstrap-datepicker.js"></script>
<script src="../../js/bootstrap-datepicker.pt-BR.min.js"></script>
<script type="text/javascript">
    $( document ).ready(function() {
        $('#competencia').datepicker({
            format: "mm/yyyy",
            language: "pt-BR"
        });

        $(function() {
            //var availableTags = [ "teste1", "teste2" ];
            $( "#procedimento" ).autocomplete({
                source: function(request, response){
                    $.ajax({
                        url: 'buscaProcedimentos.php',
                        type: 'get',
                        dataType: 'html',
                        data: {
                            'busca': request.term
                        }
                    }).then(function(data){
                        if(data.length > 0){
                            data = data.split(',');
                            response( $.each(data, function(key, item){
                                return({
                                    label: item
                                });
                            }));
                        }
                    });
                }
            });
        });

    });







</script>


</body>


</html>
