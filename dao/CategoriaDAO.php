<?php

require_once'UtilDAO.php';
require_once 'Conexao.php';

class CategoriaDAO extends Conexao {

    public function InserirCategoria($nome) {
        if (trim($nome) == "") {
            return 0;
        }

        //1º Passo: criar uma variável que recebe o obj de conexão
        $conexao = parent::retornaConexao();

        //2º Passo: criar uma variável que receerá o comando SQL
        $comando = 'insert into tb_categoria(nome_categoria,id_usuario) values(?, ?)';

        //3º Passo : exemplo doidao do barco
        $sql = new PDOStatement();

        //4º Passo : o barco recebe a conexão que estará preparada para executar o comando
        $sql = $conexao->prepare($comando);

        //5º Passo : observa se tem o ? no $comando. se tiver , configurar os valores no lugar do ?
        $sql->bindValue(1, $nome);
        $sql->bindValue(2, UtilDAO::CodigoLogado());

        //6º Passo : Criar o try/catch
        try {

            //7º Passo : executa(manda pro BD)
            $sql->execute();

            //Sucesso
            return 1;
        } catch (Exception $ex) {

            //Fudeu 
            return -1;
        }
    }

    public function ConsultarCategoria() {
        $conexao = parent::retornaConexao();
        $comando = 'select 
                          id_categoria,
                          nome_categoria
                      from 
                          tb_categoria 
                     where 
                          id_usuario = ?';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando);
        $sql->bindValue(1, UtilDAO::CodigoLogado());

        //elimina o índice da coluna
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        return $sql->fetchAll();
    }

    public function AlterarCategoria($nome, $cod) {
        $conexao = parent::retornaConexao();
        $comando = 'update tb_categoria set nome_categoria = ? where id_categoria = ? and id_usuario = ?';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando);
        $sql->bindValue(1, $nome);
        $sql->bindValue(2, $cod);
        $sql->bindValue(3, UtilDAO::CodigoLogado());

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            return -1;
        }
    }

    public function DeletarCategoria($cod) {
        $conexao = parent::retornaConexao();
        $comando = 'delete from tb_categoria where id_categoria = ? and id_usuario = ?';
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
