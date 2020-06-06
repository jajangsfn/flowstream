<!DOCTYPE html>
<html lang="en">

<body id="kt_body" class="header-fixed subheader-enabled page-loading">
    <div class="d-flex flex-column flex-root">
        <!--begin::Login-->
        <div class="login login-2 login-signin-on d-flex flex-row-fluid" id="kt_login">
            <div class="d-flex flex-center flex-row-fluid bgi-size-cover bgi-position-top bgi-no-repeat" style="background-image: url('<?= base_url() ?>assets/media/bg/bg-2.jpg');">
                <div class="login-form text-center p-7 position-relative overflow-hidden card">
                    <!--begin::Login Header-->
                    <div class="d-flex flex-center my-10">
                        <a href="<?= base_url() ?>">
                            <h1 class="display-3">
                                Flowstream
                            </h1>
                        </a>
                    </div>
                    <!--end::Login Header-->
                    <!--begin::Login Sign in form-->
                    <div class="login-signin">
                        <div class="mb-5">
                            <h3>Log in</h3>
                            <div class="text-muted font-weight-bold">Enter your details to login to your account:</div>
                        </div>
                        <form class="form" action="<?= base_url("/index.php/landing/do_login") ?>" method="POST">
                            <div class="form-group mb-5">
                                <input class="form-control h-auto form-control-solid py-4 px-8" type="text" placeholder="Username" name="username" autocomplete="off" />
                            </div>
                            <div class="form-group mb-5">
                                <input class="form-control h-auto form-control-solid py-4 px-8" type="password" placeholder="Password" name="password" />
                            </div>
                            <button class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4" type="submit">Sign In</button>
                        </form>
                        <div class="mt-10">
                            <span class="opacity-70 mr-4">Don't have an account yet?</span>
                            <a href="<?= base_url("/index.php/landing/register") ?>" class="text-muted text-hover-primary font-weight-bold">Sign Up!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Login-->
    </div>

</body>
<!--end::Body-->

</html>