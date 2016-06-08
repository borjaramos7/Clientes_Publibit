<?php

/**
 * Modelo para las llamadas a la base de datos relacionadas con spots
 */
class Model_spot extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Recibe los datos de un nuevo spot y lo registra en la base de datos
     * @param type $newspot
     */
    public function AltaSpot($newspot) {
        $this->db->insert('spot', $newspot);
    }
    
    public function BorrarSpot($idspot){
        $query = "delete from spotxpantalla where _idspot=" . $idspot;
        $this->db->query($query);
        $query = "delete from spot where idspot=" . $idspot;
        $this->db->query($query);
    }
    
    public function BorraAsoc($idasoc) {
        $query2="select _idspot from spotxpantalla where idspotxpant=".$idasoc;
        $idspot=$this->db->query($query2);
        $query = "delete from spotxpantalla where idspotxpant=".$idasoc;
        $this->db->query($query);
        
        return $idspot->row()->_idspot;
    }
    
    /**
     * recibe la id de un cliente y devuelve el numero de spots que tiene contratados
     * @param type $idcli
     * @return type
     */
    public function NumSpots($idcli) {
        $query = "select count(*) as 'total' from spot where _idcliente= " . $idcli . "";
        $numspots = $this->db->query($query);
        return $numspots->row()->total;
    }

    /**
     * Recibe la id de una empresa y saca los spots que tenga dicha empresa
     * @param type $idemp
     * @return type
     */
    public function SpotsXEmp($idemp) {
        $query = "select * from spot where _idcliente= " . $idemp;
        $spotxemp = $this->db->query($query);
        return $spotxemp->result_array();
    }
    
    /**
     * Recibe la id de una pantalla y elimina de la BBDD sus spots asociados y posteriormente los datos de la pantalla
     * @param type $idpant
     */
    public function BorraPant($idpant) {
        $query = "delete from spotxpantalla where _idpantalla=" . $idpant;
        $this->db->query($query);
        $query = "delete from pantalla where idpantalla=" . $idpant;
        $this->db->query($query);
    }
    
    /**
     * recibe la id de un spot y devuelve todos sus datos
     * @param type $idspot
     * @return type
     */
    public function SacaSpot($idspot) {
        $query = "select * from spot where idspot= " . $idspot;
        $spot = $this->db->query($query);
        return $spot->row_array();
    }

    /**
     * 
     * @param type $nuevosdatos
     * @param type $idspot
     */
    public function ModSpot($nuevosdatos, $idspot) {
        $this->db->where('idspot', $idspot);
        $this->db->update('spot', $nuevosdatos);
    }

    /**
     * Funcion que saca los datos de las provincias para el registro de las pantallas
     * @return type
     */
    public function SacaProv() {
        $query = "select * from tbl_provincias";
        $prov = $this->db->query($query);
        return $prov->result_array();
    }

    /**
     * Recibe los datos de una nueva pantalla y los inserta
     * @param type $datospant
     */
    public function AddPant($datospant) {
        $this->db->insert('pantalla', $datospant);
    }

    /**
     * devuelve un array con los datos de las pantallas
     * @return type
     */
    public function SacaPantallas() {
        $query = "select * from pantalla";
        $pant = $this->db->query($query);
        return $pant->result_array();
    }

    /**
     * Recibe los datos de un spot en una pantalla y lo inserta en la BBDD
     * @param type $datossxp
     */
    public function NuevoSpotXPant($datossxp) {
        $this->db->insert('spotxpantalla', $datossxp);
    }

    /**
     * Devuelve los spots activos en el momento de realizar la consulta
     * @return type
     */
    public function SpotsActivos() {
        $query = "select * from spot where idspot in (select _idspot from spotxpantalla where activo='si')";
        $spotsactivos = $this->db->query($query);
        return $spotsactivos->result_array();
    }

    /**
     * Recibe la id de un spot y devuelve las pantallas donde se esta visionando ese spot
     * @param type $idspot
     * @return type
     */
    public function PantallasDeSpot($idspot) {
        $query = "select * from pantalla where idpantalla in "
                . "(select _idpantalla from spotxpantalla where _idspot='" . $idspot . "')";
        $pantalla = $this->db->query($query);
        return $pantalla->result_array();
    }

    /**
     * Recibe la id de una pantalla y devuelve los spots de esa pantalla
     * @param type $idpant
     * @return type
     */
    public function SacaSpotsDePant($idpant) {
        $query = "select * from spot where idspot in "
                . "(select _idspot from spotxpantalla where _idpantalla='" . $idpant . "' and activo='si')";
        $spots = $this->db->query($query);
        return $spots->result_array();
    }
    
    public function Asociacion ($idspot,$idpantalla) {
        $query = "select * from spotxpantalla where _idspot=".$idspot." and _idpantalla=".$idpantalla;
        $asoc=$this->db->query($query);
        return $asoc->row_array();
    }
    
    public function HayAvisos(){
        $query = "select count(*) as 'total' from spotxpantalla where fechafin-curdate()<10";
        $numavisos = $this->db->query($query);
        return $numavisos->row()->total;
    }
    
    public function SpotsFinalizando(){
        $query = "select * from spot where idspot in ( "
                . "select _idspot from spotxpantalla where fechafin-curdate()<10 order by fechafin desc)";
        $spotsfin = $this->db->query($query);
        return $spotsfin->result_array();
    }
    
    public function PantallasDeSpotFin($idspot) {
        $query = "select localidad from pantalla where idpantalla in "
                . "(select _idpantalla from spotxpantalla s where _idspot=" . $idspot . " and fechafin-curdate()<10)";
        $pantalla = $this->db->query($query);
        return $pantalla->result_array();
    }
    
}
