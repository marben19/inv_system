<?php


// Generate a random 6-digit PIN code if it doesn't exist
if (!isset($_SESSION['system'][0]['admin_pin'])) {
    $_SESSION['system'][0]['admin_pin'] = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
}

$admin_pin = $_SESSION['system'][0]['admin_pin'];
?>

<div class="container-fluid p-0">
    <h1 class="h3 mb-3"><strong>Profile</strong></h1>
    <div class="row">
        <div class="card">
            <div class="card-header"></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label>Username</label>
                            <input type="text" class="form-control" id="username" value="<?= $_SESSION['system'][0]['username'] ?>">
                        </div>
                        <div class="form-group mb-3">
                            <label>Email</label>
                            <input type="email" class="form-control" id="email" value="<?= $_SESSION['system'][0]['email'] ?>">
                        </div>
                        <div class="form-group mb-3">
                            <button class="btn btn-primary" id="update-profile" data-userid="<?= $_SESSION['system'][0]['id'] ?>">Update</button>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label>New Password</label>
                            <input type="text" class="form-control" id="newpassword">
                        </div>
                        <div class="form-group mb-3">
                            <label>Confirm Password</label>
                            <input type="text" class="form-control" id="cpassword">
                        </div>
                        <div class="form-group mb-3">
                            <button class="btn btn-primary" id="update-pass" data-userid="<?= $_SESSION['system'][0]['id'] ?>">Update</button>
                        </div>
                        
                    </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
