<?php
require_once '../dao/UsuarioDAO.php';

if (isset($_POST['btnAcessar'])) {
    $email = ($_POST['email']);
    $senha = ($_POST['senha']);

    $dao = new UsuarioDAO();
    $ret = $dao->ValidarLogin($email, $senha);
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <?php
    include_once '_head.php';
    ?>
    <body>
        <div class="container">
            <div class="row text-center ">
                <div class="col-md-12">
                    <br /><br />

                    <?php
                    include_once './_msg.php';
                    ?>
                    <h2> Financeiro Web</h2>

                    <h5>( Faça seu login )</h5>
                    <br />
                </div>
            </div>
            <div class="row ">

                <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <strong>   Insira seus dados para logar </strong>  
                        </div>
                        <div class="panel-body">
                            <form action="login.php" method="post">
                                <br />
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
                                    <input type="text" class="form-control" name="email"placeholder="Seu e-mail " />
                                </div>
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                    <input type="password" class="form-control" name="senha" placeholder="Sua senha" />
                                </div>


                                <button class="btn btn-primary "name="btnAcessar">Acessar </button>
                                <hr />
                                Não tem um cadastro ? <a href="cadastro.php" >CLIQUE AQUI </a> 
                            </form>
                        </div>

                    </div>
                </div>


            </div>
        </div>

    </body>
</html>
