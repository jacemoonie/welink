<?php

    class Friend{
        private $pdo, $user;

        public function __construct(){
            $this->pdo = Database::instance();
            $this->user = new User;
        }

        public function checkFriend($friendID,$user_id){
            $stmt = $this->pdo->prepare("SELECT * FROM `friend` WHERE `sender` =:userId AND `receiver` =:friendID");
            $stmt->bindParam(":userId",$user_id,PDO::PARAM_INT);
            $stmt->bindParam(":friendID",$friendID,PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function profileBtn($profileId,$userId){
            $data = $this->checkFriend($profileId,$userId);
            $userData = $this->user->userData($userId);
            if($profileId != $userId){
                if(!empty($data['receiver'])===$profileId){
                    echo '<button class="p-btn" aria-label="Message" data-focusable="true" tabIndex="0" role="button">
                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="user-plus" class="svg-inline--fa fa-user-plus fa-w-20" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path fill="currentColor" d="M624 208h-64v-64c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v64h-64c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h64v64c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16v-64h64c8.8 0 16-7.2 16-16v-32c0-8.8-7.2-16-16-16zm-400 48c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm89.6 32h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4z"></path></svg>
                    </button>
                    <button class="f-btn p-btn unfriend-btn" data-friend="'.$profileId.'">Friends</button>';
                }else{
                    echo '<button class="p-btn" aria-label="Message" data-focusable="true" tabIndex="0" role="button">
                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="user-plus" class="svg-inline--fa fa-user-plus fa-w-20" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path fill="currentColor" d="M624 208h-64v-64c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v64h-64c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h64v64c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16v-64h64c8.8 0 16-7.2 16-16v-32c0-8.8-7.2-16-16-16zm-400 48c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm89.6 32h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4z"></path></svg>
                    </button>
                    <button class="f-btn p-btn friend-btn" data-friend="'.$profileId.'">Add friends</button>';
                }
            }else{
                if($userData->profileEdit==1){
                    echo '<button class="p-btn" role="button">Edit Profile</button>';
                }else{
                    echo '<button class="edit-profile-btn" role="button">Set up Profile</button>';
                }
            }
        }

    }


?>