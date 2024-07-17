<?php
class searchController
{
    public function search($key)
    {
        $listConfer = conferModel::listAll();
        $listAuthor = authorModel::listAll();
        $listTopic = topicModel::listAll();
        $listSearchPaper =paperModel::searchPaper($key);
        
        require("views/search.phtml");
        
        
    }
} 
?>