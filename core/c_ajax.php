<?php
class C_Ajax extends C_Base{
	protected function OnInput(){
        parent::OnInput();

        return $this->GeneratePage($this);
    }

    /**
     * Поиск организации по нашей базе
     */
    public function actionSearchProperty(){

        $data = Addresses::Search($_POST['search']);

        if($data)
            echo json_encode(array('code' => 200, 'data' => $data));
        else echo json_encode(array('code' => 400));

    }

    public function actionSaveQuery(){

        Addresses::SaveAddressesByGoogle($_POST['search'], $_POST['results']);
    }


} 


