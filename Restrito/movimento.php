<?php
require_once '../dao/MovimentoDAO.php';
require_once '../dao/CategoriaDAO.php';
require_once '../dao/EmpresaDAO.php';
require_once '../dao/ContaDAO.php';
$tipoPesquisar = '';
$dtInicial = '';
$dtFinal = '';

$dao = new MovimentoDAO();
$dao_cat = new CategoriaDAO();
$dao_em = new EmpresaDAO();
$dao_co = new ContaDAO();
$emps = $dao_em->ConsultarEmpresas();
$cats = $dao_cat->ConsultarCategoria();
$cons = $dao_co->ConsultarContas();

//Limpo os campos
$cod = '';
$data = '';
$tipo = '';
$valor = '';
$categoria = '';
$empresa = '';
$conta = '';
$obs = '';
$idConta = '';


//Verifica se tem algo na url
if (
        isset($_GET['cod']) && $_GET['cod'] != '' && is_numeric($_GET['cod']) && isset($_GET['dataMovimento']) && $_GET['dataMovimento'] != '' && isset($_GET['tipoMovimento']) && $_GET['tipoMovimento'] != '' && isset($_GET['valorMovimento']) && $_GET['valorMovimento'] != '' && isset($_GET['nomeEmpresa']) && $_GET['nomeEmpresa'] != '' && isset($_GET['nomeCategoria']) && $_GET['nomeCategoria'] != '' && isset($_GET['idConta']) && $_GET['idConta'] != '') {

    $cod = ($_GET['cod']);
    $data = ($_GET['dataMovimento']);
    $tipo = ($_GET['tipoMovimento']);
    $valor = ($_GET['valorMovimento']);
    $categoria = ($_GET['nomeCategoria']);
    $empresa = ($_GET['nomeEmpresa']);
    $conta = ($_GET['idConta']);
    $obs = ($_GET['obsMovimento']);
    $idConta = ($_GET['idConta']);
}



