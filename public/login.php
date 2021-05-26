<!DOCTYPE html>
<html lang="en">
<head>
    <title>CRM - </title>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- fontawesome icon -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <!-- animation css -->
    <link rel="stylesheet" href="../assets/css/animate.min.css" />

    <link rel="stylesheet" href="../assets/css/style.css" />

</head>

<body>
    <div class="auth-wrapper">
        <div class="auth-content">
            <div class="auth-bg">
                <span class="r"></span>
                <span class="r s"></span>
                <span class="r s"></span>
                <span class="r"></span>
            </div>
            <div class="card">
                <div class="card-body text-center">
                    <div class="mb-4">
                        <i class="feather icon-unlock auth-icon"></i>
                    </div>
                    <h3 class="mb-4">Login</h3>
                    <form method="POST" id="loginForm">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Username" name="username"
                                id="username" />
                        </div>
                        <div class="input-group mb-4">
                            <input name="password" id="password" type="password" class="form-control"
                                placeholder="Password" />
                        </div>
                        <p id="error"></p>
                        <div class="form-group text-left">
                            <div class="checkbox checkbox-fill d-inline">
                                <input type="checkbox" name="checkbox-fill-1" id="checkbox-fill-a1" checked="" />
                                <label for="checkbox-fill-a1" class="cr"> Show password?</label>
                            </div>
                        </div>
                        <button class="btn btn-primary w-50 shadow-2 mb-4" type="submit">Login</button>
                    </form>
                    <p class="mb-2 text-muted">
                        Forgot password? <a href="">Reset</a>
                    </p>
                    <p class="mb-0 text-muted">
                        Don’t have an account? <a href="./signup">Signup</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Required Js -->
    <script src="../assets/js/vendor-all.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="../app.js"></script>
</body>

</html>