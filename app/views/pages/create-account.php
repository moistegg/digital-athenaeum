<section class="grid grid-cols-5 min-h-screen p-5">
    <div class="col-span-3 flex-center">
        <div class="space-y-10 w-80">
            <div>
                <p class="text-2xl font-semibold">Create Digital Athenaeum account</p>
                <p class="text-sm text-gray-500">Let's join us and be great.</p>
            </div>

            <form method="post" class="space-y-5">
                <div class="form">
                    <div class="form-input-group">
                        <input type="text" name="username" class="form-input primary p-3" placeholder="Username" value="<?=$this->username?>" required/>
                    </div>
                </div>

                <div class="form">
                    <div class="form-input-group">
                        <input type="text" name="fullname" class="form-input primary p-3" placeholder="Fullname" value="<?=$this->fullname?>" required/>
                    </div>
                </div>

                <div class="form">
                    <div class="form-input-group">
                        <input type="password" name="password" class="form-input primary p-3" placeholder="Password" required/>
                    </div>
                </div>

                <div class="form">
                    <div class="form-input-group">
                        <input type="password" name="confirm_password" class="form-input primary p-3" placeholder="Confirm Password" required/>
                    </div>
                </div>

                <button type="submit" name="create_account" class="btn btn-primary w-full py-3">Create an account</button>
            </form>

            <div class="flex flex-col items-center space-y-4">
                <a href="<?=route('sign-in')?>" class="text-xs text-gray-500 link-primary">Have an account? Sign-in now</a>
            </div>
        </div>
    </div>

    <div class="col-span-2 bg-cover rounded-2xl" style="background-image:url('https://images.unsplash.com/photo-1545875133-4105af0f122f?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1988&q=80')">
    </div>
</section>