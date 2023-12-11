<div class="form-row">
    <div class="col-md-6 mb-4">
        <label for="validationCustom01">Fullname</label>
        <input value="<?php print Whiz::h($admin->fullname) ?>" name="admin[full_name]" type="text" class="form-control" id="validationCustom01"  required>
        <div class="invalid-feedback">
            Please enter a full name!
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <label for="validationCustomUsername">Username</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroupPrepend">@</span>
            </div>
            <input value="<?php print Whiz::h($admin->username) ?>" name="admin[username]" type="text" class="form-control" id="validationCustomUsername" placeholder="Username" aria-describedby="inputGroupPrepend" required>
            <div class="invalid-feedback">
                Please choose a username.
            </div>
        </div>
    </div>
</div>
<div class="form-row">
    <div class="col-md-6 mb-4">
        <label for="validationCustom03">Password</label>
        <input name="admin[password]" type="password" class="form-control" id="validationCustom03" >
        <div class="invalid-feedback">
            Please enter a password.
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <label for="validationCustom04">Confirm Pasword</label>
        <input name="admin[confirm_password]" type="password" class="form-control" id="validationCustom04">
        <div class="invalid-feedback">
            Please confirm your password.
        </div>
    </div>
</div>
<div class="form-row">
    <div class="col-md-6 mb-4">
        <label for="validationCustom03">Email</label>
        <input value="<?php print Whiz::h($admin->email) ?>" name="admin[email]" type="email" class="form-control" id="validationCustom03" >
        <div class="invalid-feedback">
            Please enter a email.
        </div>
    </div>
</div>
