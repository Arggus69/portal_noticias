<?php
    require_once 'DAL/AutorDAO.php';

    class AutorModel {
        public ?int $idAutor;
        public ?string $nomeAutor;

        public function __construct(
            ?int $idAutor = null,
            ?string $nomeAutor = null
        ) {
            $this->idAutor = $idAutor;
            $this->nomeAutor = $nomeAutor;
        }

        public function getAutores() {
            $autorDAO = new AutorDAO();

            $autores = $autorDAO->getAutores();

            foreach ($autores as $chave => $autor) {
                $autores[$chave] = new AutorModel(
                    $autor['idAutor'],
                    $autor['nomeAutor']
                );
            }

            return $autores;
        }
    }
?>