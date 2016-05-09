<?php


class Proc extends CI_Controller {

    public function index() {
        $q = $_POST['q'];
        $listabus = $this->Model_emp->Buscador($q);
         $this->load->view('lista_empresas', array(
                    'listacli' => $listabus
                        ), TRUE);
         
            echo "<pre>";
            print_r($listabus);
            echo "</pre>";
         
        /*$this->CargaPlantilla(
                $this->load->view('lista_empresas', array(
                    'listacli' => $listabus
                        ), TRUE), "");*/
    }

    protected function CargaPlantilla($cuerpo = '', $encabezado = "") {
        $this->load->view('vista_principal', array(
            'cuerpo' => $cuerpo,
            'encabezado' => $encabezado
        ));
    }

}

?>

