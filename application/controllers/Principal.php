<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Principal extends CI_Controller {
 
    public function index()
	{
                $error="";
		$this->CargaPlantilla($this->load->view('inicio',array(
                'error'=>$error),TRUE),"");
	}
        
    protected function CargaPlantilla($cuerpo='',$encabezado="") {
            $this->load->view('vista_principal',array(
                'cuerpo'=>$cuerpo,
                'encabezado'=>$encabezado
                ));   
           }
}
