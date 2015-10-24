<?php
class C_Index extends C_Base{  
	protected function OnInput(){
        parent::OnInput(); 
        $this->data = array();

        return $this->GeneratePage($this);
    }
	
	//
	// Виртуальный генератор HTML.
	//	
	protected function OnOutput(){

		// Подключаем вложенный шаблон
		$vars = array(
        );
		$this->content = $this->Template( $this->tpl, $vars);
        
		parent::OnOutput();
	}

    public function actionIndex(){
        $this->tpl = 'front/index';
        $this->title = 'Main Page title';
		
        if(isset($_POST['login'])){
            if(empty($_POST['login']) || empty($_POST['password'])){
                $this->errors[] = 'All fields are required';
                return;
            }

            $auth_ret = Auth::Login($_POST['login'], $_POST['password']);
            if( $auth_ret !== true)
                $this->errors[] = $auth_ret;
            else
                JL::referer();
        }
    }

    public function actionLogout(){
        Auth::Logout();
        JL::redirect('/');
    }
} 


