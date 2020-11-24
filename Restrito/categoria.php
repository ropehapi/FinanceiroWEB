<?php
require_once '../dao/CategoriaDAO.php';

$dao = new CategoriaDAO();
$cod = '';
$nome = '';

//Verifica se tem algo na URL
if (
        isset($_GET['cod']) && $_GET['cod'] != '' && is_numeric($_GET['cod']) &&
        isset($_GET['nome']) && $_GET['nome'] != ''
) {
    $cod = $_GET['cod'];
    $nome = $_GET['nome'];
}


//echo'<pre>';
//print_r($categorias);
//echo'</pre>';
//Verifica se exciste dentro do POAT o nome do BUTTON de ação
if (isset($_POST['btnGravar'])) {
    $cod = $_POST['cod'];
    $nome = $_POST['nome'];

    if ($cod == '') {
        $ret = $dao->InserirCategoria($nome);
    } else {
        $ret = $dao->AlterarCategoria($nome, $cod);
    }
    $cod = '';
    $nome = '';
} else if (isset($_POST['btnExcluir'])) {
    $cod = $_POST['cod'];
    $ret = $dao->DeletarCategoria($cod);
    $cod = '';
    $nome = '';
}

$categorias = $dao->ConsultarCategoria();
?>﻿
  

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
    <?php
    include_once '_head.php';
    ?>
    <body>
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

                            <h2>Categoria</h2>   
                            <h5>Gerencie suas categorias aqui</h5>    
                        </div>
                    </div>
                    <hr />
                    <form method="post"action="categoria.php">
                        <input type="hidden" name="cod" value="<?= $cod ?>" />
                        <div class="form-group">
                            <label>Nome da categoria</label>
                            <input class="form-control" placeholder="Digite aqui..." name="nome"id="nome" value="<?= $nome ?>" />
                        </div>
                        <?php if ($cod != '') { ?>
                            <button type="submit" class="btn btn-danger"name="btnExcluir">Excluir</button>
                            <button type="submit" class="btn btn-warning"name="btnCancelar">Cancelar</button>
                        <?php } ?>
                        <button type="submit" class="btn btn-success"name="btnGravar"onclick="return ValidarCamposCategoria()"><?= $cod == '' ? 'Cadastrar' : 'Alterar' ?></button>

                    </form>
                    <hr />

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Categorias cadastradas
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Nome da categoria</th>
                                            <th>Ação</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php for ($i = 0; $i < count($categorias); $i++) { ?>

                                            <tr class="odd gradeX">
                                                <td> <?= $categorias[$i]['nome_categoria'] ?> </td>
                                                <td>
                                                    <a href="categoria.php?cod=<?= $categorias[$i]['id_categoria'] ?>&nome=<?= $categorias[$i]['nome_categoria'] ?>"class="btn btn-warning btn-sm">Alterar</a>
                                                </td>                                          
                                            </tr>

                                        <?php } ?>

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- /. PAGE INNER  -->
            </div>
            <!-- /. PAGE WRAPPER  -->
        </div>
        <!-- /. WRAPPER  -->
        <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
        <!-- JQUERY SCRIPTS -->
        <script src="assets/js/jquery-1.10.2.js"></script>
        <!-- BOOTSTRAP SCRIPTS -->
        <script src="assets/js/bootstrap.min.js"></script>
        <!-- METISMENU SCRIPTS -->
        <script src="assets/js/jquery.metisMenu.js"></script>
        <!-- CUSTOM SCRIPTS -->
        <script src="assets/js/custom.js"></script>


    </body>
</html>
