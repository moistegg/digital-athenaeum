<section class="mt-8 space-y-8 pb-5">
    <p class="text-2xl font-bold">Hello, <?=auth()->getProfile->fullname?></p>

    <div class="space-y-4">
        <p class="text-lg font-semibold">Profile</p>

        <div class="space-y-12">
            <form method="post" class="space-y-5">
                <div class="form">
                    <div class="form-input-group">
                        <label class="label" for="username">Username</label>
                        <input type="text" id="username" name="username" class="form-input primary p-3" placeholder="Username" value="<?=$this->user->username?>" required/>
                    </div>
                </div>
    
                <div class="form">
                    <div class="form-input-group">
                        <label class="label" for="fullname">Fullname</label>
                        <input type="text" id="fullname" name="fullname" class="form-input primary p-3" placeholder="Fullname" value="<?=$this->user->getProfile->fullname?>" required/>
                    </div>
                </div>
    
                <button type="submit" name="update_profile" class="btn btn-primary w-full py-3">Update Profile</button>
            </form>
    
            <form method="post" class="space-y-5">
                <div class="form">
                    <div class="form-input-group">
                        <label class="label" for="new_password">New Password</label>
                        <input type="password" id="new_password" name="new_password" class="form-input primary p-3" placeholder="New Password" required/>
                    </div>
                </div>
    
                <div class="form">
                    <div class="form-input-group">
                        <label class="label" for="confirm_new_password">Confirm New Password</label>
                        <input type="password" id="confirm_new_password" name="confirm_new_password" class="form-input primary p-3" placeholder="Confirm New Password" required/>
                    </div>
                </div>
    
                <button type="submit" name="update_password" class="btn btn-primary w-full py-3">Change Password</button>
            </form>
        </div>
    </div>
</section>