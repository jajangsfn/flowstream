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
                            <h3>Create a new Account</h3>
                            <div class="text-muted font-weight-bold">Enter your details:</div>
                        </div>
                        <form class="form" action="<?= base_url("/index.php/api/register") ?>" method="POST">
                            <div class="form-group mb-5">
                                <input class="form-control h-auto form-control-solid py-4 px-8" type="email" placeholder="Email" name="email" autocomplete="off" required />
                            </div>
                            <div class="form-group mb-5">
                                <input class="form-control h-auto form-control-solid py-4 px-8" type="text" placeholder="Username" name="username" autocomplete="off" required />
                            </div>
                            <div class="form-group mb-5">
                                <input class="form-control h-auto form-control-solid py-4 px-8" type="password" placeholder="Password" name="password" required />
                            </div>
                            <div class="form-group d-flex flex-wrap flex-center mt-10">
                                <button type="submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-2">Sign Up</button>
                                <a href="<?= base_url() ?>" class="btn btn-light-primary font-weight-bold px-9 py-4 my-3 mx-2">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Login-->
    </div>

</body>
<!--end::Body-->

</html>