<?php
require_once '../dao/UsuarioDAO.php';

$dao = new UsuarioDAO();
$nome = '';
$email = '';

if (isset($_POST['btnAlterar'])) {
    $nome = ($_POST['nome']);
    $email = ($_POST['email']);

    $ret = $dao->AlterarDados($nome, $email);
}

$dados = $dao->ConsultarDados();
?>
<html xmlns="http://www.w3.org/1999/xhtml">
    <?php include_once '_head.php';
    ?>
    <body
        <div id="wrapper">
                <?php
                include_once '_topo.php';
                include_once '_menu.php';               
                ?>
            <div id="page-wrapper" >
                <div id="page-inner">
                    <div class="row">
                        <div class="col-md-12">  
                            <?php
                            include_once '_msg.php';
                            ?>
                            <h2>Meus Dados</h2>   
                            <h5>Gerencie suas informações aqui</h5>    
                        </div>
                    </div>
                    <hr />
                    <form method="POST" action="meus_dados.php">                        
                        <div class="form-group">
                            <label>Nome</label>
                            <input class="form-control" placeholder="Digite aqui..." name="nome" value="<?= $dados[0]['nome_usuario'] ?>" />
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" placeholder="Digite aqui..." name="email" value="<?= $dados[0]['email_usuario'] ?>" />
                        </div>                                                                
                        <button type="submit" class="btn btn-success"name="btnAlterar">Alterar</button>
                    </form>
                    <hr />
                </div>
                <!-- /. PAGE INNER  -->
            </div>
            <!-- /. PAGE WRAPPER  -->
        </div>



    </body>
</html>