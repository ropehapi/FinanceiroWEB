<?php
require_once '../dao/UsuarioDAO.php';

$dao = new UsuarioDAO();
$nome = '';
$email = '';
$senha = '';
$rSenha = '';

if (isset($_POST['btnRegistrar'])) {
    $nome = ($_POST['nome']);
    $email = ($_POST['email']);
    $senha = ($_POST['senha']);
    $rSenha = ($_POST['rSenha']);

    $ret = $dao->CadastrarUsuario($nome, $email, $senha, $rSenha);

    if ($ret == 1) {
        
    }
}
?>﻿
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <?php
    include_once '_head.php';
    ?>
    <body>
        <div class="container">
            <div class="row text-center  ">
                <div class="col-md-12">
                    <br /><br />
                    <h2> Financeiro Web : Cadastro</h2>

                    <h5>( Faça seu cadastro aqui )</h5>
                    <br />
                </div>
            </div>
            <div class="row">
                <?php
                include_once '_msg.php';
                ?>
                <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <strong>  Preencher os campos abaixo </strong>  
                        </div>

                        <form method="POST" action="cadastro.php">
                            <div class="panel-body">
                                <form role="form">
                                    <br/>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon"><i class="fa fa-circle-o-notch"  ></i></span>
                                        <input type="text" class="form-control" placeholder="Seu nome" name="nome" />
                                    </div>

                                    <div class="form-group input-group">
                                        <span class="input-group-addon">@</span>
                                        <input type="text" class="form-control" placeholder="Seu email" name="email" />
                                    </div>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                        <input type="password" class="form-control" placeholder="Sua senha" name="senha"  />
                                    </div>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                        <input type="password" class="form-control" placeholder="Repetir sua senha" name="rSenha" />
                                    </div>

                                    <button  class="btn btn-success " name="btnRegistrar">Cadastrar</button>
                                   
                                    <hr />
                                    Já tem um cadastro  <a href="login.php" >Clique aqui</a>
                                </form>

                        </form>
                    </div>

                </div>
            </div>


        </div>
        </div>

    </body>
</html>
