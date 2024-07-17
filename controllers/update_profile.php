<?php
class updProfileController
{
    public function index($profileID)
    {
        $author = authorModel::getAuthor($profileID);
       
        $VIEW = "views/upd_profile.phtml";
        require("layout/layout_info.phtml");
    }

    public function update(){
        if(isset($_POST['btnUpdPro'])){
            $userid =$_POST['userid'];
            $fullname =$_POST['fullname'];

            $website = $_POST['website'];

            $img_path = "";
            if (isset($_FILES['imagepath']) && $_FILES['imagepath']['error'] == 0) {
               
                $target_dir = "images/";
               
                $temp_file = $_FILES["imagepath"]["tmp_name"];
        
                $original_file_name = basename($_FILES["imagepath"]["name"]);
        
                $target_file = $target_dir . $original_file_name;
        
                if (move_uploaded_file($temp_file, $target_file)) {
                    $img_path = "/".$target_file;
                } else {
                    echo "Có lỗi khi tải lên file.";
                }
            }
            else{
                $img_path = $_POST['img_path'];
            }
            

            $profile_list = $_POST['profile_json_text'];
            $profile = json_decode($profile_list, true);
            if (!isset($profile['education'])) {
                $profile['education'] = '';
            }
            if (!isset($profile['work_experiences'])) {
                $profile['work_experiences'] = '';
            }


            $profile['bio'] = $_POST['bio'];
            $profile['interests'] = explode(',', $_POST['interests']);
            $profile['education'] = explode(',', $_POST['education']);
            $profile['work_experiences'] = explode(',', $_POST['work_experiences']);

            $string_profile = json_encode($profile);

            $authorProfile = new authorModel();
            $authorProfile->user_id = $userid;
            $authorProfile->full_name = $fullname;
            $authorProfile->website = $website;
            $authorProfile->profile_json_text = $string_profile;
            $authorProfile->image_path = $img_path;
           
            $check = authorModel::updateAuthor($authorProfile);
            
            if(!empty($check)){
                $mess = "update success";
            }
            else{
                $mess = "update fail";
            }

            $author = authorModel::getAuthor($userid);
           
            $VIEW = "views/upd_profile.phtml";
            require("layout/layout_info.phtml");
        }
    }

}
?>