<?php

require_once 'UtilDAO.php';
require_once 'Conexao.php';

class UsuarioDAO extends Conexao {

    public function CadastrarUsuario($nome, $email, $senha, $rSenha) {

        if (trim($nome) == '' || trim($email) == '' || trim($senha) == '' || trim($rSenha) == '') {
            return 0;
        }

        if (trim($senha) != trim($rSenha)) {
            return -3;
        }

        $conexao = parent::retornaConexao();
        $comando = 'insert into tb_usuario (nome_usuario , email_usuario , senha_usuario) values (?,?,?)';
        $sql = new PDOStatement();

        $sql = $conexao->prepare($comando);
        $sql->bindValue(1, $nome);
        $sql->bindValue(2, $email);
        $sql->bindValue(3, $senha);

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            return -1;
        }
    }

    public function AlterarDados($nome, $email) {
        if (trim($nome) == '' || trim($email) == '') {
            return 0;
        }

        $conexao = parent::retornaConexao();
        $comando = 'update tb_usuario set nome_usuario = ? , email_usuario = ? where id_usuario = ?';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando);

        $sql->bindValue(1, $nome);
        $sql->bindValue(2, $email);
        $sql->bindValue(3, UtilDAO::CodigoLogado());

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            return -1;
        }
    }
    
    public function ConsultarDados(){
        $conexao = parent::retornaConexao();
        $comando = 'select nome_usuario , email_usuario from tb_usuario where id_usuario = ?';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando);
        
        $sql->bindValue(1, UtilDAO::CodigoLogado());
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();
        return $sql->fetchAll();
        
    }
    
    public function ValidarLogin($email,$senha){
        if(trim($email)==''|| trim($senha)==''){
            return 0;
        }
        
        $conexao = parent::retornaConexao();
        $comando = 'select id_usuario , nome_usuario from tb_usuario where email_usuario = ? and senha_usuario = ?';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando);
        
        $sql->bindValue(1, $email);
        $sql->bindValue(2, $senha);
        
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();
        
        $usuario = $sql->fetchAll();
        
        if(count($usuario)>0){
            $codLogado = $usuario[0]['id_usuario'];
            $nomeLogado = $usuario[0]['nome_usuario'];
            
            UtilDAO::CriarSessao($codLogado, $nomeLogado);
            header('location: meus_dados.php');
            exit();
        }else{
            return -4;
        }
    }

}
