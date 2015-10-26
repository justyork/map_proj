<?php
class C_Index extends C_Base{  
	protected function OnInput(){
        parent::OnInput();

        return $this->GeneratePage($this);
    }
	
	//
	// Виртуальный генератор HTML.
	//	
	protected function OnOutput(){

		// Подключаем вложенный шаблон
        $vars = array('data' => $this->data);
		$this->content = $this->Template( $this->tpl, $vars);
        
		parent::OnOutput();
	}

    public function actionIndex(){
        $this->tpl = 'front/index/index';
        $this->title = 'Main Page title';

        $this->data['main_page'] = true;
    }

    public function actionLogout(){
        Auth::Logout();
        JL::redirect('/');
    }
} 


