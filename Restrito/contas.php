<?php
require_once '../dao/ContaDAO.php';

$dao = new ContaDAO();

$cod = '';
$nomeBanco = '';
$numeroConta = '';
$saldoConta = '';

if (isset($_GET['cod']) && $_GET['cod'] != '' && is_numeric($_GET['cod']) && isset($_GET['nomeBanco']) && $_GET['nomeBanco'] != '' && isset($_GET['numeroConta']) && $_GET['numeroConta'] != '' && isset($_GET['saldoConta']) && $_GET['saldoConta'] != '') {
    $cod = $_GET['cod'];
    $nomeBanco = $_GET['nomeBanco'];
    $numeroConta = $_GET['numeroConta'];
    $saldoConta = $_GET['saldoConta'];
}

if (isset($_POST['btnSalvar'])) {
    $cod = $_POST['cod'];
    $nomeBanco = $_POST['nomeBanco'];
    $numeroConta = $_POST['numeroConta'];
    $saldoConta = $_POST['saldoConta'];
    $dao = new ContaDAO();

    if ($cod == '') {
        $ret = $dao->InserirConta($nomeBanco, $numeroConta, $saldoConta);
    } else {
        $ret = $dao->AlterarConta($nomeBanco, $numeroConta, $saldoConta, $cod);
    }
    $cod = '';
    $nomeBanco = '';
    $numeroConta = '';
    $saldoConta = '';
} else if (isset($_POST['btnExcluir'])) {
    $cod = $_POST['cod'];
    $ret = $dao->ExcluirConta($cod);
    $cod = '';
    $nomeBanco = '';
    $numeroConta = '';
    $saldoConta = '';
}



$contas = $dao->ConsultarContas();
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
                            <h2>Conta</h2>   
                            <h5>Gerencie suas contas aqui</h5>    
                        </div>
                    </div>
                    <hr />
                    <form method="POST" action="contas.php">
                        <input type="hidden" name="cod" value="<?= $cod ?>"/>
                        <div class="form-group">
                            <label>Nome do banco</label>
                            <input class="form-control" placeholder="Digite aqui..." name="nomeBanco" id="nomeBanco" value="<?= $nomeBanco ?>"/>
                        </div>
                        <div class="form-group">
                            <label>Número da conta</label>
                            <input class="form-control" placeholder="Digite aqui..." name="numeroConta" id="numeroConta" value="<?= $numeroConta ?>"/>
                        </div>
                        <div class="form-group">
                            <label>Saldo</label>
                            <input class="form-control" placeholder="Digite aqui..." name="saldoConta"id="saldo" value="<?= $saldoConta ?>" />
                        </div>
                        <?php if ($cod != '') { ?>
                            <button type="submit" class="btn btn-danger"name="btnExcluir">Excluir</button>
                            <button type="submit" class="btn btn-warning"name="btnCAncelar">Cancelar</button>
                        <?php } ?>
                        <button type="submit" class="btn btn-success"name="btnSalvar"onclick="return ValidarCamposConta()"> <?= $cod == '' ? 'Cadastrar' : 'Alterar' ?> </button>
                    </form>

                    <hr />

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Contas cadastradas
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Nome do banco</th>
                                            <th>Número da conta</th>
                                            <th>Saldo da conta</th>
                                            <th>Ação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        for ($i = 0; $i < count($contas); $i++) {
                                            ?>
                                            <tr class="odd gradeX">
                                                <td><?= $contas[$i]['nome_banco'] ?></td>
                                                <td><?= $contas[$i]['numero_conta'] ?></td>
                                                <td><?= $contas[$i]['saldo_conta'] ?></td>                                           
                                                <td>
                                                    <a href="contas.php?cod=<?= $contas[$i]['id_conta'] ?>&nomeBanco=<?= $contas[$i]['nome_banco'] ?>&numeroConta=<?= $contas[$i]['numero_conta'] ?>&saldoConta=<?= $contas[$i]['saldo_conta'] ?>"class="btn btn-warning btn-sm">Alterar</a>
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