if (isset($_POST['btnSalvar'])) {
    $data = $_POST ['data'];
    $tipo = $_POST['tipo'];
    $categoria = $_POST['categoria'];
    $empresa = $_POST['empresa'];
    $conta = $_POST['conta'];
    $valor = $_POST['valor'];
    $obs = $_POST['obs'];
    $ret = $dao->InserirMovimento($data, $tipo, $categoria, $empresa, $conta, $valor, $obs);

    $cod = '';
    $data = '';
    $tipo = '';
    $valor = '';
    $categoria = '';
    $empresa = '';
    $conta = '';
    $idConta = '';
    $obs = '';
} else if (isset($_POST['btnPesquisar'])) {
    $tipoPesquisar = $_POST['tipoPesquisar'];
    $dtInicial = $_POST['dataInicial'];
    $dtFinal = $_POST['dataFinal'];
    $movs = $dao->ConsultarMovimentos($tipoPesquisar, $dtInicial, $dtFinal);
} else if (isset($_POST['btnExcluir'])) {

    $cod = $_POST['cod'];
    $tipo = $_POST['tipo'];
    $idConta = $_POST['conta'];
    $valor = $_POST['valor'];
    $ret = $dao->ExcluirMovimento($cod, $tipo, $idConta, $valor);

    $cod = '';
    $data = '';
    $tipo = '';
    $valor = '';
    $categoria = '';
    $empresa = '';
    $conta = '';
    $idConta = '';
    $obs = '';
}
?>
﻿<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <body>
        <div id="wrapper">
            <?php
            include_once '_head.php';
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
                            <h2>Movimento</h2>   
                            <h5>Lance seus movimentos aqui</h5>    
                        </div>
                    </div>
                    <br>
                        <form method="POST" action="movimento.php">
                            <input type="hidden" name="cod" value="<?= $cod ?>" />
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Data do movimento</label>
                                    <?php if ($cod == '') { ?>
                                        <input type ="date" class="form-control" value="<?= $data ?>" placeholder="Digite aqui..." name="data" id="data" />
                                    <?php } else { ?>
                                        <input type="date" class="form-control" value="<?= $data ?>" readonly/>
                                    <?php } ?>
                                </div>


                                <div class="form-group">
                                    <label>Tipo do movimento</label>
                                    <?php if ($cod == '') { ?>
                                        <select class="form-control"name="tipo"id="tipo">
                                            <option value="">Selecione</option>
                                            <option value="0">Entrada</option>
                                            <option value="1">Saída</option>

                                        </select>
                                    <?php } else { ?>
                                        <input name="tipo" value="<?= $tipo == 0 ? 'Entrada' : 'Saída' ?>" class="form-control" readonly />
                                    <?php } ?>
                                </div>
                                <div class="form-group">
                                    <label>Categoria</label>
                                    <?php if ($cod == '') { ?>
                                        <select class="form-control"name="categoria"id="categoria">                      
                                            <option value="">Selecione</option>                                                      
                                            <?php for ($i = 0; $i < count($cats); $i++) { ?>                                        
                                                <option  value="<?= $cats[$i]['id_categoria'] ?>"><?= $cats[$i]['nome_categoria'] ?></option>                                                      
                                            <?php } ?>
                                        </select>
                                    <?php } else { ?>
                                        <input value="<?= $categoria ?>" class="form-control" readonly/>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Empresa</label>

                                    <?php if ($cod == '') { ?>

                                        <select class="form-control"name="empresa"id="empresa">
                                            <option value="">Selecione</option>     

                                            <?php for ($i = 0; $i < count($emps); $i++) { ?>
                                                <option value="<?= $emps[$i]['id_empresa'] ?>"><?= $emps[$i]['nome_empresa'] ?></option>
                                            <?php } ?>

                                        </select>

                                    <?php } else { ?>
                                        <input value="<?= $empresa ?>" class="form-control" readonly />
                                    <?php } ?>
                                </div>


                                <div class="form-group">
                                    <label>Conta</label>
                                    <?php if ($cod == '') { ?>
                                        <select class="form-control"name="conta"id="conta">                                                                      
                                            <option value="">Selecione</option>  

                                            <?php for ($i = 0; $i < count($cons); $i++) { ?>
                                                <option value="<?= $cons[$i]['id_conta'] ?>"><?= $cons[$i]['nome_banco'] ?></option>  
                                            <?php } ?>
                                        </select>
                                    <?php } else { ?>
                                        <input name="conta"value="<?= $conta ?>" class="form-control" readonly/>    
                                    <?php } ?>
                                </div>
                                <div class="form-group">
                                    <label>Valor</label>
                                    <?php if ($cod == '') { ?>
                                        <input class="form-control" placeholder="Digite aqui..." name="valor" id="valor"/>
                                    <?php } else { ?>
                                        <input name="valor" class="form-control" value="<?= $valor ?>" readonly/>
                                    <?php } ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Observação</label>
                                <?php if ($cod == '') { ?>
                                    <textarea class="form-control" rows="3"name="obs"id="obs"></textarea>
                                <?php } else { ?>
                                    <input class="form-control" value="<?= $obs ?>" readonly/>
                                <?php } ?>
                            </div>

                            <center>
                                <?php if ($cod != '') { ?>
                                    <button type="submit" class="btn btn-danger"name="btnExcluir">Excluir</button>
                                    <button type="submit" class="btn btn-warning"name="btnCancelar">Cancelar</button>
                                <?php } ?>
                                <button type="submit" class="btn btn-success"onclick="return ValidarCamposMovimento()" name="btnSalvar">Gravar</button>
                            </center>
                        </form>

                        <hr />
                        <form method="post" action="movimento.php">
                            <div class="form-group">
                                <label>Tipo do movimento</label>
                                <select class="form-control"name="tipoPesquisar" id="tipoPesquisar">
                                    <option value="">Selecione</option>
                                    <option value="0" <?= $tipoPesquisar == '0' ? 'selected' : '' ?> >Entrada</option>
                                    <option value="1"  <?= $tipoPesquisar == '1' ? 'selected' : '' ?> >Saída</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Data inicial</label>
                                    <input type ="date" class="form-control" placeholder="Digite aqui..." name="dataInicial"id="dataInicial" value="<?= $dtInicial ?>" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Data final</label>
                                    <input type="date" class="form-control" placeholder="Digite aqui..." name="dataFinal"id="dataFinal" value="<?= $dtFinal ?>" />
                                </div>
                            </div> 

                            <center>
                                <button type="submit" name="btnPesquisar" class="btn btn-info"onclick="return ValidarCamposFiltrar()">Pesquisar</button>
                            </center>
                        </form>



                        <?php if (isset($movs)) { ?>

                            <br/>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Movimentos encontrados
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>Data</th>                                                  
                                                    <th>Valor</th>
                                                    <th>Empresa</th>
                                                    <th>Categoria</th>
                                                    <th>Conta</th>
                                                    <th>Obs</th>
                                                    <th>Ação</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                for ($i = 0; $i < count($movs); $i++) {

                                                    $parametro = 'cod=' . $movs[$i]['id_movimento'] .
                                                            '&dataMovimento=' . $movs[$i]['data_movimento'] .
                                                            '&tipoMovimento=' . $movs[$i]['tipo_movimento'] .
                                                            '&valorMovimento=' . $movs[$i]['valor_movimento'] .
                                                            '&nomeEmpresa=' . $movs[$i]['nome_empresa'] .
                                                            '&nomeCategoria=' . $movs[$i]['nome_categoria'] .
                                                            '&idConta=' . $movs[$i]['id_conta'] .
                                                            '&obsMovimento=' . $movs[$i]['obs_movimento'];
                                                    ?>
                                                    <tr class="odd gradeX">
                                                        <td><?= $movs[$i]['data_movimento'] ?></td>                                                   
                                                        <td><?= $movs[$i]['valor_movimento'] ?></td>                                           
                                                        <td><?= $movs[$i]['nome_empresa'] ?></td>
                                                        <td><?= $movs[$i]['nome_categoria'] ?></td>
                                                        <td><?= $movs[$i]['nome_banco'] ?></td>
                                                        <td><?= $movs[$i]['obs_movimento'] ?></td>
                                                        <td>
                                                            <a href="movimento.php?<?= $parametro ?>" class="btn btn-danger btn-sm" >Excluir</a>
                                                        </td>
                                                    <?php } ?>                                
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        <?php } ?>
                </div>

                <!-- /. PAGE INNER  -->
            </div>
            <!-- /. PAGE WRAPPER  -->
        </div>

    </body>
</html>

