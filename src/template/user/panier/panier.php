<?php
    Class Panier {
       
        public function __construct()
        {
            if(!isset($_SESSION)){
                session_start();
            }
            if(!isset($_SESSION['panier'])){
                $_SESSION['panier'] = array();
            }
        }

        public function ajouterArticleId($article_id){
            if(!in_array($article_id,$_SESSION['panier'])){
           // $_SESSION['panier'][] =$article_id; 
           array_push($_SESSION['panier'],$article_id);
            }
        }

        public function del($id_article){
            $cle = array_search($id_article,$_SESSION["panier"]);
            unset($_SESSION['panier'][$cle]);
        }
      

    }