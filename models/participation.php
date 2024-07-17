<?php
class paperParModel{
    function __construct() {
        $this->title = "";
        $this->role = "";
        $this->date_added = "";
    }

};



class participationModel{
    function __construct() {
        $this->author_id = "";
        $this->paper_id = "";
        $this->role = "";
        $this->date_added = "";
        $this->status = "";
    }

    public static function addPar1($paperid, $authorid, $role) {
        $mysqli = connect();
        $mysqli->query("SET NAMES utf8");
    
       
        $current_date = date('Y-m-d H:i:s');
    
   
        $stmt = $mysqli->prepare("INSERT INTO participation (author_id, paper_id, role, date_added, status) VALUES (?, ?, ?, ?, ?)");
     
        $status = "show";
        $stmt->bind_param("iisss", $authorid, $paperid, $role, $current_date, $status);
    
        $result = $stmt->execute();
    
        if ($result) {
            return 1;
        } else {
            return 0;
        }
    
        $stmt->close();
        $mysqli->close();
    }

    public static function getPar($id) {
        $mysqli = connect();
        $mysqli->query("SET NAMES utf8");
        $query = "SELECT p.date_added, p.role, pp.title FROM participation as p inner join papers as pp on p.paper_id = pp.paper_id  where p.author_id = $id ORDER BY p.date_added DESC;";
        $result = $mysqli->query($query);
        $DSpar = array();

        if ($result)
        {            
            foreach ($result as $row) {
                $par = new paperParModel();
                $par->title = $row["title"];
                $par->role = $row["role"];
                $par->date_added = $row["date_added"];
                $DSpar[] = $par; //add an item into array
            }
        }
        $mysqli->close();
        return $DSpar;
    }

    public static function getParByPaperId($id) {
        $mysqli = connect();
        $mysqli->query("SET NAMES utf8");
        $query = "SELECT p.*, a.* from participation as p inner join authors as a on p.author_id = a.user_id where p.paper_id = $id";
        $result = $mysqli->query($query);
        $DSpar = array();
      
        if ($result) {
            while ($row = $result->fetch_object()) {
                $DSpar[] = $row; // Thêm từng hàng vào mảng
            }
        } else {
            echo "Error executing query: " . $mysqli->error;
        }
        
        $mysqli->close();
        return $DSpar;
    }

    public static function addPar($paperid, $authorid) {
        $mysqli = connect();
        $mysqli->query("SET NAMES utf8");
    
       
        $current_date = date('Y-m-d H:i:s');
    
   
        $stmt = $mysqli->prepare("INSERT INTO participation (author_id, paper_id, role, date_added, status) VALUES (?, ?, ?, ?, ?)");
        $role = "member";
        $status = "show";
        $stmt->bind_param("iisss", $authorid, $paperid, $role, $current_date, $status);
    
        $result = $stmt->execute();
    
        if ($result) {
            return "Insert successful!";
        } else {
            return "Insert failed: " . $stmt->error;
        }
    
        $stmt->close();
        $mysqli->close();
    }

    public static function deletePar($paperid, $authorid) {
        $mysqli = connect();
        $mysqli->query("SET NAMES utf8");
    
      
        $stmt = $mysqli->prepare("DELETE FROM participation WHERE paper_id = ? AND author_id = ?");
    
  
        $stmt->bind_param("ii", $paperid, $authorid);
    
  
        $result = $stmt->execute();
    
        if ($result) {
            return "Delete successful!";
        } else {
            return "Delete failed: " . $stmt->error;
        }
    
        $stmt->close();
        $mysqli->close();
    }
    
    
}
?>