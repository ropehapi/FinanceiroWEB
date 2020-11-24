<?php

require_once 'UtilDAO.php';
require_once 'Conexao.php';

class MovimentoDAO extends Conexao {

    public function InserirMovimento($data, $tipo, $categoria, $empresa, $conta, $valor, $obs) {
        if (trim($data) == "" || trim($tipo) == "" || trim($categoria) == "" || trim($empresa) == "" || trim($conta) == "" || trim($valor) == "") {
            return 0;
        }

        $conexao = parent::retornaConexao();
        $comando = 'insert into tb_movimento (data_movimento,tipo_movimento,obs_movimento,valor_movimento,id_categoria,id_empresa,id_conta,id_usuario)
                    values(?,?,?,?,?,?,?,?)';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando);

        $sql->bindValue(1, $data);
        $sql->bindValue(2, $tipo);
        $sql->bindValue(3, $obs);
        $sql->bindValue(4, $valor);
        $sql->bindValue(5, $categoria);
        $sql->bindValue(6, $empresa);
        $sql->bindValue(7, $conta);
        $sql->bindValue(8, UtilDAO::CodigoLogado());

        //Inicia a transação
        $conexao->beginTransaction();

        try {
            //Insere no tb_movimento
            $sql->execute();

            //Verifica Entrada
            if ($tipo == 0) {
                $comando = 'update tb_conta set saldo_conta = saldo_conta + ? where id_conta = ?';
            }
            //SENAO Saída
            else {
                $comando = 'update tb_conta set saldo_conta = saldo_conta - ? where id_conta = ?';
            }

            $sql = $conexao->prepare($comando);
            $sql->bindValue(1, $valor);
            $sql->bindValue(2, $conta);

            //Atualiza
            $sql->execute();
            //Confirma a transação
            $conexao->commit();

            return 1;
        } catch (Exception $ex) {
            return -1;
        }
    }

    public function ConsultarMovimentos($tipoPesquisar, $dtInicial, $dtFinal) {
        $conexao = parent::retornaConexao();
        $comando = 'select  id_movimento,
                            nome_categoria,
                            nome_empresa,
                            nome_banco,                            
                            data_movimento,
                            tipo_movimento,
                            obs_movimento,
                            valor_movimento,
                            tb_movimento.id_conta
                       from tb_movimento 
                       inner join tb_categoria on tb_movimento.id_categoria = tb_categoria.id_categoria
                       inner join tb_empresa on tb_movimento.id_empresa = tb_empresa.id_empresa
                       inner join tb_conta on tb_movimento.id_conta = tb_conta.id_conta
                       where tb_movimento.id_usuario = ? and tipo_movimento = ? and data_movimento between ? and ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando);
        $sql->bindValue(1, UtilDAO::CodigoLogado());
        $sql->bindValue(2, $tipoPesquisar);
        $sql->bindValue(3, $dtInicial);
        $sql->bindValue(4, $dtFinal);

        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();
        return $sql->fetchAll();
    }

    public function ExcluirMovimento($cod,$tipoMov, $conta, $valor) {
        $conexao = parent::retornaConexao();
        $comando = 'delete from tb_movimento where id_movimento = ? and id_usuario = ?';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando);
        $sql->bindValue(1, $cod);
        $sql->bindValue(2, UtilDAO::CodigoLogado());

        //iniciando a tran
        $conexao->beginTransaction();
        try {
            $sql->execute();
            if ($tipoMov == 0) {
                $comando = 'update tb_conta set saldo_conta = saldo_conta - ? where id_conta = ? and id_usuario = ?';
            } else {
                $comando = 'update tb_conta set saldo_conta = saldo_conta + ? where id_conta = ? and id_usuario = ?';
            }
            $sql = $conexao->prepare($comando);
            $sql->bindValue(1, $valor);
            $sql->bindValue(2, $conta);
            $sql->bindValue(3, UtilDAO::CodigoLogado());

            $sql->execute();
            $conexao->commit();
            return 1;
        } catch (Exception $ex) {
            return -1;
        }
    }

}

?>