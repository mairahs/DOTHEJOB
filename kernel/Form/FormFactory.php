<?php
namespace Kernel\Form;

class FormFactory {
    private $datas;

    public function __construct($datas=array()) {
        $this->datas = $datas;
        //var_dump($datas);
        //die();
    }

    private function setValueField($name) {
        $data = isset($this->datas->$name) ? $this->datas->$name : NULL ;
        return $data;
    }


    private function displayFormGroup($field) {
        return "<div class='form-group'>$field</div>";
    }


    public function displayInput($label,$name,$type ="text"){
        $label = "<label id='$name'>$label</label>";
        $input = "<input type='$type' name='$name' id='$name' class='form-control' value='{$this->setValueField($name)}'>";

        return $this->displayFormGroup($label.$input);
    }

    public function displayTextarea($label,$name,$nb_rows=10){
        $label = "<label id='$name'>$label</label>";
        $input ="<textarea rows='$nb_rows' name='$name' id='$name' class='form-control'>{$this->setValueField($name)}</textarea>";

        return $this->displayFormGroup($label.$input);
    }

    public function displaySelect($label,$name,$options) {
        $label = "<label id='$name'>$label</label>";
        $input = "<select class='form-control' id='$name' name='$name'>";


        $id_value_actuelle = $this->setValueField($name);

        foreach($options as $option ) {
if($option->id == $id_value_actuelle) {
    $input .= "<option selected value='$option->id'>$option->nom</option>";
} else {
    $input .= "<option  value='$option->id'>$option->nom</option>";
}


        } // Fin foreach

        $input .="</select>";
        return $this->displayFormGroup($label.$input);
    }

    public function displayCheckbox($label,$name,$options,$competences_actuelles) {
        $ids_competences_actuelles = array();
        foreach($competences_actuelles as $ca) {
            $ids_competences_actuelles[] = $ca->id_c;
        }
        //print_r($ids_competences_actuelles);
        //die();
        $label ="<h3>$label</h3>";
        $input ="";
        foreach($options as $option) {
    $input .= "<div class='checkbox'>";
    $input .= "<label>";
            if(in_array($option->id,$ids_competences_actuelles)) {
                $input .= "<input name='{$name}[]' type='checkbox' value='$option->id' checked> $option->nom";
            } else {
                $input .= "<input name='{$name}[]' type='checkbox' value='$option->id'> $option->nom";
            }

            $input .= "</label>";
            $input .= "</div>";
        }


        return $label.$input;
    }

    public function displaySubmit() {
        $submit ="<input type='submit' class='btn btn-primary' value='valider'>";
        return $submit;
    }






}