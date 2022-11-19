<section class="grid grid-cols-5 min-h-screen p-5">
    <div class="col-span-3 flex-center">
        <div class="space-y-10 w-80">
            <div>
                <p class="text-2xl font-semibold">Reset your Digital Athenaeum account password</p>
            </div>

            <form method="post" class="space-y-5">
                <div class="form">
                    <div class="form-input-group">
                        <input type="text" name="username" class="form-input primary p-3" placeholder="Username" value="<?=$this->username?>" required/>
                    </div>
                </div>

                <div class="form">
                    <div class="form-input-group">
                        <input type="password" name="password" class="form-input primary p-3" placeholder="New Password" required/>
                    </div>
                </div>

                <div class="form">
                    <div class="form-input-group">
                        <input type="password" name="confirm_password" class="form-input primary p-3" placeholder="Confirm New Password" required/>
                    </div>
                </div>

                <button type="submit" name="reset_password" class="btn btn-primary w-full py-3">Reset my password</button>
            </form>

            <div class="flex flex-col items-center space-y-4">
                <a href="<?=route('sign-in')?>" class="text-xs text-gray-500 link-primary">Have an account? Sign-in now</a>
            </div>
        </div>
    </div>
    
    <div class="col-span-2 bg-cover rounded-2xl" style="background-image:url('https://images.unsplash.com/photo-1564042549107-24437f0603d6?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1974&q=80')">
    </div>
</section>