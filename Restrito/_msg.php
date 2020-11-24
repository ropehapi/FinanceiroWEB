<?php
if (isset($ret)) {
    switch ($ret) {
        case -4:
            echo'<div class="alert alert-danger">
                Usuario não encontrado!
                </div>';
            break;
        case -3:
            echo'<div class="alert alert-danger">
                As senhas não coincidem!
                </div>';
            break;
        case -2:
            echo'<div class="alert alert-danger">
            Não foi possível excluir o registro pois está sendo utilizado!
            </div>';
            break;
        case -1:
            echo'<div class="alert alert-danger">
            Ocorreu um erro na operação, tente novamente mais tarde!
            </div>';
            break;
        case 0:
            echo '<div class="alert alert-warning">
            Por favor , preencha o(s) campo(s) obrigatório(s)
           </div>';
            break;
        case 1:
            echo'<div class="alert alert-success">
                    Ação realizada com sucesso
                  </div>';
            break;
    }
}




  
