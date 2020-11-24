<?php

class UtilDAO {

    private static function IniciarSessao() {
        if (!isset($_SESSION)) {
            session_start();
        }
    }

    public static function CriarSessao($codLogado, $nomeLogado) {
        self::IniciarSessao();
        $_SESSION['cod'] = $codLogado;
        $_SESSION['nome'] = $nomeLogado;
    }

    public static function CodigoLogado() {
        self::IniciarSessao();
        return $_SESSION['cod'];
    }

    public static function NomeLogado() {
        self::IniciarSessao();
        return $_SESSION['nome'];
    }

    public static function Deslogar() {
        self::IniciarSessao();

        //elimina a sessao
        unset($_SESSION['cod']);
        unset($_SESSION['nome']);

        header('location: login.php');
    }

    public static function VerificarLogado() {
        self::IniciarSessao();
        if (!isset($_SESSION['cod'])) {
            header('location: login.php');
        }
    }

}
