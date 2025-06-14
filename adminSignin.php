<!DOCTYPE html>

<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="resources\logo.png">
    <title>Tradewave | Admin Sign In</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />

</head>

<body class="bd">
    <div class="container-fluid">
        <div class="row justify-content-center " style="margin-top: 150px;">
            <div class="col-12 col-lg-8 ">
                <div class="row">
                    <div class="col-11 col-lg-6 text-center" style="margin-top: 100px;">
                        <img src="resources\TRADEWAVE.png" style="height: 200px;" />


                    </div>


                    <div class="col-12 col-lg-6 text-center border-start">
                        <form class="text-light">
                            <h1>Welcome</h1>
                            <h6 class="mt-3">PLEASE LOGIN TO ADMIN DASHBOARD</h6>
                            <div class="row justify-content-center">
                                <div class="col-12 col-lg-10 " style="margin-top: 80px;">
                                    <input class="form-control" placeholder="USERNAME" id="email2">
                                </div>
                                <div class="mt-2 col-12 col-lg-10">
                                    <input class="form-control" type="password" placeholder="PASSWORD" id="pasw1">
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div style="margin-top: 80px;">
                                    <label type="submit" class="btn btn-block col-10 col-lg-8" style="background-color: orangered;" onclick="login1();">LOGIN</label>
                                </div>
                                <p class="mt-3"><a href="#" style="text-decoration: none; color:white;">FORGOTTEN YOUR PASSWORD?</a></p>
                            </div>
                        </form>
                    </div>


                </div>
            </div>

        </div>

        <!-- modal -->
        <div class="modal" tabindex="-1" id="AdminVerificationModel">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Verification Code</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">

                           

                            <div class="col-12">
                                <label class="form-label">Verifiction Code</label>
                                <input type="text" class="form-control" id="vc" />
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="verifycode();">Verify</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal -->


        <!-- Footer -->
        <div class="col-12 d-none d-lg-block fixed-bottom">
            <p class="text-center text-black">&copy;2023 Tradewave.lk || ALL Rights Reserved</p>
        </div>
        <!-- Footer -->

    </div>
    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>
    <script src="sweetalert.min.js"></script>
</body>

</html>