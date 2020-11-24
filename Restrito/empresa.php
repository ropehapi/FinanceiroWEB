<?php
require_once '../dao/EmpresaDAO.php';

$dao = new EmpresaDAO();
$cod = '';
$nomeEmpresa = '';
$enderecoEmpresa = '';
$telefoneEmpresa = '';

//verifica se tem algo na URL
if (isset($_GET['cod']) && $_GET['cod'] != '' && is_numeric($_GET['cod'])
             && isset($_GET['nomeEmpresa']) && $_GET['nomeEmpresa'] != ''
             && isset($_GET['enderecoEmpresa'])&& $_GET['enderecoEmpresa']!=''
             && isset($_GET['telefoneEmpresa'])&& $_GET['telefoneEmpresa']!=''){

    $cod = $_GET['cod'];
    $nomeEmpresa = $_GET['nomeEmpresa'];
    $enderecoEmpresa = $_GET['enderecoEmpresa'];
    $telefoneEmpresa = $_GET['telefoneEmpresa'];
}


//verifica se existe dentro do POAT o nome do button de ação
if (isset($_POST['btnRegistrar'])) {
    $cod = $_POST['cod'];
    $nomeEmpresa = $_POST['nomeEmpresa'];
    $enderecoEmpresa = $_POST['enderecoEmpresa'];
    $telefoneEmpresa = $_POST['telefoneEmpresa'];
    $dao = new EmpresaDAO();

    if ($cod == "") {
        $ret = $dao->InserirEmpresa($nomeEmpresa, $enderecoEmpresa, $telefoneEmpresa);
    } else {
        $ret = $dao->AlterarEmpresa($nomeEmpresa, $enderecoEmpresa, $telefoneEmpresa, $cod);
    }
    $cod = '';
    $nomeEmpresa = '';
    $enderecoEmpresa = '';
    $telefoneEmpresa = '';
    
} else if (isset($_POST['btnExcluir'])) {
    $cod = $_POST['cod'];
    $ret = $dao->DeletarEmpresa($cod);
    
    $nomeEmpresa = '';
    $enderecoEmpresa = '';
    $telefoneEmpresa = '';
}

$empresas = $dao->ConsultarEmpresas();
?>



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
                            <h2>Empresa</h2>   
                            <h5>Gerencie suas empresas aqui</h5>    
                        </div>
                    </div>
                    <hr />
                    <form method="POST" action="empresa.php">

                        <input type="hidden" name="cod" value="<?= $cod ?>"/>
                        <div class="form-group">
                            <label>Nome da empresa</label>
                            <input class="form-control" placeholder="Digite aqui..." name="nomeEmpresa" id="nomeEmpresa" value="<?= $nomeEmpresa ?>" />
                        </div>
                        <div class="form-group">
                            <label>Endereço</label>
                            <input class="form-control" placeholder="Digite aqui..." name="enderecoEmpresa"id="endereco" value="<?= $enderecoEmpresa ?>" />
                        </div>
                        <div class="form-group">
                            <label>Telefone</label>
                            <input class="form-control" placeholder="Digite aqui..." name="telefoneEmpresa" id="telefone" value="<?= $telefoneEmpresa ?>"/>
                        </div>
                        <?php if ($cod != "") { ?>
                            <button type="submit" class="btn btn-danger" name="btnExcluir">Excluir</button>
                            <button type="submit" class="btn btn-warning" name="btnCancelar">Cancelar</button>
                        <?php } ?>
                        <button type="submit" class="btn btn-success" name="btnRegistrar" onclick=" return ValidarCamposEmpresa()"> <?= $cod == '' ? 'Cadastrar' : 'Alterar' ?> </button>
                    </form>
                    <hr />

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Empresas cadastradas
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Nome da categoria</th>
                                            <th>Endereço</th>
                                            <th>Telefone</th>
                                            <th>Ação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        for ($i = 0; $i < count($empresas); $i++) {
                                            ?>

                                            <tr class = "odd gradeX">
                                                <td><?= $empresas[$i]['nome_empresa'] ?></td>
                                                <td><?= $empresas[$i]['endereco_empresa'] ?></td>
                                                <td><?= $empresas[$i]['telefone_empresa'] ?></td>                                           
                                                <td>
                                                    <a href="empresa.php?cod=<?= $empresas[$i]['id_empresa']?>&nomeEmpresa=<?=$empresas[$i]['nome_empresa']?>&enderecoEmpresa=<?= $empresas[$i]['endereco_empresa']?>&telefoneEmpresa=<?=$empresas[$i]['telefone_empresa']?>"class="btn btn-warning btn-sm">Alterar</a>
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

    </body>
</html>

