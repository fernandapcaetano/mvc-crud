<?php
use app\core\Controller;
use app\models\Post;

class Posts extends Controller {
    public function index(){
        
        $this->view('posts');

        
        $postname = $_GET['url'];
        $postname = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        $postname = $postname[1] ?? null;

        if ($postname) {
            $post = $this->findBy($postname, "id"); // Use $this instead of self since findBy is not a static method
            if ($post) {
                echo "<h1>{$post['name']}</h1>";
                echo "<p>{$post['content']}</p>";
            } else {
                echo "<p>Post not found.</p>";
            }
        }
   
    }

    public function findBy($name, $param){
        
        $posts = [
            ['id' => '1', 'name' => 'Primeiro-Post', 'content' => 'Conteúdo do Primeiro Post'],
            ['id' => '2','name' => 'Segundo-Post', 'content' => 'Conteúdo do Segundo Post'],
        ];

        foreach ($posts as $post) {
            if (strtolower($post[$param]) === strtolower($name)) {
                return $post;
            }
        }

        return null;
    }
    
}
