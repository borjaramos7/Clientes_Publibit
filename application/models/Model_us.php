<?php
class Model_us extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
        
    public function AltaUsuario($newusuario){
    $this->db->insert('usuario', $newusuario); 
    }
    
    public function CompUser($usuario,$contr) {  
            $query="select count(*) as 'total' from usuario where nombreus= '".$usuario."' and contrasena= '".$contr."'"
                    . " and estado='ok'";
            $usuarioexiste=$this->db->query($query);
            $a=$usuarioexiste->row();
            $a=(array)$a;
            if ($a['total']==1)
                return true;
            else return false;
        }
        
    public function BajaUsuario() {
        $query = "UPDATE usuario SET estado='baja' where nombreus= '" . $this->session->userdata('username') . "'";
        $this->db->query($query);
    }
    
    public function SacaIdUser($nomuser) {
             $query="select iduser from usuario where nombreus= '".$nomuser."'";
             $idusuario=$this->db->query($query);
             return $idusuario->row()->iduser;
        }
        
    public function CompNombreUser($usuario) {
            
            $query="select count(*) as 'total' from usuario where nombreus= '".$usuario."'";
            $usuarioexiste=$this->db->query($query);
            $a=$usuarioexiste->row();
            $a=(array)$a;
            if ($a['total']==1)
                return true;
            else return false;
        }
        
    public function SacaUsuario($usuario){
            $query="select * from usuario where nombreus= '".$usuario."' and estado='ok'";
            $resuser=$this->db->query($query);
            return $resuser->result();
        }
        
    public function ModificaUsuario($nuevosdatos) {
            $this->db->where('nombreus',$this->session->userdata('username'));
            $this->db->update('usuario', $nuevosdatos); 
        }
    
    public function SacaEmailUser($nomuser) {
             $query="select correo from usuario where nombreus= '".$nomuser."'";
             $emailusuario=$this->db->query($query);
             return $emailusuario->row()->correo;
        }
}



