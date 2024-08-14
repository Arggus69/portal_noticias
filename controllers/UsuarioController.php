<?php
    require_once './models/UsuarioModel.php';

    class UsuarioController {
        public function getUsuarios() {
            $usuarioModel =  new UsuarioModel();

            $usuarios = $usuarioModel->getUsuarios();

            return json_encode([
                'error' => null,
                'result' => $usuarios
            ]);
        }

        public function createUsuario() {
            $dados = json_decode(file_get_contents("php://input"), true);

            if (empty($dados['idTipoUsuario']))
                return $this->showError('Você deve informar o ID do Tipo do Usuario');

            if (empty($dados['nomeUsuario']))
                return $this->showError('Você deve informar o Nome do Usuario');
        
            if (empty($dados['emailUsuario']))
                return $this->showError('Você deve informar o Email do Usuario');

            if (empty($dados['senhaUsuario']))
                return $this->showError('Você deve informar o Senha do Usuario');

            $usuario = new UsuarioModel(
                null,
                $dados['idTipoUsuario'],
                $dados['nomeUsuario'],
                $dados['emailUsuario'],
                $dados['senhaUsuario']
            );

            $response = $usuario->create();

            return json_encode([
                'error' => null,
                'result' => $response
            ]);
        }

        public function updateUsuario() {
            $dados = json_decode(file_get_contents("php://input"), true);

            if (empty($dados['idUsuario']))
                return $this->showError('Você deve informar o ID do Usuario');

            if (empty($dados['idTipoUsuario']))
                return $this->showError('Você deve informar o ID do Tipo do Usuario');

            if (empty($dados['nomeUsuario']))
                return $this->showError('Você deve informar o Nome do Usuario');
        
            if (empty($dados['emailUsuario']))
                return $this->showError('Você deve informar o Email do Usuario');

            if (empty($dados['senhaUsuario']))
                return $this->showError('Você deve informar o Senha do Usuario');

            $usuario = new UsuarioModel(
                $dados['idUsuario'],
                $dados['idTipoUsuario'],
                $dados['nomeUsuario'],
                $dados['emailUsuario'],
                $dados['senhaUsuario']
            );

            $response = $usuario->update();

            return json_encode([
                'error' => null,
                'result' => $response
            ]);
        }

        public function deleteUsuario() {
            $dados = json_decode(file_get_contents("php://input"), true);

            if (empty($dados['idUsuario']))
                return $this->showError('Você deve informar o ID do Usuario');

            $usuario = new UsuarioModel($dados['idUsuario']);
            
            $response = $usuario->delete();

            return json_encode([
                'error' => null,
                'result' => $response
            ]);
        }

        private function showError(string $msg) {
            return json_encode([
                'error' => $msg,
                'result' => null
            ]);
        }
    }
?>  