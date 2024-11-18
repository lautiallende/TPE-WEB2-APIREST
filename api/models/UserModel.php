<?php
require_once 'models/model.php';

class UserModel extends model{
    public function mostrarporusuario($email) {    
        $query = $this->db->prepare("SELECT * FROM usuarios WHERE email = ?");
        $query->execute([$email]);
        $user = $query->fetch(PDO::FETCH_OBJ);
        
        return $user;
    }  
}
?>