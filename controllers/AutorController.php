<?php
    require_once './models/AutorModel.php';
    
    class AutorController {
        public function getAutores() {
            $autorModel = new AutorModel();

            $response = $autorModel->getAutores();

            return json_encode([
                'error' => null,
                'result' => $response
            ]);
        }

        public function createAutor() {
            $dados = json_decode(file_get_contents('php://input'), true);
                if (empty($dados['nomeAutor'])) {
                    return $this->showErro('voce deve informar o nome do autor :p');
                }
            
            $autor = new AutorModel(null, $dados['nomeAutor']);

            $response = $autor->create();

            return json_encode([
                'error' => null,
                'result' => $response
                ]);
            }
            
            public function deleteAutor() {
                $dados = json_decode(file_get_contents("php://input"), true);
    
                if (empty($dados['idAutor']))
                    return $this->showError('Você deve informar o ID do Autor');
    
                $autor = new AutorModel($dados['idAutor']);
                
                $response = $autor->delete();
    
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

            public function updateAutor() {
                $dados = json_decode(file_get_contents("php://input"), true);
    
                if (empty($dados['idAutor']))
                    return $this->showError('Você deve informar o ID do Autor');
            
                if (empty($dados['nomeAutor']))
                    return $this->showError('Você deve informar o Noem do Autor');
    
                $autor = new AutorModel(
                    $dados['idAutor'],
                    $dados['nomeAutor'],
                );
    
                $response = $autor->update();
    
                return json_encode([
                    'error' => null,
                    'result' => $response
                ]);
            }
            private function showErro(string $msg) {
                return json_encode([
                    'error' => $msg,
                    'return' => null
                ]);
            }
    }
?>