<?php

class Livro {
    // Propriedades privadas da classe Livro
    private $titulo;
    private $autor;
    private $ano;
    private $isbn;

    // Construtor da classe que inicializa as propriedades
    public function __construct($titulo, $autor, $ano, $isbn) {
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->ano = $ano;
        $this->isbn = $isbn;
    }

    // Métodos getters para acessar as propriedades
    public function getTitulo() {
        return $this->titulo;
    }

    public function getAutor() {
        return $this->autor;
    }

    public function getAno() {
        return $this->ano;
    }

    public function getIsbn() {
        return $this->isbn;
    }
}
?>
