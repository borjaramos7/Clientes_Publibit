<?php

/**
 * Controlador para manejar todo lo relacionado con los spots
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Cont_spot extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if (!$this->Model_us->EstaDentro())
        {
            redirect("Cont_user/Login");
            exit;
        }
    }

    public function index() {
        
    }

    /**
     * Llama a la vista para registrar un nuevo spot a la empresa que recibe por parametros
     * @param type $idemp
     */
    public function NuevoSpot($idemp) {
         $this->CargaReglasSpot();
        if ($this->form_validation->run() == FALSE) {       
        $this->CargaPlantilla(
                $this->load->view('reg_spot', array
                    ('idemp' => $idemp), TRUE), "Nuevo spot para " . $this->Model_emp->SacaNombreCliente($idemp));
        } else {
            $datosspot = array(
                'mesescont' => $this->input->post('meses'),
                'repxmes' => $this->input->post('repet'),
                'mes_gratis' => $this->input->post('gratis'),
                'precio' => $this->input->post('precio'),
                '_idcliente' => $this->input->post('idemp'));
            $this->Model_spot->AltaSpot($datosspot);
            redirect('Cont_spot/VerSpots/' . $this->input->post('idemp'), 'location', 301);
        }
        
    }

    /**
     * Llama a una vista que muestra los spots que le pasamos que en este caso son los de un cliente concreto
     * @param type $idemp
     */
    public function VerSpots($idemp) {
        $spotsxemp = $this->Model_spot->SpotsXEmp($idemp);
        $this->CargaPlantilla(
                $this->load->view('spots', array(
                    'spots' => $spotsxemp,
                    'idemp' => $idemp
                        ), TRUE), "Spots de " . $this->Model_emp->SacaNombreCliente($idemp));
    }


    /**
     * Verifica los nuevos datos introducidos y en caso de que sean correctos llama al modelo para que los modifique
     * en la id correcta
     */
    public function ModificaSpot($idspot) {
        $this->CargaReglasSpot();

        if ($this->form_validation->run() == FALSE) {
            
            $spot = $this->Model_spot->SacaSpot($idspot);
            
        $this->CargaPlantilla($this->load->view('mod_spot', array(
                    'idemp' => $spot['_idcliente'],
                    'spot' => $spot
                        ), TRUE), "Modificar datos del spot " . $spot['idspot']);
        } else {
            $datosspot = array(
                'repxmes' => $this->input->post('repet'),
                'mesescont' => $this->input->post('meses'),
                'mes_gratis' => $this->input->post('gratis'),
                'precio' => $this->input->post('precio'),
                '_idcliente' => $this->input->post('idemp'));
            $this->Model_spot->ModSpot($datosspot, $this->input->post('idspot'));
            redirect('/Cont_Spot/VerSpotComp/' . $this->input->post('idspot'), 'location', 301);
        }
    }
    
    /**
     * Recibe la id de un spot y llama al modelo para borrar dicho spots.
     * @param type $idspot
     */
    public function BorrarSpot($idspot) {
           $this->Model_spot->BorrarSpot($idspot);
           redirect('/Cont_Spot/VerSpotsActivos');
    }
    
    /**
     * Funcion que recibe una id de un spot y saca todos sus datos para mandarselos a una vista que los muestra en detalle
     * @param type $idspot
     */
    public function VerSpotComp($idspot) {
        $spot = $this->Model_spot->Sacaspot($idspot);
        $this->CargaPlantilla($this->load->view('SpotComp', array(
                    'spot' => $spot
                        ), TRUE), "Spot nº " . $spot['idspot']);
    }

    /**
     * Funcion encargada de crear las reglas para validar un spot
     */
    public function CargaReglasSpot() {
        $this->form_validation->set_rules('meses', 'Meses contratados', 'numeric|required');
        $this->form_validation->set_rules('repet', 'Repeticiones por mes', 'numeric|required');
        $this->form_validation->set_rules('precio', 'Precio', 'numeric|required');

        $this->form_validation->set_message('numeric', 'El campo %s tiene que tener un valor numerico');
        $this->form_validation->set_message('required', 'El campo %s no puede estar vacio');
    }
    /**
     * Saca un array con los spots que estan finalizando y los manda a una vista
     */
    public function SpotsAcabandose() {
        $listaspot=$this->Model_spot->SpotsFinalizando();     
        foreach ($listaspot as $clave=>$spot) {
            $listaspot[$clave]['locpant']=$this->Model_spot->PantallasDeSpotFin($spot['idspot']);
            $listaspot[$clave]['nomcli']= $this->Model_emp->SacaNombreCliente($spot['_idcliente']);
        }
        $this->CargaPlantilla($this->load->view('Avisos', array(
                    'listaspot' => $listaspot
                        ), TRUE), "Avisos de spots que finalizan en menos de 10 dias");
        /*echo "<pre>";
        echo print_r($listaspot);
        echo "</pre>";*/
    }
    
    /**
     * Recoge los datos del formulario y se los pasa al modelo para que los inserte
     */
    public function AddPantalla() {
        $this->CargaReglasPant();

        if ($this->form_validation->run() == FALSE) {
            $prov = $this->Model_spot->SacaProv();
            
            $this->CargaPlantilla(
                    $this->load->view('reg_pantalla', array(
                        'provincias' => $prov
                            ), TRUE), "Registro de nueva pantalla");
        } else {
            $datospant = array(
                'localidad' => $this->input->post('localidad'),
                'direccion' => $this->input->post('direccion'),
                'prov_cod' => $this->input->post('provincia'));
            $this->Model_spot->AddPant($datospant);
            redirect('/Cont_Spot/VerPantallas/');
        }
       
    }
    
    /**
     * Recibe una id de pantalla y llama a una vista que te pide una confirmacion de borrado
     * @param type $idpant
     */
    public function BorraPantallaSeg($idpant) {
        $this->CargaPlantilla(
                $this->load->view('seg_borrarpant', array(
                    'idpant' => $idpant
                        ), TRUE), "¿Estas seguro de borrar esta pantalla(Se borraran todas las asociaciones con spots)?");
    }
    
    /**
     * Recibe una id de pantalla y borra los spots asociados a esa pantalla asi como los datos de dicha pantalla
     * @param type $idpant
     */
    public function BorraPantalla($idpant) {
        $this->Model_spot->BorraPant($idpant);
        redirect('/Cont_Spot/VerPantallas/');
    }
    
    /**
     * Reglas de validacion para pantallas
     */
    public function CargaReglasPant() {
        $this->form_validation->set_rules('provincia', 'Provincia', 'required');
        $this->form_validation->set_rules('localidad', 'Localidad', 'required');
        $this->form_validation->set_rules('direccion', 'Direccion', 'required');

        $this->form_validation->set_message('required', 'El campo %s no puede estar vacio');
    }

    /**
     * Recoge los datos del formulario de spot por pantalla y los envia al modelo para que los inserte
     */
    public function AddSpotXPant() {
        $datospotxpant = array(
            '_idspot' => $this->input->post('idspot'),
            '_idpantalla' => $this->input->post('pant'),
            'fechainicio' => $this->input->post('fechai'),
            'fechafin' => $this->input->post('fechaf'),
            'activo' => "si");
        $this->Model_spot->NuevoSpotXPant($datospotxpant);
        redirect('/Cont_Spot/VerSpotComp/' . $this->input->post('idspot'), 'location', 301);
    }

    /**
     * Recibe una id de un spot saca sus datos a traves de una llamada al modelo y llama a una vista para registrar los
     * datos del spot en esa pantalla
     * @param type $idspot
     */
    public function AsociarConPant($idspot) {
        $pantallas = $this->Model_spot->SacaPantallas();
        $this->CargaPlantilla(
                $this->load->view('reg_spotxpant', array(
                    'idspot' => $idspot,
                    'pantallas' => $pantallas
                        ), TRUE), "Asociar spot con pantalla");
    }

    /**
     * Le pasa a la vista spots los spots que estan activos
     */
    public function VerSpotsActivos() {
        $spotsact = $this->Model_spot->SpotsActivos();
        $this->CargaPlantilla(
                $this->load->view('spots', array(
                    'spots' => $spotsact
                        ), TRUE), "Spots activos");
    }

    /**
     * Llama a la vista para ver las pantallas 
     */
    public function VerPantallas() {
        $pantallas = $this->Model_spot->SacaPantallas();
        $this->CargaPlantilla(
                $this->load->view('pantallas', array(
                    'pantallas' => $pantallas
                        ), TRUE), "Pantallas");
    }

    /**
     * Recibe la id de una pantalla y llama a una vista donde muestra los spots de dicha pantalla
     * @param type $idpant
     */
    public function VerSpotDePant($idpant) {
        $spots = $this->Model_spot->SacaSpotsDePant($idpant);
        $this->CargaPlantilla(
                $this->load->view('spots', array(
                    'spots' => $spots
                        ), TRUE), "Spots de ");
    }

    /**
     * Recibe el cuerpo y el encabezado y llama a la vista principal pasandole esos parametros
     * @param type $cuerpo
     * @param type $encabezado
     */
    protected function CargaPlantilla($cuerpo = '', $encabezado = "") {
        $this->load->view('vista_principal', array(
            'cuerpo' => $cuerpo,
            'encabezado' => $encabezado
        ));
    }

}
