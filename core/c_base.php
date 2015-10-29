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

        $this->data['city_list'] = City::GetAll();
        $this->data['main_page'] = false;

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
        if(JL::ex('type', 'ajax'))
            $page = '';
        else
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
}