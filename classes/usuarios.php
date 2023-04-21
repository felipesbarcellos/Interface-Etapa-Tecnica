<?php 

class Usuario{
    private $pdo;
    public $msgErro = "";

    //criar conexão com o banco de dados
    public function conectar($nome, $host, $usuario, $senha){
        try {
            global $pdo;
            $pdo = new PDO("mysql:dbname=".$nome.";host=".$host,$usuario,$senha);
        } catch (PDOException $e) {
            $msgErro = $e -> getMessage();
        }
    }

    //enviar nome e email para banco de dados
    public function cadastrar($nome, $email){
        global $pdo;
        $sql = $pdo->prepare("SELECT id_usuario FROM usuario WHERE email = :e");
        $sql->bindValue(":e",$email);
        $sql->execute();

        //se já existe, retorna falso pois já está cadastrado
        if($sql->rowCount() > 0){
            return false;
        }
        
        //se não existe, retorna verdadeiro e insere no db
        else {
            $sql = $pdo->prepare("INSERT INTO usuario (nome, email) VALUES (:n, :e)");
            $sql->bindValue(":n",$nome);
            $sql->bindValue(":e",$email);
            $sql->execute();
            return true;
        }
    }
}

?>