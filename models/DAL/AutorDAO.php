<?php
    require_once 'Conexao.php';

    class AutorDAO {
        public function getAutores() {
            $conexao = (new Conexao())->getConexao();

            $sql = "SELECT * FROM autor;";

            $stmt = $conexao->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>