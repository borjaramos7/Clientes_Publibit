<?php

/**
 * En este controlador estan las funciones relacionadas con la gestion de usuarios 
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Cont_user extends CI_Controller {

    public function index() {
        $this->CargaPlantilla();
    }

    /**
     * Llama a la vista donde esta el formulario de registro
     */
    public function Registro() {
        $this->CargaPlantilla(
                $this->load->view('reg_user', "", TRUE), "Datos de registro");
    }

    /**
     * Llama a la vista de logueo, en caso de error en el logueo le pasa un mensaje de error. 
     * @param type $error
     */
    public function Login($error = "") {
        $this->CargaPlantilla(
                $this->load->view('login', array(
                    'error' => $error), TRUE), "Introduce tus datos de usuario");
    }

    protected function CargaPlantilla($cuerpo = '', $encabezado = "") {
        $this->load->view('vista_principal', array(
            'cuerpo' => $cuerpo,
            'encabezado' => $encabezado
        ));
    }

    /**
     * Funcion encargada de filtrar los datos introducidos en el formulario de registro y en caso de que no haya error
     * de inseertarlo en la BBDD.
     */
    public function VerificaDatosUsuario() {
        $this->CargaReglas();

        if ($this->form_validation->run() == FALSE) {
            $this->CargaPlantilla(
                    $this->load->view('reg_user', "", TRUE));
        } else {
            $cont_encrip = md5($this->input->post('pass'));
            $datosuser = array(
                'nombreus' => $this->input->post('nombreuser'),
                'contrasena' => $cont_encrip,
                'nombre' => $this->input->post('nombre'),
                'apellidos' => $this->input->post('apellidos'),
                'correo' => $this->input->post('correo'),
                'estado' => 'ok');

            $this->Model_us->AltaUsuario($datosuser);
            redirect('', 'location', 301);
        }
    }
    
    /**
     * direcciona ala vista de inicio
     */
    public function Irinicio() {
        $this->CargaPlantilla(
                $this->load->view('inicio', "", TRUE));
    }
    
    /**
     * Carga las reglas de validacion del registro de usuarios
     */
    public function CargaReglas() {
        $this->form_validation->set_rules('nombre', 'nombre', 'required');
        $this->form_validation->set_rules('apellidos', 'apellidos', 'required');
        $this->form_validation->set_rules('nombreuser', 'Nombre de usuario', 'required|callback_CompExisteNombreus');
        $this->form_validation->set_rules('correo', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('clave', 'clave registro', 'required|callback_ClaveReg');
        $this->form_validation->set_rules('pass', 'Contraseña', 'required|matches[repass]');
        $this->form_validation->set_rules('repass', 'Confirmar Contraseña', 'required');

        $this->form_validation->set_message('required', 'El campo %s no puede estar vacio');
        $this->form_validation->set_message('CompExisteNombreus', 'Ese nombre de usuario ya existe');
        $this->form_validation->set_message('ClaveReg', 'Se necesita conocer la clave de publibit para registrarse');
        $this->form_validation->set_message('valid_email', 'El email no tiene el formato correcto');
    }

    /**
     * Llama al modelo para que compruebe si el usuario y contraseña introducidos son correctos
     * en caso de que sean incorrectos llama a Login pasandole el error para que lo muestre al usuario.
     */
    public function VerificaLogin() {
        $contr_login = md5($this->input->post('cont'));
        $existe = $this->Model_us->CompUser(
                $this->input->post('user'), $contr_login
        );

        if ($existe) {
            $newdata = array(
                'username' => $this->input->post('user'),
                'logged_in' => TRUE,
                'id' => $this->Model_us->SacaIdUser($this->input->post('user')),
                'correo' => $this->Model_us->SacaEmailUser($this->input->post('user'))
            );
            $this->session->set_userdata($newdata);

            redirect('Cont_user/IrInicio', 'location', 301);
        } else
            $this->Login("Usuario o contraseña incorrectos");
    }

    /**
     * Destruye la sesion
     */
    public function LogOut() {
        $this->session->sess_destroy();
        redirect('', 'location', 301);
    }

    /**
     * Cambia el estado del usuario a dado de baja
     */
    public function DarBajaUsuario() {
        $this->Model_us->BajaUsuario();
        $this->LogOut();
    }

    /**
     * Comprueba si el nombre de usuario con el que intenta registrarse ya esta en la BBDD.
     * @return boolean
     */
    public function CompExisteNombreus() {
        $existenombre = $this->Model_us->CompNombreUser($this->input->post('nombreuser'));
        $this->form_validation->set_message('CompExisteNombreus', 'El nombre de usuario ya existe');

        if ($existenombre) {
            return false;
        } else
            return true;
    }

    public function ClaveReg() {
        if ($this->input->post('clave') == 'publibit')
            return true;
        else
            return false;
    }

    /**
     * Carga los datos del usuario para mostralos a la hora de modificarlos.
     */
    public function CargaDatosUs() {
        $user = $this->Model_us->SacaUsuario($this->session->userdata('username'));
        $this->CargaPlantilla($this->load->view('Mod_user', array(
                    'usuarios' => $user), TRUE), "Datos de " . ($this->session->userdata('username')));
    }

    /**
     * Comprueba que los datos modificados cumplen con las reglas de filtrado, si las cumplen las inserta en la BBDD.
     */
    public function VerificaDatosUsuarioMod() {
        $this->CargaReglasMod();

        if ($this->form_validation->run() == FALSE) {
            $this->CargaDatosUs();
        } else {
            $datosuser = array(
                //'contrasena'=>$this->input->post('pass'),
                'nombre' => $this->input->post('nombre'),
                'apellidos' => $this->input->post('apellidos'),
                'correo' => $this->input->post('correo'),
                'estado' => 'ok');

            $this->Model_us->ModificaUsuario($datosuser);
            redirect('Cont_user/IrInicio', 'location', 301);
        }
    }

    /**
     * Reglas de validacion para el modificado de usuarios
     */
    public function CargaReglasMod() {
        $this->form_validation->set_rules('nombre', 'nombre', 'required');
        $this->form_validation->set_rules('apellidos', 'apellidos', 'required');
        //$this->form_validation->set_rules('dni','dni','required|callback_CompDni');
        $this->form_validation->set_rules('correo', 'Email', 'required|valid_email');
        //$this->form_validation->set_rules('pass', 'Contraseña', 'required|matches[repass]');
        //$this->form_validation->set_rules('repass', 'Confirmar Contraseña', 'required');
    }

}
