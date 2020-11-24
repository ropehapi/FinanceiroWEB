<?php

require_once 'UtilDAO.php';
require_once 'Conexao.php';

class EmpresaDAO extends Conexao {

    public function InserirEmpresa($nomeEmpresa, $enderecoEmpresa, $telefoneEmpresa) {
        if (trim($nomeEmpresa) == "" || trim($enderecoEmpresa) == "" || trim($telefoneEmpresa) == "") {
            return 0;
        }

        $conexao = parent::retornaConexao();
        $comando = 'insert into 
                               tb_empresa
                                         (nome_empresa,endereco_empresa,telefone_empresa,id_usuario) 
                                   values
                                         (?,?,?,?)';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando);
        $sql->bindValue(1, $nomeEmpresa);
        $sql->bindValue(2, $enderecoEmpresa);
        $sql->bindValue(3, $telefoneEmpresa);
        $sql->bindValue(4, UtilDAO::CodigoLogado());

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            return -1;
        }
    }

    public function AlterarEmpresa($nomeEmpresa, $enderecoEmpresa, $telefoneEmpresa, $cod) {
        $conexao = parent::retornaConexao();
        $comando = 'update tb_empresa set nome_empresa = ?,
                                               endereco_empresa = ?,
                                               telefone_empresa = ?
                                         where id_empresa = ?
                                           and id_usuario = ?';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando);
        $sql->bindValue(1, $nomeEmpresa);
        $sql->bindValue(2, $enderecoEmpresa);
        $sql->bindValue(3, $telefoneEmpresa);
        $sql->bindValue(4, $cod);
        $sql->bindValue(5, UtilDAO::CodigoLogado());

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            return -1;
        }
    }

    public function ConsultarEmpresas() {

        $conexao = parent::retornaConexao();
        $comando = 'select id_empresa,nome_empresa,endereco_empresa,telefone_empresa from tb_empresa where id_usuario = ?';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando);

        $sql->bindValue(1, UtilDAO::CodigoLogado());

        //Elimina o indice da coluna
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        return $sql->fetchAll();
    }

    public function DeletarEmpresa($cod) {
        $conexao = parent::retornaConexao();
        $comando = 'delete from tb_empresa where id_empresa = ? and id_usuario = ?';
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
