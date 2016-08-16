<?php
header('Content-type: text/html; charset=utf-8');

$dbh = new PDO('mysql:host=localhost;dbname=dbname;charset=utf8', 'user', 'pwd');
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$dbh->exec("set names utf8");
$results = $dbh->query('SELECT perola, nome FROM perolas ORDER BY RAND() LIMIT 1');

foreach ( $results as $result ) {
	$perola = $result['perola'];
  $nome = $result['nome'];
}

?>
<!DOCTYPE html>
<html>
  <head>
    <title>Pérolas</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="perola,perolas,programador,programação,zuera">
    <meta name="description" content="Na minha máquina funciona">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/main.css" rel="stylesheet" media="screen">
  </head>
  <body>
  	<div class="container-fluid">
      <div class="row-fluid">
        <div class="span12 text-center" id="quotes">
        	<p><a href="http://ivanrosolen.com/perolas"><?php echo $perola; ?></a>
          <br />
          <span style="float:right;padding-right:40px;"><sub>by <?php echo $nome; ?></sub></span>
        	</p>
        </div>
      </div>
   </div>
   <div class="container-fluid">
   	<div class="row-fluid">
   		<div class="span12 text-center" id="footer">
   			<a href="#send" data-toggle="modal">Envie sua p&eacute;rola</a> | <a href="http://ivanrosolen.com">&copy; Ivan Rosolen</a>
   		</div>
   	</div>
   </div>
   <div class="modal hide fade" id="send">
    <div class="modal-header">
	    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	    <h3>Envie sua p&eacute;rola</h3>
	    </div>
	    <div class="modal-body">
	    	<div class="alert alert-success hide">
				    <strong>P&eacute;rola Arizona enviada com sucesso!</strong>
			</div>
		    <fieldset>
			    <label>Nome</label>
			    <input type="text" placeholder="Nome..." name="nome" id="nome">
			    <label>P&eacute;rola Arizona</label>
			    <textarea rows="3" class="input-xlarge" placeholder="Sua pérola na Arizona..." name="perola" id="perola"></textarea>
			</fieldset>
	    </div>
	    <div class="modal-footer">
	    	<button type="button" class="btn btn-primary" id="enviar">Enviar</button>
    	</div>
    </div>
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<script>
		$("#enviar").click(function() {
			var nome     = $('#nome').val();
			var perola = $('#perola').val();

			var posting = $.post( 'perolaAdd.php', { nome: nome, perola: perola }, function(){
				$(".alert-success").show();
				$('#nome').val(" ");
			  $('#perola').val(" ");
			});

		});
	</script>
  </body>
</html>