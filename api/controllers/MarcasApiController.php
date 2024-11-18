<?php
require_once 'models/MarcaModel.php';
require_once 'views/json.view.php';

class MarcasController {
    private $model;
    private $view;

    public function __construct() {
        $this->model = new MarcaModel();
        $this->view = new JSONView();
    }

    // /api/marcas (GET)
    public function getAll($req, $res) {

        $marcas = $this->model->getAllMarcas();

        return $this->view->response($marcas);
    }

    // /api/marcas/:id (GET)
    public function get($req, $res) {
        $id = $req->params->id;

        $marca = $this->model->getMarca($id);

        if (!$marca) {
            return $this->view->response("La marca con el id=$id no existe", 404);
        }

        return $this->view->response($marca);
    }

    // /api/marcas (POST)
    public function create($req, $res) {

        if($res->user == null) {
            return $this->view->response("No autorizado", 401);
        }

        $nuevaMarca = $req->body;

        if(empty($nuevaMarca->nombre_de_marca) || empty($nuevaMarca->direccion)){
            return $this->view->response("Faltan completar datos", 400);
        }

        $nombre_de_marca = $nuevaMarca->nombre_de_marca;
        $direccion = $nuevaMarca->direccion;
        $add = $this->model->createMarca($nombre_de_marca,$direccion);

        if (!add) {
            return $this->view->response("Ocurrio un problema al agregar una marca", 500);
        }
        return $this->view->response("La marca se creo con éxito.", 201);
    }

    // /api/marcas/:id (PUT)
    public function update($req, $res) {

        if($res->user == null) {
            return $this->view->response("No autorizado", 401);
        }
        $id = $req->params->id;

        $nuevaMarca = $req->body;

        if(empty($nuevaMarca->nombre_de_marca) || empty($nuevaMarca->direccion)){
            return $this->view->response("Faltan completar datos", 400);
        }

        $nombre_de_marca = $nuevaMarca->nombre_de_marca;
        $direccion = $nuevaMarca->direccion;

        $marcaActualizada = $this->model->updateMarca($nombre_marca, $id, $direccion);

        if (!$marcaActualizada) {
            return $this->view->response("La marca con el id=$id no existe", 404);
        }

        return $this->view->response("La marca: $marcaActualizada, se ha actualizado con éxito ", 200);
    }

    // /api/marcas/:id (DELETE)
    public function delete($req, $res) {
        $id = $req->params->id;

        $deleted = $this->model->deleteMarca($id);

        if (!$deleted) {
            return $this->view->response("La marca con el id=$id no existe", 404);
        }

        return $this->view->response("Marca con id=$id eliminada", 200);
    }
}
?>
