<form role="form" method="post" id="registration_form">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Forgot Password ?</h4>
        </div>
        <div class="modal-body">
            <div class="form-group" id="password_error">
                <label>Enter New Password</label>
                <input type="password" class="form-control placeholder-no-fix" maxlength="13" placeholder="Enter New Password" name="new_password" id="new_password">
            </div>
            <div class="form-group" id="c_password_error">
                <label>Enter Confirm Password</label>
                <input type="password" class="form-control placeholder-no-fix" maxlength="13" placeholder="Enter Confimr Password" name="c_password" id="c_password">
            </div><span id="password_status"></span>
        </div>
        <div class="modal-footer">
            <button type="button" id="change_password_btn" class="btn btn-success submit_form">Submit</button>
        </div>
    </div>
</form>
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script>
    $('#new_password').keyup(function () {
        $("#password_error").removeClass("has-error has-success");
        var pass = $("#new_password").val();
        if (pass.length < 8 || pass.length > 13) {
            $("#password_error").addClass("has-error");
        } else {
            $("#password_error").addClass("has-success");
        }
    });
    $('#c_password').keyup(function () {
        $("#c_password_error").removeClass("has-error has-success");
        var pass = $("#c_password").val();
        if (pass.length < 8 || pass.length > 13) {
            $("#c_password_error").addClass("has-error");
        } else {
            $("#c_password_error").addClass("has-success");
        }
        $('#password_status').text('');
        if ($('#new_password').val() != $('#c_password').val()) {
            //alert();
            $('#password_status').text('Password Does not match');
            $("#password_status").css('color', "red");
            $("#password_status").text("Password Not Match");
        }
    });

    $('#change_password_btn').click(function () {
        //alert();exit;
        //var old_pass = $('#old_password').val();
        var new_pass = $('#new_password').val();
        var c_pass = $('#c_password').val();
        if (new_pass != c_pass) {
            alert('password does not match');
            exit;
        } else if (new_pass.length < 8 || new_pass.length > 13) {
            alert('password Should be 8 to 13 Digit');
            exit;
        } else {
            jQuery.ajax({
                url: "<?php echo base_url('index.php/admin_panel/Profile/change_password'); ?>",
                method: 'POST',
                dataType: 'json',
                data: {
                    //old_pass:old_pass,
                    new_pass: new_pass,
                    c_pass: c_pass
                },
                success: function (data) {
                    if (data.status == true) {
                        alert(data.message);
                        $('#new_password').val('');
                        $('#c_password').val('');
                    } else {
                        alert(data.message);
                    }
                }
            });
        }
    });
</script>