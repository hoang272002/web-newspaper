<?php
    class addPaperController{
        public function index($authorID){
            $author = authorModel::getAuthor($authorID);
            $listTopic = topicModel::listAll();
            $listConfer = conferModel::listAll();
            $listAuthor = authorModel::listAll();
            $VIEW = "views/add_paper.phtml";
            require("layout/layout_info.phtml");
        }

        public function addPaper($userID){
            if (isset($_POST['btnAddPaper'])) {
                $title = $_POST['title'];
                $abstract = $_POST['abstract'];
                $conference = $_POST['conference'];
                $topic = $_POST['topic'];
                $author_data = json_decode($_POST['author_data'], true);
               
                $listname = array();


                if ($author_data) {
                    foreach ($author_data as $author) {
                        $listname[] = $author['authorName'];
                    }
                } 

                $string_list_author = implode(", ", $listname);
                

                 $paper_id = paperModel::inserPaper($title,$string_list_author,$abstract,$conference,$topic,$userID);

                 $i = 1;
                 if ($author_data) {
                    foreach ($author_data as $author) {
                        $i = participationModel::addPar1($paper_id,$author['authorID'],$author['role']);
                        if($i == 0){
                            break;
                        }
                    }

                    if($i == 1){
                        session_start();
                        $_SESSION['success_message'] = "Paper added successfully with ID: $paper_id";
                        header("Location: index.php?action=addPaper&authorID=$userID");
                        exit;
                    }
                    else{
                        session_start();
                        $_SESSION['success_message'] = "Paper added fail!!";
                        header("Location: index.php?action=addPaper&authorID=$userID");
                        exit;
                    }
                }
            }
        }
    }

?>