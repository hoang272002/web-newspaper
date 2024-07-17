<?php
class profileController
{
    public function index($profileID)
    {
        $author = authorModel::getAuthor($profileID);
        $listpaper = participationModel::getPar($profileID);
        $VIEW = "views/profile.phtml";
        require("layout/layout_info.phtml");
    }

}
?>