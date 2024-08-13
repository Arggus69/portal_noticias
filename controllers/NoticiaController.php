<?php
    require_once './models/NoticiaModel.php';

    class NoticiaController {
        public function getNoticias() {
            $noticiaModel = new NoticiaModel();

            $response = $noticiaModel->getNoticias();

            return json_encode([
                'error' => null,
                'result' => $response
            ]);
        }

        public function createNoticia() {
            $dados = json_decode(file_get_contents("php://input"), true);

            if (empty($dados['idAutor']))
                return $this->showError('Você deve informar o ID do Autor');
        
            if (empty($dados['tituloNoticia']))
                return $this->showError('Você deve informar o Titulo da Noticia');

            if (empty($dados['conteudoNoticia']))
                return $this->showError('Você deve informar o Conteudo da Noticia');

            $noticia = new NoticiaModel(
                null,
                $dados['idAutor'],
                $dados['tituloNoticia'],
                $dados['conteudoNoticia'],
                $dados['imagemNoticia']
            );

            $response = $noticia->create();

            return json_encode([
                'error' => null,
                'result' => $response
            ]);
        }

        public function updateNoticia() {
            $dados = json_decode(file_get_contents("php://input"), true);

            if (empty($dados['idNoticia']))
                return $this->showError('Você deve informar o ID da Noticia');

            if (empty($dados['idAutor']))
                return $this->showError('Você deve informar o ID do Autor');
        
            if (empty($dados['tituloNoticia']))
                return $this->showError('Você deve informar o Titulo da Noticia');

            if (empty($dados['conteudoNoticia']))
                return $this->showError('Você deve informar o Conteudo da Noticia');

            $noticia = new NoticiaModel(
                $dados['idNoticia'],
                $dados['idAutor'],
                $dados['tituloNoticia'],
                $dados['conteudoNoticia'],
                $dados['imagemNoticia']
            );

            $response = $noticia->update();

            return json_encode([
                'error' => null,
                'result' => $response
            ]);
        }

        public function deleteNoticia() {
            $dados = json_decode(file_get_contents("php://input"), true);

            if (empty($dados['idNoticia']))
                return $this->showError('Você deve informar o ID da Noticia');

            $noticia = new NoticiaModel($dados['idNoticia']);
            
            $response = $noticia->delete();

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