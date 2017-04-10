<?php
class Post extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->table = 'posts';
    }

    function Formatar($posts){
      if($posts){
        for($i = 0; $i < count($posts); $i++){
          $posts[$i]['editar_url'] = base_url('/blog/editar')."/".$posts[$i]['id'];
          $posts[$i]['excluir_url'] = base_url('/blog/excluir')."/".$posts[$i]['id'];
          $posts[$i]['status_url'] = base_url('/blog/status') . "/" . $posts[$i]['id'] . "/" . $posts[$i]['status'];
        }
        return $posts;
      } else {
        return false;
      }
    }


}