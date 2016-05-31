<?php

/**
 * Modelo para las llamadas a la base de datos relacionadas con clientes y trabajos
 */
class Model_emp extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Recibe los datos de una nueva empresa e inserta estos datos en la BBDD
     * @param type $newemp
     */
    public function AltaEmp($newemp) {
        $this->db->insert('cliente', $newemp);
    }

    /**
     * Funcion que lista los datos de las empresas y los devuelve agrupados para paginar con los datos que recibe.
     * @param type $limit
     * @param type $start
     * @return type
     */
    public function ListaEmp($limit, $start) {
        //$this->db->limit($limit,$start);
        $query = "select * from cliente order by nomempresa LIMIT " . $start . "," . $limit;
        
        $listacliente = $this->db->query($query);
        return $listacliente->result_array();
    }
    
    public function ListaEmpXPend($limit, $start) {//Where para mostrar solo pendientes
        $query = "select * from cliente where idcliente in "
                . "(select _idcliente from trabajo where idtrabajo in ("
                . "select idtrabajo from trabajo where estado='pendiente' group by _idcliente))"
                . " LIMIT " . $start . "," . $limit;
        $listacliente = $this->db->query($query);
        return $listacliente->result_array();
    }

    /**
     * Recibe la id de una empresa y devuelve el numero de trabajos pendientes que tiene dicha empresa.
     * @param type $idcli
     * @return type
     */
    public function NumPendientes($idcli) {
        $query = "select count(*) as 'total' from trabajo where estado='pendiente' and _idcliente= " . $idcli . "";
        $numpend = $this->db->query($query);
        return $numpend->row()->total;
    }

    /**
     * Recibe la id de una empresa y devuelve el total de trabajos que tiene esa empresa, ya sea finalizados o pendientes
     * @param type $idcli
     * @return type
     */
    public function NumTrabajos($idcli) {
        $query = "select count(*) as 'total' from trabajo where _idcliente= " . $idcli . "";
        $numtra = $this->db->query($query);
        return $numtra->row()->total;
    }
    
    public function BuscaPorDen($texto){
        $query = "select * from trabajo where denominacion LIKE '%" . $texto . "%' order by denominacion";
        $listaordenes = $this->db->query($query);
        return $listaordenes->result_array();
    }
    
    /**
     * Recibe los datos de una nueva orden y los inserta en la BBDD
     * @param type $orden
     */
    public function NuevaOrden($orden) {
        $this->db->insert('trabajo', $orden);
    }

    /**
     * recibe la id de una orden y devuelve todos sus datos
     * @param type $idorden
     * @return type
     */
    public function SacaOrden($idorden) {
        $query = "select * from trabajo where idtrabajo= " . $idorden;
        $orden = $this->db->query($query);
        return $orden->row_array();
    }

    /**
     * Recibe la id de un trabajo asi como sus nuevos datos y los actualiza
     * @param type $nuevosdatos
     * @param type $idtrabajo
     */
    public function ModOrden($nuevosdatos, $idtrabajo) {
        //echo "<pre>".print_r($nuevosdatos)."<pre>";
        $this->db->where('idtrabajo', $idtrabajo);
        $this->db->update('trabajo', $nuevosdatos);
    }

    /**
     * Recibe la id de una empresa asi como sus nuevos datos y los actualiza 
     * @param type $nuevosdatos
     * @param type $idcli
     */
    public function ModEmp($nuevosdatos, $idcli) {
        $this->db->where('idcliente', $idcli);
        $this->db->update('cliente', $nuevosdatos);
    }

    /**
     * Recibe la id de una empresa y devuelve los datos de los trabajos que tenga esa empresa
     * @param type $idemp
     * @return type
     */
    public function TrabajosXEmp($idemp) {
        $query = "select * from trabajo where _idcliente= " . $idemp;
        $trabxemp = $this->db->query($query);
        return $trabxemp->result_array();
    }

    /**
     * Recibe la id de una empresa y saca su nombre.
     * @param type $idemp
     * @return type
     */
    public function SacaNombreCliente($idemp) {
        $query = "select nomempresa from cliente where idcliente=" . $idemp;
        $nomcli = $this->db->query($query);
        return $nomcli->row()->nomempresa;
    }

    /**
     * Recibe la id de una orden y cambia su estado a finalizada.
     * @param type $id
     */
    public function EndOrden($id) {
        $query = "UPDATE trabajo SET estado='finalizada' where idtrabajo=" . $id;
        $this->db->query($query);
    }

    /**
     * Devuelve las ordenes que esten pendientes de realizar
     * @return type
     */
    public function OrdenesPend() {
        $query = "select * from trabajo where estado='pendiente'";
        $trabpend = $this->db->query($query);
        return $trabpend->result_array();
    }

    /* public function InsertaEnlace($enlace,$id) {
      $query="UPDATE trabajo SET archivoadjunto='".$enlace."' where idtrabajo=".$id;
      $this->db->query($query);
      } */

    /**
     * Recibe el cif que se introduce al registrar una nueva empresa y devuelve si esta ya registrado o no mediante 
     * un booleano
     * @param type $cif
     * @return boolean
     */
    public function CompruebaCif($cif) {
        $query = "select count(*) as 'total' from cliente where cif= '" . $cif . "'";
        $cifexiste = $this->db->query($query);
        $a = $cifexiste->row();
        $a = (array) $a;
        if ($a['total'] == 1)
            return true;
        else
            return false;
    }

    /**
     * Recibe los datos de un archivo y lo inserta en la base de datos.
     * @param type $datosar
     */
    public function InsertaArchivo($datosar) {
        $this->db->insert('archivo', $datosar);
    }

    /**
     * Recibe el nombre de un archivo y elimina todos sus datos en la bbdd
     * @param type $nombrear
     */
    public function Borraarchivo($nombrear) {
        $query = "delete from archivo where nomarchivo='" . $nombrear . "'";
        $this->db->query($query);
    }

    /**
     * Recibe la id de un trabajo y devuelve los archivos que tenga ese trabajo en concreto
     * @param type $idorden
     * @return type
     */
    public function ArchivosXOrden($idorden) {
        $query = "select * from archivo where _idtrabajo= " . $idorden;
        $archivos = $this->db->query($query);

        return $archivos->result_array();
    }

    /**
     * Recibe la id de una orden y devuelve el numero de archivos que tiene dicha orden
     * @param type $idorden
     * @return type
     */
    public function Numarchivosxorden($idorden) {
        $query = "select count(*) as 'total' from archivo where _idtrabajo=" . $idorden;
        $numarch = $this->db->query($query);
        return $numarch->row()->total;
    }

    /**
     * recibe el nombre del archivo que vas a subir y si ya existe lo renombre con una clave numerica
     * @param type $nombrear
     * @return type
     */
    public function CompNombreArch($nombrear) {
        $query = "select count(*) as 'total' from archivo where nomarchivo='" . $nombrear . "'";
        $numarch = $this->db->query($query);
        return $numarch->row()->total;
    }

    /**
     * recibe la id de un trabajo y devuelve la id del cliente que lo encargo.
     * @param type $idorden
     * @return type
     */
    public function SacaIdClienteXTrab($idorden) {
        $query = "select _idcliente from trabajo where idtrabajo= " . $idorden;
        $idcli = $this->db->query($query);
        return $idcli->row()->_idcliente;
    }

    /**
     * Recibe una id de empresa y devuelve todos sus datos
     * @param type $idcli
     * @return type
     */
    public function SacaEmpresa($idcli) {
        $query = "select * from cliente where idcliente= " . $idcli;
        $datosemp = $this->db->query($query);
        return $datosemp->row_array();
    }

    /**
     * Devuelve el total de clientes 
     * @return type
     */
    public function TotalClientes() {
        $query = "select count(*) as 'total' from cliente";
        $total = $this->db->query($query);
        return $total->row()->total;
    }
    /**
     * Funcion que calcula el total de empresas que tienen alguna orden pendiente
     * @return type
     */
    public function TotalPendientes() {
        $query = "select count(*) as 'total' from cliente where idcliente in"
                    . "(select _idcliente from trabajo where "
                        . "(select count(*) as 'totalpen' from trabajo where estado='pendiente')>0) group by 'total'";
        $total = $this->db->query($query);
        return $total->row()->total;
    }
    
    /**
     * Recibe un conjunto de caracteres que sera los que busque en la el campo "nomempresa" para devolver las 
     * filas que coincidan
     * @param type $q
     * @return type
     */
    public function Buscador($q) {
        $query = "select * from cliente where nomempresa LIKE '%" . $q . "%' order by nomempresa";
        $listaclientebus = $this->db->query($query);
        return $listaclientebus->result_array();
    }

    /**
     * Recibe la id de una orden de trabajo y la elimina de la BBDD
     * @param type $idorden
     */
    public function BorraOrden($idorden) {
        $query = "delete from trabajo where idtrabajo=" . $idorden;
        $this->db->query($query);
    }

}
