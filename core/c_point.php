<?php
class C_Point extends C_Base{
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



    public function actionAdd(){
        $this->tpl = 'front/point/add';
        $this->title = 'Main Page title';
        $this->data['hide_top'] = true;
        $this->data['categories_list'] = JL::ListData(Categories::GetAll());

    }

    public function actionLogout(){
        Auth::Logout();
        JL::redirect('/');
    }
} 


