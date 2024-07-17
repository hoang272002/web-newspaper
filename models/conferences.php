<?php
class conferModel{
    function __construct() {
        $this->conference_id = "";
        $this->name = "";
        $this->abbreviation = "";
        $this->rank = "";
        $this->start_date = "";
        $this->end_date = "";
        $this->type = "";
    }

    public static function listAll() {
        $mysqli = connect();
        $mysqli->query("SET NAMES utf8");
        $query = "SELECT * FROM conferences";
        $result = $mysqli->query($query);
        $DSconfer = array();

        if ($result)
        {            
            foreach ($result as $row) {
                $confer = new conferModel();
                $confer->conference_id = $row["conference_id"];
                $confer->name = $row["name"];
                $confer->abbreviation = $row["abbreviation"];

                $confer->rank = $row["rank"];
                $confer->start_date = $row["start_date"];
                $confer->end_date = $row["end_date"];

                $confer->type = $row["type"];
               
                $DSconfer[] = $confer; //add an item into array
            }
        }
        $mysqli->close();
        return $DSconfer;
    }

    public static function getConferById($id) {
        $mysqli = connect();
        $mysqli->query("SET NAMES utf8");
        $query = "SELECT * FROM conferences where conference_id = $id";
        $result = $mysqli->query($query);
        $DSconfer = array();

        if ($result)
        {            
            foreach ($result as $row) {
                $confer = new conferModel();
                $confer->conference_id = $row["conference_id"];
                $confer->name = $row["name"];
                $confer->abbreviation = $row["abbreviation"];

                $confer->rank = $row["rank"];
                $confer->start_date = $row["start_date"];
                $confer->end_date = $row["end_date"];

                $confer->type = $row["type"];
               
                $DSconfer[] = $confer; //add an item into array
            }
        }
        $mysqli->close();
        return $DSconfer;
    }

    
}
?>