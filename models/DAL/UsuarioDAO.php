<?php
    require_once 'Conexao.php';

    class UsuarioDAO {
        public function getUsuarios() {
            $conexao = (new Conexao())->getConexao();

            $sql = "SELECT * FROM usuario;";

            $stmt = $conexao->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function createUsuario(UsuarioModel $usuario) {
            $conexao = (new Conexao())->getConexao();

            $sql = "INSERT INTO usuario VALUES(:id, :idTipoUsuario, :nome, :email, :senha);";

            $stmt = $conexao->prepare($sql);

            $stmt->bindValue(':id', null);
            $stmt->bindValue(':idTipoUsuario', $usuario->idTipoUsuario);
            $stmt->bindValue(':nome', $usuario->nomeUsuario);
            $stmt->bindValue(':email', $usuario->emailUsuario);
            $stmt->bindValue(':senha', $usuario->senhaUsuario);

            return $stmt->execute();
        }

        public function updateUsuario(UsuarioModel $usuario) {
            $conexao = (new Conexao())->getConexao();

            $sql = "UPDATE usuario set idTipoUsuario = :idTipoUsuario, nomeUsuario = :nome, emailUsuario = :email, senhaUsuario = :senha; WHERE idUsuario = :id";
            
            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':idTipoUsuario', $usuario->idTipoUsuario);
            $stmt->bindValue(':nome', $usuario->nomeUsuario);
            $stmt->bindValue('email', $usuario->emailUsuario);
            $stmt->bindValue('senha', $usuario->senhaUsuario);
            $stmt->bindValue('id', $usuario->idUsuario);

            return $stmt->execute();
        }

        public function deleteUsuario(UsuarioModel $usuario) {
            $conexao = (new Conexao())->getConexao();

            $sql = "DELETE FROM usuario WHERE idUsuario = :id;";

            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':id', $usuario->idUsuario);

            return $stmt->execute();
        }
    }
?>