<?php

namespace Models;

require_once('libraries/models/Model.php');

class Comment extends Model{

    protected $table = "comments";

    /**
     * Retourne la liste des articles classés par date de création
     * 
     * @return array
     */

    public function findAllWithArticle(int $article_id): array {

        $query = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE article_id = :article_id");
        // On fouille le résultat pour en extraire les données réelles
        $query->execute(['article_id' => $article_id]);
        $commentaires = $query->fetchAll();

        return $commentaires;
    }

    /**
     * Insére un commentaire contenant l'auteur, le contenu et l'id de l'article
     * 
     * @return 
     */

    public function insert(string $author, string $content, int $article_id): void{

        $query = $this->pdo->prepare('INSERT INTO comments SET author = :author, content = :content, article_id = :article_id, created_at = NOW()');
        $query->execute(compact('author', 'content', 'article_id'));

    }
}