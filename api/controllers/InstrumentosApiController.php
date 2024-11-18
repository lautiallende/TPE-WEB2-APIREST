<?php
require_once 'views/json.view.php';
require_once 'models/InstrumentosModel.php';

class InstrumentosController {
    private $model;
    private $view;

    public function __construct(){
        $this->model = new InstrumentosModel();
        $this->view = new JSONView();
    }

    public function getAllInstrumentos($req, $res) {
        $marca = false;
        if(isset($req->query->marca)){
            $marca = $req->query->marca;
        }

        $orderBy = false;
        if(isset($req->query->orderBy)){
            $orderBy = $req->query->orderBy;
        }

        $Direction = false;
        if(isset($req->query->Direction)){
            $Direction = $req->query->Direction;
        }

        $instrumentos = $this->model->getInstrumentos($marca, $orderBy, $Direction);

        if(!$instrumentos){
            return $this->view->response("No hay instrumentos para mostrar", 404);
        }

        return $this->view->response($instrumentos);
    }

    public function getInstrumento($req, $res){
        $id = $req->params->id;

        $instrumento = $this->model->getInstrumento($id);

        if(!$instrumento) {
            return $this->view->response("El instrumento con el id=$id no existe", 404);
        }

        return $this->view->response($instrumento);
    }

    public function delete($req, $res){
        if($res->user == null) {
            return $this->view->response("No autorizado", 401);
        }

        $id = $req->params->id;

        $instrumento = $this->model->getInstrumento($id);
        if(!$instrumento) {
            return $this->view->response("El instrumento con el id=$id no existe", 404);
        }

        $this->model->deleteInstrumento($id);
        $this->view->response("El instrumento con el id= $id se eliminó con éxito");
    }

    public function create($req, $res){
        if($res->user == null) {
            return $this->view->response("No autorizado", 401);
        }

        if(empty($req->body->instrumento) || empty($req->body->precio) || empty($req->body->stock) || empty($req->body->ID_MARCAS)){
            return $this->view->response('Faltan completar campos', 400);
        }

        $instrumento = $req->body->instrumento;
        $precio = $req->body->precio;
        $stock = $req->body->stock;
        $ID_MARCAS = $req->body->ID_MARCAS;

        $id = $this->model->insertInstrumento($instrumento, $tipo, $stock, $ID_MARCAS);

        if(!$id){
            return $this->view->response('Error al agregar instrumento', 500);
        }

        $instrumento = $this->model->getInstrumento($id);
        return $this->view->response($instrumento, 201);
    }

    public function edit($req, $res){
        if($res->user == null) {
            return $this->view->response("No autorizado", 401);
        }

        $id = $req->params->id;

        $instrumento = $this->model->getInstrumento($id);
        if(!$instrumento){
            return $this->view->response("El instrumento con el id=$id no existe", 404);
        }

        if(empty($req->body->instrumento) || empty($req->body->precio) || empty($req->body->stock)){
            return $this->view->response('Faltan completar campos', 400);
        }

        $instrumento = $req->body->instrumento;
        $precio = $req->body->precio;
        $stock = $req->body->stock;

        $this->model->editar($id, $instrumento, $precio, $stock);

        $instrumento = $this->model->getInstrumento($id);
        $this->view->response($instrumento, 200); 
    }
}
?>