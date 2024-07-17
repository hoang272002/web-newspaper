<?php
class topicModel{
    function __construct() {
        $this->topic_id = "";
        $this->topic_name = "";
    }

    public static function listAll() {
        $mysqli = connect();
        $mysqli->query("SET NAMES utf8");
        $query = "SELECT * FROM topics";
        $result = $mysqli->query($query);
        $DStopic = array();

        if ($result)
        {            
            foreach ($result as $row) {
                $topic = new topicModel();
                $topic->topic_id = $row["topic_id"];
                $topic->topic_name = $row["topic_name"];
               
                $DStopic[] = $topic; //add an item into array
            }
        }
        $mysqli->close();
        return $DStopic;
    }

    public static function getTopicByID($id) {
        $mysqli = connect();
        $mysqli->query("SET NAMES utf8");
        $query = "SELECT * FROM topics where topic_id = $id";
        $result = $mysqli->query($query);
        $DStopic = array();

        if ($result)
        {            
            foreach ($result as $row) {
                $topic = new topicModel();
                $topic->topic_id = $row["topic_id"];
                $topic->topic_name = $row["topic_name"];
               
                $DStopic[] = $topic; //add an item into array
            }
        }
        $mysqli->close();
        return $DStopic;
    }

    
}
?>