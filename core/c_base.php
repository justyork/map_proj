<?php
include_once('./config.php');
include_once('Controller.php');  
                          
// Базовый контроллер сайта.
abstract class C_Base extends Controller {
 
    protected $title;		
    protected $content;		
    protected $tpl;		
    protected $page_id = 0;
    protected $data = array();
    protected $errors = array();
    protected $menu;
	

    
    // Виртуальный обработчик запроса
    protected function OnInput(){

        /*if(!Auth::Check()){
            if($_SERVER['REQUEST_URI'] != '/')
                JL::redirect('/');

            $this->auth = false;
            return false;
        }
        Auth::PrepareAuth();

        if( !Auth::Can( 'SHOW_PANEL' ) )
            die( 'Access denied.  Code 0' );
		*/ 
		
		$this->menu = $this->GenerateMenu();
    }
    
    //
    // Виртуальный генератор HTML.
    //
    protected function OnOutput() {
        $vars = array(
            'title' => $this->title,
            'content' => $this->content,
            'menu' => $this->menu, 
            'errors' => $this->errors,
            'data' => $this->data, 

	    );
 
 
        $page = $this->Template( 'main', $vars );


        echo $page;
    }

    protected function GeneratePage($th){
        if(isset($_GET['id']))
            $this->page_id = (int)$_GET['id'];
        if(empty($_GET['action']))
            return $th->actionIndex();
        $action = 'action'.ucfirst($_GET['action']);

        if(!method_exists($th, $action))
            return;


        return $th->$action();
    }
    private function GenerateMenu(){
        return  array(
            'Home' => array( '', ''), 
            'Exit' => array( 'logout', ''),
       );
    }
    private function GenerateMenuAdmin(){
        return  array(
            'Home' => array( 'admin', ''),
            'Users' => array( 'admin/users', ''), 
            'Exit' => array( 'logout', ''),
       );
    }
}