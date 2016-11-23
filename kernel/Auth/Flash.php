<?php

namespace Kernel\Auth;


class Flash {

    public function setFlash($message,$type="danger") {
      $_SESSION['flash'] = array("message"=>$message,"type"=>$type);
    }

    public function getFlash() {
        if(isset($_SESSION['flash'])) {
  $html = '<div class="alert alert-'.$_SESSION["flash"]["type"].'">';
            $html .= $_SESSION['flash']['message'];
  $html .='</div>';


            unset($_SESSION['flash']);
            return $html;

        }
    }
}