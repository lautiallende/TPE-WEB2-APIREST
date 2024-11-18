<?php
require_once 'models/model.php';

class MarcaModel extends model{

function getAllMarcas() {
    $sentencia=$this->db->prepare("SELECT * FROM marcas_de_instrumento");
    $sentencia->execute();
    $marcas=$sentencia->fetchAll(PDO::FETCH_OBJ);
    
    return $marcas;
}

function createMarca($marca,$direccion){
    $sentencia=$this->db->prepare("INSERT INTO marcas_de_instrumento(nombre_de_marca,direccion)VALUES(?,?)");
    $sentencia->execute([$marca,$direccion]);

    return $this->db->lastInsertId();
}

function deleteMarca($id){
    $sentencia=$this->db->prepare("DELETE FROM marcas_de_instrumento WHERE ID_MARCAS=?");
    $sentencia->execute(array($id));
}

function updateMarca($nuevonombre, $id, $direccion) {
    if (isset($nuevonombre) && isset($id)) {
        try {
            $sentencia = $this->db->prepare("UPDATE marcas_de_instrumento SET nombre_de_marca = ?, direccion = ? WHERE ID_MARCAS = ?");
            $sentencia->execute([$nuevonombre, $direccion, $id]);
            
            return $this->view-response("Actualización exitosa.", 200);
        } catch (PDOException $e) {
            return $this->view->response("No se pudo actualizar la marca con id=$id.", );
        }
    }
}
public function getMarca($id) { 
    $query = $this->db->prepare("SELECT * FROM marcas_de_instrumento WHERE ID_MARCAS = ?");
    $query->execute([$id]);
    
    $itemspormarca=$query->fetch(PDO::FETCH_OBJ);
    
    return $itemspormarca;
}
}
?>