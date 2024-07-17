<?php
class homeController
{
    public function index()
    {
        $listConfer = conferModel::listAll();
        $listAuthor = authorModel::listAll();
        $listTopic = topicModel::listAll();
        $listPaper = paperModel::listNewestPaper($listTopic);
        $VIEW = "views/home.phtml";
        require("layout/layout.phtml");
    }

    

}
?>