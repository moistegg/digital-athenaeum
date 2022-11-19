<section class="grid grid-cols-5 min-h-screen p-5">
    <div class="col-span-2 bg-cover rounded-2xl" style="background-image:url('https://images.unsplash.com/photo-1547126298-f0ae8a42c489?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1974&q=80')">
    </div>

    <div class="col-span-3 flex-center">
        <div class="space-y-10 w-80">
            <div>
                <p class="text-2xl font-semibold">Sign-in to Digital Athenaeum</p>
                <p class="text-sm text-gray-500">Please sign-in to continue.</p>
            </div>

            <form method="post" class="space-y-5">
                <div class="form">
                    <div class="form-input-group">
                        <input type="text" name="username" class="form-input primary p-3" placeholder="Username" value="<?=$this->username?>" required/>
                    </div>
                </div>

                <div class="form">
                    <div class="form-input-group">
                        <input type="password" name="password" class="form-input primary p-3" placeholder="Password" required/>
                    </div>
                </div>

                <button type="submit" name="login" class="btn btn-primary w-full py-3">Sign In</button>
            </form>

            <div class="flex flex-col items-center space-y-4">
                <a href="<?=route('create-account')?>" class="text-xs text-gray-500 link-primary">Don't have an account? Create an account</a>
                <a href="<?=route('forgot-password')?>" class="text-xs text-gray-500 link-primary">Forgot password?</a>
            </div>
        </div>
    </div>
</section>