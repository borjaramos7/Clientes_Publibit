<?php

/**
 * Modelo para las funciones que interaccionen principalmente con la tabla usuario
 */
class Model_us extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Recibe los datos de un nuevo usuario y los inserta en la bbdd
     * @param type $newusuario
     */
    public function AltaUsuario($newusuario) {
        $this->db->insert('usuario', $newusuario);
    }
    
    public function Login($usuario,$contr) {
        if ($this->CompUser($usuario, $contr)){
            $newdata = array(
                'username' => $this->input->post('user'),
                'logged_in' => TRUE,
                'id' => $this->Model_us->SacaIdUser($this->input->post('user')),
                'correo' => $this->Model_us->SacaEmailUser($this->input->post('user'))
            );
            $this->session->set_userdata($newdata);
            return true;
        }
        else return false;
    }
    
    public function EstaDentro() {
        return $this->session->userdata("logged_in");
    }
    
    public function Logout() {
        $this->session->set_userdata("logged_in",false);
    }
    
    /**
     * Recibe un nombre de usuario y una contraseña y devuelve un booleano en funcion de si coinciden en la bbdd o no.
     * @param type $usuario
     * @param type $contr
     * @return boolean
     */
    public function CompUser($usuario, $contr) {
        $query = "select count(*) as 'total' from usuario where nombreus= '" . $usuario . "' and contrasena= '" . $contr . "'"
                . " and estado='ok'";
        $usuarioexiste = $this->db->query($query);
        $a = $usuarioexiste->row();
        $a = (array) $a;
        if ($a['total'] == 1)
            return true;
        else
            return false;
    }

    /**
     * Cambia el estado a "baja" del usuario que en ese momento este registrado en la sesion
     */
    public function BajaUsuario() {
        $query = "UPDATE usuario SET estado='baja' where nombreus= '" . $this->session->userdata('username') . "'";
        $this->db->query($query);
    }

    /**
     * Recibe el nombre de un usuario y devuelve su id
     * @param type $nomuser
     * @return type
     */
    public function SacaIdUser($nomuser) {
        $query = "select iduser from usuario where nombreus= '" . $nomuser . "'";
        $idusuario = $this->db->query($query);
        return $idusuario->row()->iduser;
    }

    /**
     * Recibe e nombre de un usuario y comprueba en la bbdd si existe
     * @param type $usuario
     * @return boolean
     */
    public function CompNombreUser($usuario) {

        $query = "select count(*) as 'total' from usuario where nombreus= '" . $usuario . "'";
        $usuarioexiste = $this->db->query($query);
        $a = $usuarioexiste->row();
        $a = (array) $a;
        if ($a['total'] == 1)
            return true;
        else
            return false;
    }

    /**
     * Recibe un nombre de usuario y saca todos sus datos siempre y cuando su estado sea "ok"
     * @param type $usuario
     * @return type
     */
    public function SacaUsuario($usuario) {
        $query = "select * from usuario where nombreus= '" . $usuario . "' and estado='ok'";
        $resuser = $this->db->query($query);
        return $resuser->result();
    }

    /**
     * Recibe los datos ya modificados de un usuario y los actualiza en la bbdd
     * @param type $nuevosdatos
     */
    public function ModificaUsuario($nuevosdatos) {
        $this->db->where('nombreus', $this->session->userdata('username'));
        $this->db->update('usuario', $nuevosdatos);
    }

    /**
     * Recibe el nombre de usuario y devuelve su email
     * @param type $nomuser
     * @return type
     */
    public function SacaEmailUser($nomuser) {
        $query = "select correo from usuario where nombreus= '" . $nomuser . "'";
        $emailusuario = $this->db->query($query);
        return $emailusuario->row()->correo;
    }

}
