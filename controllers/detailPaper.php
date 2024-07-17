<?php
class detailPaperController
{
    public function index($paperID)
    {
        $paper = paperModel::getPaperByID($paperID);
        $topic = topicModel::getTopicByID($paper[0]->topic_id);
        $confer = conferModel::getConferById($paper[0]->conference_id);

        $listPar = participationModel::getParByPaperId($paperID);

        $mess = isset($_GET['mess']) ? urldecode($_GET['mess']) : null;
        require("views/detailPaper.phtml");
        
    }

    public function addMember(){
        if(isset($_POST['btnAddMember'])){
            $listPar = participationModel::getParByPaperId($_POST['paperID']);
            foreach($listPar as $item){
                if($_POST['authorID'] == $item->user_id) {
                    $mess = "You already add in member!!";
                    
                    header("Location: index.php?action=detailPaper&paperID=".$_POST['paperID']."&mess=$mess");
                    exit;
                }
            }

            $mess = participationModel::addPar($_POST['paperID'],$_POST['authorID']);
            $listPar = participationModel::getParByPaperId($_POST['paperID']);
            foreach($listPar as $item){
                if($_POST['authorID'] == $item->user_id){
                    $new_list_author = $_POST['list_author'] . ", " . $item->full_name;
                    $mess = paperModel::updateListString($new_list_author,$_POST['paperID']);
                    header("Location: index.php?action=detailPaper&paperID=".$_POST['paperID']."&mess=$mess");
                    exit;
                }
            }
            
           
           
        }
    }

    public function deleteMember(){
            $mess = participationModel::deletePar($_POST['paperID'],$_POST['authorID']);

            $array = explode(", ", $_POST['list_author']);
            if (($key = array_search($_POST['authorName'], $array)) !== false) {
                unset($array[$key]);
            }

            $mess = $new_list_author = implode(", ", $array);
            $mess = paperModel::updateListString($new_list_author,$_POST['paperID']);
            header("Location: index.php?action=detailPaper&paperID=".$_POST['paperID']."&mess=$mess");
            exit;
                
            
    }
}
?>