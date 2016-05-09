<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cont_empresa extends CI_Controller {
 
    public function index() {
        
    }
    
    /**
     * Llama a la vista donde se registran las nuevas empresas
     */
    public function AddEmpresa() {
            $this->CargaPlantilla(
                            $this->load->view('reg_empresa',"",TRUE),"Registro de empresas");
        }
    
    /**
     * Funcion que llama a una vista que lista las empresas ya sea a todas si no se ha buscado ningun caracter o
     * un conjunto de empresas que coincidan con los parametros, si en el buscador existe algun dato
     */
        public function VerEmpresa() {
        if (isset($_POST['q'])) {
            $q=$_POST['q'];
            $listabus = $this->Model_emp->Buscador($q);
            /*echo "<pre>ajax";
            print_r($listabus);
            echo "</pre>";*/
            $cuerpo=$this->load->view('lista_empresas', array(
            'listacli' => $listabus));
            //$encabezado="Empresas que coinciden";
   
        } else {
            $datospag = $this->PaginacionEmp();
            /*echo "<pre>NOajax";
            print_r($datospag);
            echo "</pre>";*/
            $this->CargaPlantilla(
                    $this->load->view('lista_empresas', array(
                        'listacli' => $datospag['lista'],
                        'paginacion' => $datospag['paginacion']
                            ), TRUE), "Empresas asociadas");
        }
    }
    
    /**
     * Paginacion para empresas
     * @return type
     */
        public function PaginacionEmp() {
            $opciones = array();
            $desde = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

            $opciones['per_page'] = 4;
            $opciones['base_url'] = base_url() . 'index.php/Cont_empresa/VerEmpresa';
            $opciones['total_rows'] = $this->Model_emp->TotalClientes();
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
           // $opciones['uri_segment'] = 3;

            $this->pagination->initialize($opciones);

            $data['lista'] = $this->Model_emp->ListaEmp($opciones['per_page'], $desde);
            $data['paginacion'] = $this->pagination->create_links();
            
            return $data;
            //$this->load->view('principal', $data);
        }
        
        /**
         * Funcion que recibe la id de una empresa y llama a la vista para crearle un trabajo a esa empresa
         * @param type $idemp
         */
        public function AddTrabajo($idemp){
                    $this->CargaPlantilla(
                            $this->load->view('reg_trabajo',array('idemp'=>$idemp),TRUE),"Nueva orden de trabajo");
        } 
        
        /**
         * recoge los datos del formulario de registro de trabajos y realiza una llamada al modelo para insertar
         * esos datos
         */
        public function AddOrden() {
        //redirect('', 'location', 301);
        /*$this->form_validation->set_rules('fecha', 'fecha', 'callback_checkDateFormat');

        if ($this->form_validation->run() == FALSE) {
            $this->CargaPlantilla(
                    $this->load->view('reg_trabajo', "", TRUE));
        } else {*/
            $datosorden = array(
                'denominacion' => $this->input->post('denom'),
                'descripcion' => $this->input->post('descrip'),
                'estado' => $this->input->post('estado'),
                'fecha_inicio' => $this->input->post('fecha'),
                'redactor' => $this->session->userdata('username'),
                '_idcliente' => $this->input->post('idemp'));
            $this->Model_emp->NuevaOrden($datosorden);
            redirect('/Cont_empresa/VerTrabajos/'.$this->input->post("idemp").'', 'location', 301);
            //}
    }
    
    /**
     * recibe la id de una empresa ,llama al modelo para sacar sus trabajos y llama a la vista que los muestra
     * @param type $idemp
     */
    public function VerTrabajos($idemp) {
        $trabajosxemp=$this->Model_emp->TrabajosXEmp($idemp);
            /*echo "<pre>";
            print_r($listacli);
            echo "</pre>";*/
            $this->CargaPlantilla(
                            $this->load->view('trabajos',array(
                                'trabajos'=>$trabajosxemp,
                                'idemp'=>$idemp
                            ),TRUE),"Trabajos de ".$this->Model_emp->SacaNombreCliente($idemp));
    }
    
    /**
     * recibe la id de un trabajo llama al modelo para sacar los datos de dicho trabajo y los devulve para que puedas ver
     * los datos anteriores antes de modificarlos
     * @param type $idorden
     */
    public function ShowModificaOrden($idorden) {
        $orden=$this->Model_emp->SacaOrden($idorden);
        $this->CargaPlantilla($this->load->view('mod_trabajo',array(
            'idemp'=>$orden['_idcliente'],
            'orden'=>$orden
                ),TRUE),"Modificar orden de trabajo ".$orden['idtrabajo']);
    }
    
    /**
     * recibe la id de un trabajo, llama al modelo para sacar los datos de esa empresa y los devulve para que puedas 
     * ver los datos antoerioes antes de modificarlos
     * @param type $idcli
     */
    public function ShowModEmpresa($idcli) {
        $datosemp=$this->Model_emp->SacaEmpresa($idcli);
        
        $this->CargaPlantilla($this->load->view('mod_empresa',array(
            'datosemp'=>$datosemp
                ),TRUE),"Modificar los datos de ".$datosemp['nomempresa']);
    } 
    
    /**
     * verifica los datos que has introducido para modificar tu empresa y si son correctos llama al modelo para que 
     * realice dichos cambios
     */
    public function ModificaEmpresa() {
        $this->CargaReglasmod();

            if   ($this->form_validation->run() == FALSE)
                {
                    $this->CargaPlantilla(
                            $this->ShowModEmpresa($this->input->post('idemp')));
                }
                else 
                {
                    $datosemp= array(
                        'nomempresa'=>$this->input->post('nombreemp'),                        
                        'cif'=>$this->input->post('cif'),
                        'emailcontacto'=>$this->input->post('correo'),
                        'numcontacto'=>$this->input->post('numcon'));
                    
                    $this->Model_emp->ModEmp($datosemp,$this->input->post('idemp'));
                    redirect('/Cont_empresa/VerEmpresa', 'location', 301);
                }
    }
    
    /**
     * Recibe la id de un trabajo ,saca todos sus datos y llama una vista que muestra el trabajo en detalle
     * @param type $idorden
     */
    public function VerOrdenComp($idorden) {
        $orden=$this->Model_emp->SacaOrden($idorden);
        $this->CargaPlantilla($this->load->view('TrabajoComp',array(
            'orden'=>$orden
                ),TRUE),"Orden nº ".$orden['idtrabajo']);
    }
    
    /**
     * Recibe la id de una empresa y pasa todos sus datos a una vista que los muestra completos
     * @param type $idcliente
     */
    public function VerEmpresaComp($idcliente) {
        $datosemp=$this->Model_emp->SacaEmpresa($idcliente);
        $this->CargaPlantilla($this->load->view('EmpresaComp',array(
            'datosemp'=>$datosemp
                ),TRUE),$datosemp['nomempresa']);
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
            $this->Model_emp->ModOrden($datosorden,$this->input->post('idorden'));
            redirect('/Cont_empresa/VerOrdenComp/'.$this->input->post("idorden").'', 'location', 301);
    }
    
    /**
     * Recibe la id de una orden y cambia su estado a "Finalizada"
     * @param type $idorden
     */
    public function FinalizaOrden($idorden) {
        $this->Model_emp->EndOrden($idorden);
        redirect('/Cont_empresa/VerOrdenesPend/', 'location', 301);
    }
    
    /**
     * Llama al modelo para sacar las ordenes pendientes y llama a una vista para mostrarlas
     */
    public function VerOrdenesPend() {
            $listaordpen=$this->Model_emp->OrdenesPend();
            $this->CargaPlantilla(
                            $this->load->view('trabajos',array(
                                'trabajos'=>$listaordpen,
                            ),TRUE),"Ordenes pendientes");
        }
    
    /**
     * Recibe la id de una orden y llama a la vista para subir archivos pasandole la id de esa orden
     * @param type $idorden
     */    
    public function importar($idorden) {
        
        //$action = "/Exp_impXML/Procesa";
        $this->CargaPlantilla(
                        $this->load->view('importarDatos',array(
                        'idorden' => $idorden
                            ),TRUE),"Selecciona un archivo para importar");
    }
    
    /**
     * Recibe una id de una orden y llama a una vista que muestra un menu para la descarga de dichos archivos
     * @param type $idorden
     */
    public function ListaArchivos($idorden) {
        $archivosxorden=$this->Model_emp->ArchivosXOrden($idorden);
        $this->CargaPlantilla(
                        $this->load->view('listaarch',array(
                        'archivos' => $archivosxorden
                            ),TRUE),"Archivos disponibles para este trabajo");
    }
    
    /**
     * Funcion para subir archivos al servidor
     */
    public function subirarchivo() {
        $numarch=$this->Model_emp->CompNombreArch($_FILES['uploadedfile']['name']);
        $nombrear=$_FILES['uploadedfile']['name'];
        $target_path = "C:\\xampp\htdocs\Clientes_Publibit\archivos\\";
        //$target_path='archivos/';Para cuando este en el servidor
        if ($numarch==0)
        $target_path = $target_path.basename($_FILES['uploadedfile']['name']);
        else  {
            $target_path = $target_path."(".$numarch.")".basename($_FILES['uploadedfile']['name']);
            $nombrear="(".$numarch.")".$_FILES['uploadedfile']['name'];
        }
        if (move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
            $datos_archivo=array(
                'nomarchivo'=>$nombrear,
                '_idtrabajo'=>$this->input->post('idorden'),
                '_idclientearch'=> $this->Model_emp->SacaIdClienteXTrab($this->input->post('idorden'))
            );
            //$this->Model_emp->InsertaEnlace($_FILES['uploadedfile']['name'],$this->input->post('idorden'));
            $this->Model_emp->InsertaArchivo($datos_archivo);
            redirect('/Cont_empresa/VerOrdenComp/'.$this->input->post("idorden").'', 'location', 301);
            
        } else {
            echo "Ha ocurrido un error en la subida del archivo ".$_FILES['uploadedfile']['name'];
        }
    }
    
    /**
     * Verifica si los datos que coge por post del formulario son correctos y si es asi llama al modelo para que
     * los inserte en la bbdd
     */
    public function VerificaDatosEmpresa()
        {
             $this->CargaReglas();

            if   ($this->form_validation->run() == FALSE)
                {
                    $this->CargaPlantilla(
                            $this->load->view('reg_empresa',"",TRUE));
                }
                else 
                {
                    $datosemp= array(
                        'nomempresa'=>$this->input->post('nombreemp'),                        
                        'cif'=>$this->input->post('cif'),
                        'emailcontacto'=>$this->input->post('correo'),
                        'numcontacto'=>$this->input->post('numcon'));
                    
                    $this->Model_emp->AltaEmp($datosemp);
                    redirect('/Cont_empresa/VerEmpresa', 'location', 301);
                }
        }    
    
    /**
     * Recibe el cuerpo y el encabezado y llama a la vista principal pasandole esos parametros
     * @param type $cuerpo
     * @param type $encabezado
     */    
    protected function CargaPlantilla($cuerpo='',$encabezado="") {
            $this->load->view('vista_principal',array(
                'cuerpo'=>$cuerpo,
                'encabezado'=>$encabezado
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
    public function CargaReglasmod()
        {
                $this->form_validation->set_rules('nombreemp','Nombre de empresa','required');
                $this->form_validation->set_rules('correo', 'Email', 'required|valid_email');
                $this->form_validation->set_rules('cif','cif','required|min_length[9]|max_length[9]');
               
        }
    
    /**
     * Reglas para la validacion al registrar una empresa
     */    
    public function CargaReglas()
        {
                $this->form_validation->set_rules('nombreemp','Nombre de empresa','required');
                $this->form_validation->set_rules('correo', 'Email', 'required|valid_email');
                $this->form_validation->set_rules('cif','cif','required|min_length[9]|max_length[9]|callback_CompCif');
        }
        
        /**
         * realiza una llamada a la base datos pasandole un cif, que recoge por post, para saber si ese cif existe
         * @return boolean
         */
        public function CompCif() {
            $existecif=$this->Model_emp->CompruebaCif($this->input->post('cif'));
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
        $this->pdf->ExportaPdf($orden);
        if ($this->Model_emp->Numarchivosxorden($idorden) > 0) {
            //Descarga archivos
            $this->BorraArchivosOrden($idorden);
        }
        
        
        //$this->Model_emp->BorraOrden($idorden);
    }
    /**
     * Recibe una id de una orden y elimina los archivos que tenga dicha orden asi como su existencia en la bbdd
     * @param type $idorden
     */
    public function BorraArchivosOrden($idorden) {
            $archivos = $this->Model_emp->ArchivosXOrden($idorden);
            echo "<pre>";
            print_r($archivos);
            echo "</pre>";
            foreach ($archivos as $archivo) {
                $file = "C:\\xampp\htdocs\Clientes_Publibit\archivos\\" . $archivo['nomarchivo'];
                $do = unlink($file);//elimina archivo
                $this->Model_emp->Borraarchivo($archivo['nomarchivo']);//elimina datos del archivo de la BBDD

                if ($do != true) {
                    echo "Hay un error en la descarga de " . $archivo['nomarchivo'] . "<br />";
                }
            }
    }

}