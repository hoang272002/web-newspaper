<?php
class topicPaperController
{
    public function listTopicPaper($topic)
    {
        $listTopic = topicModel::listAll();
        $list = paperModel::listPaper($topic);
        $VIEW = "views/topic_paper.phtml";
        require("layout/layout.phtml");
    }
    
}
?>