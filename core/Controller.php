<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

// Базовый класс контроллера.
abstract class Controller {
     
    // Полная обработка HTTP запроса.
    public function Request() {
        $this->OnInput();
        $this->OnOutput();
    }

    // Виртуальный обработчик запроса.
    protected function OnInput() {
    }

    // Виртуальный генератор HTML.
    protected function OnOutput() {
    }

    // Подключение шаблона.
    protected function Template($fileName, $vars = array() ) {
        foreach ($vars as $k => $v) {
            $$k = $v;
        } 
        ob_start();
        include( TPL_PATH . '/' . $fileName . '.php' );
        return ob_get_clean();
    }
     
}