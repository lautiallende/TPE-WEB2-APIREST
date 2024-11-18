<?php
    require_once 'models/Model.php';

    class InstrumentosModel extends Model{

        public function getInstrumentos($marca = false, $orderBy = false, $Direction = false){
            $sql = "SELECT * FROM instrumentos";

            if($marca){
                $sql .= " WHERE `ID_MARCAS` = ?";
            }

            if($orderBy){
                switch($orderBy){
                    case 'id':
                        $sql .= ' ORDER BY `id`';
                        break;
                    case 'precio':
                        $sql .= ' ORDER BY `precio`';
                        break;
                    case 'stock':
                        $sql .= ' ORDER BY `stock`';
                        break;
                    case 'ID_MARCAS':
                        $sql .= ' ORDER BY `ID_MARCAS`';
                        break;
                }
            }

            if($Direction == 'DESC'){
                $sql .= " DESC";
            }

            $query = $this->db->prepare($sql);
            
            if($marca){
                $query->execute([$marca]);
            } else {
                $query->execute();
            }
            
            $instrumentos = $query->fetchAll(PDO::FETCH_OBJ); 
    
            return $instrumentos;
        }

        public function getInstrumento($id){
            $sql = 'SELECT * FROM instrumentos WHERE id = ?';

            $query = $this->db->prepare($sql);
            $query->execute([$id]);

            $instrumento = $query->fetch(PDO::FETCH_OBJ); 
            
            return $instrumento;
        }

        public function deleteInstrumento($id){
            $sql = 'DELETE FROM instrumentos WHERE id=?';

            $query = $this->db->prepare($sql);
            $query->execute([$id]);
        }

        public function create($instrumento, $precio, $stock){
            $sql = 'INSERT INTO instrumentos(instrumento, precio, stock) VALUES (?, ?, ?)';

            $query = $this->db->prepare($sql);
            $query->execute([$instrumento, $precio, $stock]);

            $id = $this->db->lastInsertId();

            return $id;
        }

        public function editar($id, $instrumento, $precio, $stock){
            $sql = 'UPDATE instrumentos SET instrumento = ?, precio = ?, stock = ? WHERE id = ?';

            $query = $this->db->prepare($sql);
            $query->execute([$instrumento, $precio, $stock, $id]);
        }
    }

?>