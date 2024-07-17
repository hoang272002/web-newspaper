<?php
class paperModel{
    function __construct() {
        $this->paper_id = "";
        $this->title = "";
        $this->author_string_list = "";
        $this->abstract = "";
        $this->conference_id = 0;
        $this->topic_id  = 0;
        $this->user_id = 0;
    }
    public static function inserPaper($p1,$p2,$p3,$p4,$p5,$p6 ){
        $mysqli = connect();
        $mysqli->query("SET NAMES utf8");

        $query = "INSERT INTO papers (title,author_string_list, abstract, conference_id, topic_id,user_id) VALUES (\"$p1\",\"$p2\",\"$p3\",$p4,$p5,$p6);";
        $result = $mysqli->query($query);

        $paper_id = $mysqli->insert_id;
        $mysqli->close();
        return $paper_id;
    }

    public static function listNewestPaper($listTopic) {
        $mysqli = connect();
        $mysqli->query("SET NAMES utf8");
        $DSpaper = array();

        foreach ($listTopic as $topic){
            $query = "SELECT * FROM papers where topic_id = $topic->topic_id ORDER BY paper_id DESC limit 1;";
            $result = $mysqli->query($query);
            if ($result)
            {            
                foreach ($result as $row) {
                    $paper = new paperModel();
                    $paper->paper_id = $row["paper_id"];
                    $paper->title = $row["title"];
                    $paper->author_string_list = $row["author_string_list"];
                    $paper->abstract = $row["abstract"];
                    $paper->conference_id = $row["conference_id"];
                    $paper->topic_id = $row["topic_id"];
                    $paper->user_id = $row["user_id"];

                    $DSpaper[] = $paper; //add an item into array
                }
            }
        }
        $mysqli->close();
        return $DSpaper;
    }
    public static function updateListString($list_author,$id) {
        $mysqli = connect();
        $mysqli->query("SET NAMES utf8");


    
        $query = "UPDATE papers SET author_string_list = '$list_author' WHERE paper_id = $id";
        $result = $mysqli->query($query);
        if($result){
            return "Update successfull!!";
        }
        else{
            return "Insert fail !!";
        }
        $mysqli->close();
  
    }

    public static function listPaper($topic) {
        $mysqli = connect();
        $mysqli->query("SET NAMES utf8");
        $DSpaper = array();

    
        $query = "SELECT * FROM papers where topic_id = $topic ORDER BY paper_id DESC limit 5;";
        $result = $mysqli->query($query);
        if ($result)
        {            
            foreach ($result as $row) {
                $paper = new paperModel();
                $paper->paper_id = $row["paper_id"];
                $paper->title = $row["title"];
                $paper->author_string_list = $row["author_string_list"];
                $paper->abstract = $row["abstract"];
                $paper->conference_id = $row["conference_id"];
                $paper->topic_id = $row["topic_id"];
                $paper->user_id = $row["user_id"];

                $DSpaper[] = $paper; //add an item into array
            }
        }
    
        $mysqli->close();
        return $DSpaper;
    }

    public static function getPaperByID($id) {
        $mysqli = connect();
        $mysqli->query("SET NAMES utf8");
        $DSpaper = array();

    
        $query = "SELECT * FROM papers where paper_id = $id;";
        $result = $mysqli->query($query);
        if ($result)
        {            
            foreach ($result as $row) {
                $paper = new paperModel();
                $paper->paper_id = $row["paper_id"];
                $paper->title = $row["title"];
                $paper->author_string_list = $row["author_string_list"];
                $paper->abstract = $row["abstract"];
                $paper->conference_id = $row["conference_id"];
                $paper->topic_id = $row["topic_id"];
                $paper->user_id = $row["user_id"];

                $DSpaper[] = $paper; //add an item into array
            }
        }
    
        $mysqli->close();
        return $DSpaper;
    }

    public static function searchPaper($key) {
        $mysqli = connect();
        $mysqli->query("SET NAMES utf8");
        $DSpaper = array();

    
        $query = "SELECT * FROM papers where title LIKE '%$key%';";
        $result = $mysqli->query($query);

        if ($result)
        {            
            foreach ($result as $row) {
                $paper = new paperModel();
                $paper->paper_id = $row["paper_id"];
                $paper->title = $row["title"];
                $paper->author_string_list = $row["author_string_list"];
                $paper->abstract = $row["abstract"];
                $paper->conference_id = $row["conference_id"];
                $paper->topic_id = $row["topic_id"];
                $paper->user_id = $row["user_id"];

                $DSpaper[] = $paper; //add an item into array
            }
        }

        $query = " SELECT p.*
                    FROM papers AS p
                    JOIN authors AS a ON p.user_id = a.user_id
                    WHERE a.full_name LIKE '%$key%'";
        $result = $mysqli->query($query);
        
        if ($result)
        {
            $i = 0;
            foreach ($result as $row) {
                foreach ($DSpaper as $row1){
                    if ($row["paper_id"] == $row1->paper_id){
                        $i = 1;
                        break;
                    }
                }
                
                if($i == 0 ){
                    $paper = new paperModel();
                    $paper->paper_id = $row["paper_id"];
                    $paper->title = $row["title"];
                    $paper->author_string_list = $row["author_string_list"];
                    $paper->abstract = $row["abstract"];
                    $paper->conference_id = $row["conference_id"];
                    $paper->topic_id = $row["topic_id"];
                    $paper->user_id = $row["user_id"];
    
                    $DSpaper[] = $paper; //add an item into array
                }
                $i = 0;
            }
        }
        $mysqli->close();

        return $DSpaper;
    }

    
}
?>