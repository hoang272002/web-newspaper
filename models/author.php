<?php
class authorModel{
    function __construct() {
        $this->user_id = "";
        $this->full_name = "";
        $this->website = "";
        $this->profile_json_text = "";
        $this->image_path = "";
    }

    public static function listAll() {
        $mysqli = connect();
        $mysqli->query("SET NAMES utf8");
        $query = "SELECT * FROM authors";
        $result = $mysqli->query($query);
        $DSauthor = array();

        if ($result)
        {            
            foreach ($result as $row) {
                $author = new authorModel();
                $author->user_id = $row["user_id"];
                $author->full_name = $row["full_name"];
                $author->website = $row["website"];
                $author->profile_json_text = $row["profile_json_text"];
                $author->image_path = $row["image_path"];

              
               
                $DSauthor[] = $author; //add an item into array
            }
        }
        $mysqli->close();
        return $DSauthor;
    }

    public static function getAuthor($id) {
        $mysqli = connect();
        $mysqli->query("SET NAMES utf8");
        $query = "SELECT * FROM authors where user_id = $id;";
        $result = $mysqli->query($query);
        $DSauthor = array();

        if ($result)
        {            
            foreach ($result as $row) {
                $author = new authorModel();
                $author->user_id = $row["user_id"];
                $author->full_name = $row["full_name"];
                $author->website = $row["website"];
                $author->profile_json_text = $row["profile_json_text"];
                $author->image_path = $row["image_path"];

              
               
                $DSauthor[] = $author; //add an item into array
            }
        }
        $mysqli->close();
        return $DSauthor;
    }

    public static function updateAuthor($author) {
        $mysqli = connect();
        $mysqli->query("SET NAMES utf8");
        $query = "update authors set full_name = '$author->full_name', website='$author->website', profile_json_text='$author->profile_json_text', image_path='$author->image_path' where user_id = $author->user_id;";
        $result = $mysqli->query($query);
        $mysqli->close();
        return $result;
    }
    

    
}
?>