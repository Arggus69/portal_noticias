<?php
    require_once 'DAL/NoticiaDAO.php';

    class NoticiaModel {
        public ?int $idNoticia;
        public ?int $idAutor;
        public ?string $tituloNoticia;
        public ?string $conteudoNoticia;
        public ?string $imagemNoticia;

        public function __construct(
            ?int $idNoticia = null,
            ?int $idAutor = null,
            ?string $tituloNoticia = null,
            ?string $conteudoNoticia = null,
            ?string $imagemNoticia = null
        ) {
            $this->idNoticia = $idNoticia;
            $this->idAutor = $idAutor;
            $this->tituloNoticia = $tituloNoticia;
            $this->conteudoNoticia = $conteudoNoticia;
            $this->imagemNoticia = $imagemNoticia;
        }

        public function getNoticias() {
            $noticiaDAO = new NoticiaDAO();

            $noticias = $noticiaDAO->getNoticias();

            foreach ($noticias as $chave => $noticia) {
                $noticias[$chave] = new NoticiaModel(
                    $noticia['idNoticia'],
                    $noticia['idAutor'],
                    $noticia['tituloNoticia'],
                    $noticia['conteudoNoticia'],
                    $noticia['imagemNoticia']
                );
            }

            return $noticias;
        }

        public function create() {
            $noticiaDAO = new NoticiaDAO();

            return $noticiaDAO->createNoticia($this);
        }

        public function update() {
            $noticiaDAO = new NoticiaDAO();

            return $noticiaDAO->updateNoticia($this);
        }

        public function delete() {
            $noticiaDAO=  new NoticiaDAO();

            return $noticiaDAO->deleteNoticia($this);
        }
    }
?>