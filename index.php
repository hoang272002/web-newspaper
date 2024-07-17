<?php 
require_once("controllers/home.php");
require_once("controllers/user.php");
require_once("controllers/login.php");
require_once("controllers/topic_paper.php");
require_once("controllers/search.php");
require_once("controllers/profile.php");
require_once("controllers/update_profile.php");
require_once("controllers/detailPaper.php");
require_once("controllers/addPaper.php");

require_once("database/connection.php");

require_once("models/topic.php");
require_once("models/paper.php");
require_once("models/user.php");
require_once("models/conferences.php");
require_once("models/author.php");
require_once("models/participation.php");

$action = "";
if (isset($_GET["action"]))
{
    $action = $_GET["action"];
}

$search = "";
if (isset($_GET["search"]))
{
    $search = $_GET["search"];
}

$profileID = "";
if (isset($_GET["profileID"]))
{
    $profileID = $_GET["profileID"];
}


$updProfile = "";
if (isset($_GET["updProfile"]))
{
    $updProfile = $_GET["updProfile"];
}

$paperID = "";
if (isset($_GET["paperID"]))
{
    $paperID = $_GET["paperID"];
}

$authorID = "";
if (isset($_GET["authorID"]))
{
    $authorID = $_GET["authorID"];
}



if($action == "login")
{
    $controller = new loginController();
    $controller->index();
}
else if($action == "updateProfile"){
    $controller = new updProfileController();
    $controller->update();
}
else if($action == "addMember"){
    $controller = new detailPaperController();
    $controller->addMember();
}
else if($action == "addPaperByUser" && isset($_GET["authorID"])){
    $controller = new addPaperController();
    $controller->addPaper($authorID);
}
else if($action == "addPaper"){
    $controller = new addPaperController();
    $controller->index($authorID);
}
else if($action == "deleteMember"){
    $controller = new detailPaperController();
    $controller->deleteMember();
}
else if($action == "logout")
{
    $controller = new loginController();
    $controller->logout();
}
else if($action == "info" && !empty($profileID)){
    $controller = new profileController();
    $controller->index($profileID);
}
else if($action == "info" && !empty($updProfile)){
    $controller = new updProfileController();
    $controller->index($updProfile);
}
else if($action == "detailPaper" &&  !empty($paperID)){
    $controller = new detailPaperController();
    $controller->index($paperID);
}
else if($action == "checkLogin"){
    $controller = new loginController();
    $controller->checkLogin();
}
else if(!empty($search)){
    $controller = new searchController();
    $controller->search($search);
}
else if ($action != null){
    $controller = new topicPaperController();
    $controller->listTopicPaper($action);
}
else{
    $controller = new homeController();
    $controller->index();
}





?>