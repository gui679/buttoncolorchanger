<?php

class GuilhermeMedeiros_ButtonColorChanger_Model_Entity_Types
{
    static public function getOption()
    {
        $data_array = array();
        $data_array['1'] = "Intervalo";
        $data_array['2'] = "Semanal";
        //$data_array['3'] = "Mensal";
        return ($data_array);
    }

    static public function getValue()
    {
        $data_array = array();
        foreach (self::getOption() as $k => $v) {
            $data_array[] = array('value' => $k, 'label' => $v);
        }
        return ($data_array);
    }

    static public function getHtmlOptions(){
        $html = '';
        foreach (self::getOption() as $k => $v) {
            $html .= '<option value="'.$k.'">'.$v.'</option>';
        }
        return $html;
    }
}
