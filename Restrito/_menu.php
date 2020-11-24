<?php
require_once '../dao/UtilDAO.php';

if(isset($_GET['close'])&& $_GET['close']=='1'){
    UtilDAO::Deslogar();
}
?>
<nav class="navbar-default navbar-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">
            
            <li  >
                <a href="meus_dados.php"><i class="fa fa-user fa-3x"></i> Meus Dados </a>
            </li>

            <li>
                <a  href="categoria.php"><i class="fa fa-edit fa-3x"></i> Categorias</a>
            </li>
            <li>
                <a  href="empresa.php"><i class="fa fa-edit fa-3x"></i> Empresas</a>
            </li>
            <li  >
                <a  href="contas.php"><i class="fa fa-edit fa-3x"></i> Contas</a>
            </li>	
            <li  >
                <a  href="movimento.php"><i class="fa fa-money fa-3x"></i> Movimentos</a>
            </li>

            <li  >
                <a href="_menu.php?close=1"><i class="fa fa-power-off"></i> Sair</a>
            </li>	
        </ul>

    </div>

</nav>