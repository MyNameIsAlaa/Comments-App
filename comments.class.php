<?php

class comments{
  

    private $db;


    function __construct($DBCON){
     $this->db = $DBCON;
    }

    
    function create($name, $email, $message){
        $stmt = $this->db->prepare("INSERT INTO comments (name, email, message) VALUES (:name, :email, :message)");
        $stmt->bindparam(':name', $name);
        $stmt->bindparam(':email', $email);
        $stmt->bindparam(':message', $message);
        $stmt->execute();
    }

    function AutoCheck($badwords){
        $stmt = $this->db->prepare("SELECT * FROM comments WHERE status='NEW'");
        $stmt->execute();
        while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
            
           if($this->match($badwords, $row['message'])){
              $status = "REJECTED";
           }else{
              $status = "ACCEPTED";
           }
           $nstmt = $this->db->prepare("UPDATE comments SET status= :status WHERE id=:id ");
           $nstmt->bindparam(':id', $row['id']);
           $nstmt->bindparam(':status', $status);
           $nstmt->execute();
        }
    }


    function show($status){
        $stmt = $this->db->prepare("SELECT * FROM comments WHERE status= :status ");
        $stmt->bindparam(':status', $status);
        $stmt->execute();
        while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
        ?>
          <ul>
              <li>Name: <?php echo $row['name'] ?></li>
              <li>Email: <?php echo $row['email'] ?></li>
              <li>Message: <?php echo $row['message'] ?></li>
              <li>Share this message: <a href="share.php?id=<?php echo $row['id'] ?>">Share On Facebook</a></li>
          </ul>
         <?php
        }
    }

    function GetOne($id){
        $stmt = $this->db->prepare("SELECT * FROM comments WHERE id = :id");
        $stmt->bindparam(':id', $id);
        $stmt->execute();
        return $stmt->fetchObject();
    }

   function update($id ,$status){
    $sql = "UPDATE comments SET status = :status WHERE id = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':status', $status, PDO::PARAM_STR);
    $stmt->execute();
   }

    function match($badwords, $text)
     {
        foreach($badwords as $badword){
        if (strpos($text, $badword) !== false) {
            return true;
        }
       }
      return false;
     }

    
}

?>