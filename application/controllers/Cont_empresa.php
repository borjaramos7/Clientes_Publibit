<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cont_empresa extends CI_Controller {
    
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
     * Llama a la vista donde se registran las nuevas empresas
     */
    public function AddEmpresa() {
        $this->CargaReglas();

        if ($this->form_validation->run() == FALSE) {
            $this->CargaPlantilla(
                    $this->load->view('reg_empresa', "", TRUE),"Registro de empresas");
        } else {
            $datosemp = array(
                'nomempresa' => $this->input->post('nombreemp'),
                'cif' => $this->input->post('cif'),
                'emailcontacto' => $this->input->post('correo'),
                'numcontacto' => $this->input->post('numcon'));

            $this->Model_emp->AltaEmp($datosemp);
            redirect('/Cont_empresa/VerEmpresa', 'location', 301);
        }
    }
    
    public function Ordenar(){
        $this->VerEmpresa("S");
    }
    
    /**
     * Funcion que llama a una vista que lista las empresas ya sea a todas si no se ha buscado ningun caracter o
     * un conjunto de empresas que coincidan con los parametros, si en el buscador existe algun dato
     */
    public function VerEmpresa($ordenado='N',$desde=0) {
        $_SESSION['estado']['ordenado']=$ordenado;
            $datospag = $this->PaginacionEmp($desde);
            //echo "<pre>".print_r($datospag)."</pre>";
            $this->CargaPlantilla(
                    $this->load->view('lista_empresas', array(
                        'listacli' => $datospag['lista'],
                        'paginacion' => $datospag['paginacion']
                            ), TRUE), "Empresas asociadas");
    }
    
    /**
     * Funcion para el buscador que funciona con AJAX
     */
    public function BuscaAjax() {
        $_SESSION['estado']['buscador']=$_POST['q'];
            $listabus = $this->Model_emp->Buscador($_SESSION['estado']['buscador']);//PaginacionEmp($ordenado, $desde);
            $cuerpo = $this->load->view('lista_empresas', array(
                'listacli' => $listabus));
    }

    /*public function ListarDatos($desde=0) {
        if ($_SESSION['estado']['ordenado']=='pendientes')
        {
            
        }
        else
        {}
    }*/
     
    /**
     * Paginacion para empresas
     * @return type
     */
    public function PaginacionEmp($desde) {
        $opciones = array();
        //$desde = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $opciones['per_page'] = 4;
        $opciones['base_url'] = site_url('Cont_empresa/VerEmpresa/'.$_SESSION['estado']['ordenado']);
        
        if ($_SESSION['estado']['ordenado']!='S'){$opciones['total_rows'] = $this->Model_emp->TotalClientes();}
        else {$opciones['total_rows']=$this->Model_emp->TotalPendientes();}
        
        $opciones['full_tag_open'] = '<ul class="pagination">';
        $opciones['full_tag_close'] = '</ul>';
        $opciones['num_tag_open'] = '<li>';
        $opciones['num_tag_close'] = '</li>';
        $opciones['cur_tag_open'] = '<li class="active"><span>';
        $opciones['cur_tag_close'] = '</span></li>';
        $opciones['prev_tag_open'] = '<li>';
        $opciones['prev_tag_close'] = '</li>';
        $opciones['next_tag_open'] = '<li>';
        $opciones['next_tag_close'] = '</li>';
        $opciones['first_link'] = 'Primero';
        $opciones['prev_link'] = 'Anterior';
        $opciones['last_link'] = 'Último';
        $opciones['next_link'] = 'Siguiente';
        $opciones['first_tag_open'] = '<li>';
        $opciones['first_tag_close'] = '</li>';
        $opciones['last_tag_open'] = '<li>';
        $opciones['last_tag_close'] = '</li>';
        //$opciones['uri_segment'] = 3;

        $this->pagination->initialize($opciones);
        if ($_SESSION['estado']['ordenado'] == 'S') {
            $datapend['lista'] = $this->Model_emp->ListaEmpXpend($opciones['per_page'], $desde);
            $datapend['paginacion'] = $this->pagination->create_links();
            return $datapend;
        } else if ($_SESSION['estado']['ordenado']=='N'){
            
            $data['lista'] = $this->Model_emp->ListaEmp($opciones['per_page'], $desde);
            $data['paginacion'] = $this->pagination->create_links();
            return $data;
        }
        /*else if ($ordenado=='B'){
            $databus['lista'] = $this->Model_emp->Buscador($_SESSION['estado']['buscador']);
            $databus['paginacion'] = $this->pagination->create_links();
            return $databus;
        }*/
    }

    /**
     * Funcion que recibe la id de una empresa y llama a la vista para crearle un trabajo a esa empresa
     * @param type $idemp
     */
    public function AddTrabajo($idemp) {
        $this->CargaPlantilla(
                $this->load->view('reg_trabajo', array('idemp' => $idemp), TRUE), "Nueva orden de trabajo");
    }

    /**
     * recoge los datos del formulario de registro de trabajos y realiza una llamada al modelo para insertar
     * esos datos
     */
    public function AddOrden() {
        //redirect('', 'location', 301);
        /* $this->form_validation->set_rules('fecha', 'fecha', 'callback_checkDateFormat');

          if ($this->form_validation->run() == FALSE) {
          $this->CargaPlantilla(
          $this->load->view('reg_trabajo', "", TRUE));
          } else { */
        $datosorden = array(
            'denominacion' => $this->input->post('denom'),
            'descripcion' => $this->input->post('descrip'),
            'estado' => $this->input->post('estado'),
            'fecha_inicio' => $this->input->post('fecha'),
            'redactor' => $this->session->userdata('username'),
            '_idcliente' => $this->input->post('idemp'));
        $this->Model_emp->NuevaOrden($datosorden);
        redirect('/Cont_empresa/VerTrabajos/' . $this->input->post("idemp") . '', 'location', 301);
        //}
    }
    
    /**
     * recibe la id de un trabajo llama al modelo para sacar los datos de dicho trabajo y los devulve para que puedas ver
     * los datos anteriores antes de modificarlos
     * @param type $idorden
     */
    public function ShowModificaOrden($idorden) {
        $orden = $this->Model_emp->SacaOrden($idorden);
        $this->CargaPlantilla($this->load->view('mod_trabajo', array(
                    'idemp' => $orden['_idcliente'],
                    'orden' => $orden
                        ), TRUE), "Modificar orden de trabajo " . $orden['idtrabajo']);
    }
    
    /**
     * Recoge por post los datos de una modificacion y llama al modelo para que inserte dichos datos
     */
    public function ModificaOrden() {
        $datosorden = array(
            'denominacion' => $this->input->post('denom'),
            'descripcion' => $this->input->post('descrip'),
            'estado' => 'pendiente',
            'fecha_inicio' => $this->input->post('fecha'),
            '_idcliente' => $this->input->post('idemp'));
        $this->Model_emp->ModOrden($datosorden, $this->input->post('idorden'));
        redirect('/Cont_empresa/VerOrdenComp/' . $this->input->post("idorden") . '', 'location', 301);
    }
    
    /**
     * recibe la id de una empresa ,llama al modelo para sacar sus trabajos y llama a la vista que los muestra
     * @param type $idemp
     */
    public function VerTrabajos($idemp) {
        $trabajosxemp = $this->Model_emp->TrabajosXEmp($idemp);
        $this->CargaPlantilla(
                $this->load->view('trabajos', array(
                    'trabajos' => $trabajosxemp,
                    'idemp' => $idemp
                        ), TRUE), "Trabajos de " . $this->Model_emp->SacaNombreCliente($idemp));
    }

    /**
     * Recibe la id de un cliente y modifica sus datos
     * @param type $idcli
     */
    public function ModificaEmpresa($idcli) {
        $this->CargaReglasmod();

        if ($this->form_validation->run() == FALSE) {
            
            $datosemp = $this->Model_emp->SacaEmpresa($idcli);

            $this->CargaPlantilla($this->load->view('mod_empresa', array(
                    'datosemp' => $datosemp
                        ), TRUE), "Modificar los datos de " . $datosemp['nomempresa']);
        } else {
            $datosemp = array(
                'nomempresa' => $this->input->post('nombreemp'),
                'cif' => $this->input->post('cif'),
                'emailcontacto' => $this->input->post('correo'),
                'numcontacto' => $this->input->post('numcon'));

            $this->Model_emp->ModEmp($datosemp, $this->input->post('idemp'));
            redirect('/Cont_empresa/VerEmpresa', 'location', 301);
        }
    }

    /**
     * Recibe la id de un trabajo ,saca todos sus datos y llama una vista que muestra el trabajo en detalle
     * @param type $idorden
     */
    public function VerOrdenComp($idorden) {
        $orden = $this->Model_emp->SacaOrden($idorden);
        $this->CargaPlantilla($this->load->view('TrabajoComp', array(
                    'orden' => $orden
                        ), TRUE), "Orden nº " . $orden['idtrabajo']);
    }

    /**
     * Recibe la id de una empresa y pasa todos sus datos a una vista que los muestra completos
     * @param type $idcliente
     */
    public function VerEmpresaComp($idcliente) {
        $datosemp = $this->Model_emp->SacaEmpresa($idcliente);
        $this->CargaPlantilla($this->load->view('EmpresaComp', array(
                    'datosemp' => $datosemp
                        ), TRUE), $datosemp['nomempresa']);
    }

    /**
     * Recibe la id de una orden y cambia su estado a "Finalizada"
     * @param type $idorden
     */
    public function FinalizaOrden($idorden) {
        $this->Model_emp->EndOrden($idorden);
        redirect('/Cont_empresa/VerOrdenesPend/', 'location', 301);
    }
    
    public function BuscaOrd() {
        $listaordenes=$this->Model_emp->BuscaPorDen($this->input->post('buscaordenes'));
        //echo "<pre>".print_r($listaordenes)."</pre>";
        $this->CargaPlantilla(
                $this->load->view('trabajos', array(
                    'trabajos' => $listaordenes,
                        ), TRUE), "Busqueda de ordenes");
    }
    
    /**
     * Llama al modelo para sacar las ordenes pendientes y llama a una vista para mostrarlas
     */
    public function VerOrdenesPend() {
        $listaordpen = $this->Model_emp->OrdenesPend();
        $this->CargaPlantilla(
                $this->load->view('trabajos', array(
                    'trabajos' => $listaordpen,
                        ), TRUE), "Ordenes pendientes");
    }

    /**
     * Recibe la id de una orden y llama a la vista para subir archivos pasandole la id de esa orden
     * @param type $idorden
     */
    public function importar($idorden) {

        //$action = "/Exp_impXML/Procesa";
        $this->CargaPlantilla(
                $this->load->view('importarDatos', array(
                    'idorden' => $idorden
                        ), TRUE), "Selecciona un archivo para importar");
    }

    /**
     * Recibe una id de una orden y llama a una vista que muestra un menu para la descarga de dichos archivos
     * @param type $idorden
     */
    public function ListaArchivos($idorden) {
        $archivosxorden = $this->Model_emp->ArchivosXOrden($idorden);
        $this->CargaPlantilla(
                $this->load->view('listaarch', array(
                    'archivos' => $archivosxorden
                        ), TRUE), "Archivos disponibles para este trabajo");
    }

    /**
     * Funcion para subir archivos al servidor
     */
    public function subirarchivo() {
        $numarch = $this->Model_emp->CompNombreArch($_FILES['uploadedfile']['name']);
        $nombrear = $_FILES['uploadedfile']['name'];
        $target_path = "C:\\xampp\htdocs\Clientes_Publibit\archivos\\";
        //$target_path='archivos/';Para cuando este en el servidor
        if ($numarch == 0)
            $target_path = $target_path . basename($_FILES['uploadedfile']['name']);
        else {
            $target_path = $target_path . "(" . $numarch . ")" . basename($_FILES['uploadedfile']['name']);
            $nombrear = "(" . $numarch . ")" . $_FILES['uploadedfile']['name'];
        }
        if (move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
            $datos_archivo = array(
                'nomarchivo' => $nombrear,
                '_idtrabajo' => $this->input->post('idorden'),
                '_idclientearch' => $this->Model_emp->SacaIdClienteXTrab($this->input->post('idorden'))
            );
            //$this->Model_emp->InsertaEnlace($_FILES['uploadedfile']['name'],$this->input->post('idorden'));
            $this->Model_emp->InsertaArchivo($datos_archivo);
            redirect('/Cont_empresa/VerOrdenComp/' . $this->input->post("idorden") . '', 'location', 301);
        } else {
            echo "Ha ocurrido un error en la subida del archivo " . $_FILES['uploadedfile']['name'];
        }
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

    /**
     * Recibe una fecha y devuelve un booleano en funcion de si esta en un formato correcto o no
     * @param type $date
     * @return boolean
     */
    public function checkDateFormat($date) {
        if (preg_match("/[0-31]{2}\/[0-12]{2}\/[0-9]{4}/", $date)) {
            if (checkdate(substr($date, 3, 2), substr($date, 0, 2), substr($date, 6, 4)))
                return true;
            else
                return false;
        } else {
            return false;
        }
    }

    /**
     * Reglas para la validacion al modificar los datos de una empresa
     */
    public function CargaReglasmod() {
        $this->form_validation->set_rules('nombreemp', 'Nombre de empresa', 'required');
        $this->form_validation->set_rules('correo', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('cif', 'cif', 'required|min_length[9]|max_length[9]');

        $this->form_validation->set_message('required', 'El campo %s no puede estar vacio');
        $this->form_validation->set_message('valid_email', 'El email no tiene el formato correcto');
        $this->form_validation->set_message('min_length', 'El cif tiene que tener 9 digitos');
        $this->form_validation->set_message('max_length', 'El cif tiene que tener 9 digitos');
    }

    /**
     * Reglas para la validacion al registrar una empresa
     */
    public function CargaReglas() {
        $this->form_validation->set_rules('nombreemp', 'Nombre de empresa', 'required');
        $this->form_validation->set_rules('correo', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('cif', 'cif', 'required|min_length[9]|max_length[9]|callback_CompCif');

        $this->form_validation->set_message('required', 'El campo %s no puede estar vacio');
        $this->form_validation->set_message('valid_email', 'El email no tiene el formato correcto');
        $this->form_validation->set_message('min_length', 'El cif tiene que tener 9 digitos');
        $this->form_validation->set_message('max_length', 'El cif tiene que tener 9 digitos');
        $this->form_validation->set_message('CompCif', 'Ese cif ya esta registrado en la base de datos');
    }

    /**
     * realiza una llamada a la base datos pasandole un cif, que recoge por post, para saber si ese cif existe
     * @return boolean
     */
    public function CompCif() {
        $existecif = $this->Model_emp->CompruebaCif($this->input->post('cif'));
        $this->form_validation->set_message('CompCif', 'El CIF introducido ya existe');
        if ($existecif) {
            return false;
        } else
            return true;
    }

    /**
     * Recibe la id de un trabajo y exporta un pdf con los datos de esa orden 
     * @param type $idorden
     */
    public function BorrarOrden($idorden) {

        $orden = $this->Model_emp->SacaOrden($idorden);
        $orden['nomempresa'] = $this->Model_emp->SacaNombreCliente($orden['_idcliente']);
        if ($this->Model_emp->Numarchivosxorden($idorden) > 0) {
 
            $this->BorraArchivosOrden($idorden);
        }

        $this->pdf->ExportaPdf($orden);
        $this->Model_emp->BorraOrden($idorden);
        redirect('/Cont_empresa/VerOrdenComp{'.$idorden.'}', 'location', 301);
    }
    
    /**
     * LLama a la vista que te pide que confirmes si quieres borrar esos archivos
     */
    public function BorrarArchConSeg($idorden) {
        $this->CargaPlantilla(
                $this->load->view('seg_borrararchivos', array(
                    'idorden' => $idorden
                        ), TRUE), "Descargados los archivos de esta orden.<br><br>"
                . "¿Estas seguro de borrar dichos archivos ,asi como la propia orden del sistema?");
    }
   
    /**
     * Recibe una id de una orden y elimina los archivos que tenga dicha orden asi como su existencia en la bbdd
     * @param type $idorden
     */
    public function BorraArchivosOrden($idorden) {
        $archivos = $this->Model_emp->ArchivosXOrden($idorden);
        foreach ($archivos as $archivo) {
            $file = "C:\\xampp\htdocs\Clientes_Publibit\archivos\\" . $archivo['nomarchivo'];
            //$file = "archivos/" . $archivo['nomarchivo'];Para servidor
            $do = unlink($file); //elimina archivo
            $this->Model_emp->Borraarchivo($archivo['nomarchivo']); //elimina datos del archivo de la BBDD

            if ($do != true) {
                echo "Hay un error en la descarga de " . $archivo['nomarchivo'] . "<br />";
            }
            //$this->Model_emp->BorraOrden($idorden);
        }
    }

    /**
     * Recibe la id de una orden y añade sus ficheros a un .zip que luego descarga.
     * @param type $idorden
     * @return type
     */
    public function CreaZip($idorden) {
        
        $archivos = $this->Model_emp->ArchivosXOrden($idorden);
        
        foreach ($archivos as $archivo) {
            $this->zip->read_file("C:/xampp/htdocs/Clientes_Publibit/archivos/".$archivo['nomarchivo']); 
        }
        $this->zip->download("ficheros_orden_".$idorden."_.zip");

    }
    
    /*public function BorraEmpresa($idcli) {
        
    }*/

}
