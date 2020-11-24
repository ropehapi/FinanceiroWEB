<?php

require_once 'UtilDAO.php';
require_once 'Conexao.php';

class ContaDAO extends Conexao {

    public function InserirConta($nomeBanco, $numrConta, $saldoConta) {
        if (trim($nomeBanco) == "" || trim($numrConta) == "" || trim($saldoConta) == "") {
            return 0;
        }

        $conexao = parent::retornaConexao();
        $comando = 'insert into tb_conta(nome_banco,numero_conta,saldo_conta,id_usuario) values(?,?,?,?)';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando);

        $sql->bindValue(1, $nomeBanco);
        $sql->bindValue(2, $numrConta);
        $sql->bindValue(3, $saldoConta);
        $sql->bindValue(4, UtilDAO::CodigoLogado());

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            return -1;
        }
    }

    public function ConsultarContas() {

        $conexao = parent::retornaConexao();
        $comando = 'select id_conta,nome_banco,numero_conta,saldo_conta from tb_conta where id_usuario = ?';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando);

        $sql->bindValue(1, UtilDAO::CodigoLogado());

        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        return $sql->fetchAll();
    }

    public function AlterarConta($nomeBanco, $numeroConta, $saldoConta, $cod) {
        $conexao = parent::retornaConexao();
        $comando = 'update tb_conta set nome_banco = ?,
                                      numero_conta = ?,
                                      saldo_conta = ?
                                      where id_conta = ? and id_usuario = ?';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando);
        $sql->bindValue(1, $nomeBanco);
        $sql->bindValue(2, $numeroConta);
        $sql->bindValue(3, $saldoConta);
        $sql->bindValue(4, $cod);
        $sql->bindValue(5, UtilDAO::CodigoLogado());

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            return -1;
        }
    }

    public function ExcluirConta($cod) {
        $conexao = parent::retornaConexao();
        $comando = 'delete from tb_conta where id_conta = ? and id_usuario=?';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando);
        $sql->bindValue(1, $cod);
        $sql->bindValue(2, UtilDAO::CodigoLogado());
        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            return -2;
        }
    }

}
