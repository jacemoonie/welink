<div class="modal-pic" id="modal-pic" style="display:none;" >
                <div class="artdeco-modal-pic" role="dialog" aria-labelledby="profile-topcard-background-image-header">
                    <div class="art-pic-step" aria-modal="true" >
                        <div class="header__topcard">
                            <div class="a-modal-site-log-wrapper">
                                <img width="40px" height="40px" src="frontend\assets\favicon\icons8-link-100.png" alt="" class="">
                            </div>
                            <div class="p-btn" id="a-modal-skip">
                                Skip for now
                            </div>
                        </div>
                        <div class="modal-body__topcard">
                            <h1 class="">Pick a profile picture</h1>
                            <p class="">Have a favourite selfie? Upload it now.</p>
                            <div class="modal-body__topcard-container">
                                <div class="edit-profile__topcard-wrapper">
                                    <img  src="<?php echo url_for($profileData->profileImage);?>" alt="<?php echo $profileData->firstName.' '.$profileData->lastName;?>" class="">
                                </div>
                                <div class="topcard-btn-icon">
                                    <label for="topcard-filePhoto">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" id="camera-small" data-supported-dps="48x48">
                                            <path d="M46 8H30.52l-2.59-3.27a2.33 2.33 0 00-1.7-.73h-4.46a2.33 2.33 0 00-1.7.73L17 8H2a2.42 2.42 0 00-2 2v30a2.42 2.42 0 002 2h44a2.42 2.42 0 002-2V10a2.42 2.42 0 00-2-2z" fill="#56697a"/>
                                            <path fill="#788fa5" d="M0 10h48v30H0z"/>
                                            <path fill="#fbc2b2" d="M0 15h48v20H0z"/>
                                            <path d="M24 13a12 12 0 1012 12 12 12 0 00-12-12z" fill="#fff"/>
                                            <path d="M24 15a10 10 0 1010 10 10 10 0 00-10-10z" fill="#56697a"/>
                                            <path d="M24 19a6 6 0 106 6 6 6 0 00-6-6z" fill="#1d2226"/>
                                            <circle cx="24" cy="25" r="2" fill="#fdf9f3"/>
                                        </svg>
                                    </label>
                                    <input type="file" class="fileInputPhoto" name="filePhoto" id="topcard_filePhoto">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="art-cov-step" aria-labelledby="modal-header" style="display:none;" >
                        <div class="header__topcard">
                            <div class="go-back-arrow profile-go-back" id="go-back-profile" aria-label="Back" role="button" data-focusable="true" tabIndex="0">
                                <svg viewBox="0 0 24 24" class="color-blue"><g><path d="M20 11H7.414l4.293-4.293c.39-.39.39-1.023 0-1.414s-1.023-.39-1.414 0l-6 6c-.39.39-.39 1.023 0 1.414l6 6c.195.195.45.293.707.293s.512-.098.707-.293c.39-.39.39-1.023 0-1.414L7.414 13H20c.553 0 1-.447 1-1s-.447-1-1-1z"></path></g></svg>
                            </div>
                            <div class="a-modal-site-log-wrapper" style="padding-left:5rem;">
                                <img width="40px" height="40px"  src="frontend\assets\favicon\icons8-link-100.png" alt="" class="">
                            </div>
                            <div class="p-btn" id="a-modal-skip">
                                Skip for now
                            </div>
                        </div>
                        <div class="modal-body__topcard-cov">
                            <div class="modal-body__topcard-heading">
                                <h1 class="">Pick a header</h1>
                                <p class="">People who visit your profile will see it. Show your style.</p>  
                            </div>
                            <div class="modal-body__topcard-container-cover">
                                <div class="edit-profile-cov__topcard-wrapper">
                                    <img  src="<?php echo url_for($profileData->profileCover);?>" alt="<?php echo $profileData->firstName.' '.$profileData->lastName;?>" class="">
                                </div>
                                <div class="topcard-btn-icon">
                                        <label for="topcard-covfilePhoto">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" id="camera-small" data-supported-dps="48x48">
                                                <path d="M46 8H30.52l-2.59-3.27a2.33 2.33 0 00-1.7-.73h-4.46a2.33 2.33 0 00-1.7.73L17 8H2a2.42 2.42 0 00-2 2v30a2.42 2.42 0 002 2h44a2.42 2.42 0 002-2V10a2.42 2.42 0 00-2-2z" fill="#56697a"/>
                                                <path fill="#788fa5" d="M0 10h48v30H0z"/>
                                                <path fill="#fbc2b2" d="M0 15h48v20H0z"/>
                                                <path d="M24 13a12 12 0 1012 12 12 12 0 00-12-12z" fill="#fff"/>
                                                <path d="M24 15a10 10 0 1010 10 10 10 0 00-10-10z" fill="#56697a"/>
                                                <path d="M24 19a6 6 0 106 6 6 6 0 00-6-6z" fill="#1d2226"/>
                                                <circle cx="24" cy="25" r="2" fill="#fdf9f3"/>
                                            </svg>
                                        </label>
                                        <input type="file" class="fileInputPhoto" name="filePhoto" id="topcard_covfilePhoto">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-preview-container" style="display:none;">
                        <div class="preview-modal-header-wrapper">
                            <div class="preview-header-content">
                                <div class="go-back-arrow profile-go-back"  aria-label="Back" role="button" data-focusable="true" tabIndex="0">
                                    <svg viewBox="0 0 24 24" class="color-blue"><g><path d="M20 11H7.414l4.293-4.293c.39-.39.39-1.023 0-1.414s-1.023-.39-1.414 0l-6 6c-.39.39-.39 1.023 0 1.414l6 6c.195.195.45.293.707.293s.512-.098.707-.293c.39-.39.39-1.023 0-1.414L7.414 13H20c.553 0 1-.447 1-1s-.447-1-1-1z"></path></g></svg>
                                </div>
                                <h2>Edit Media</h2>
                            </div>
                            <span class="submitProfileChange" id="imageUploadButton">Apply</span>
                        </div>
                        <div class="preview-modal-body">
                            <div class="modal-body-profile-wrapper">
                                <div class="imagePreviewContainer">
                                    <img src="" alt="" id="imagePreview">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>