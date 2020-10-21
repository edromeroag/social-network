<?php
    require_once '../header/header.php';

    echo <<<_END
        <script>
            function checkUser(user) {
                if(user.value == '') {
                    $('#used').html('&nbsp;')
                    return
                }

                $.post('../util/checkuser.php', {user: user.value}, function(data) {
                    $('#used').html(data)
                })
            }
        </script>
    _END;

    $error = $user = $pass = "";

    if(isset($_SESSION['user']))
        destroySession();

    if(isset($_POST['user']) && isset($_POST['pass'])) {
        $user = sanitizeString($_POST['user']);
        $pass = sanitizeString($_POST['pass']);
        $pass = password_hash($pass, PASSWORD_DEFAULT);

        if($user == '' || $pass == '')
            $error = 'Not all fields were entered <br><br>';
        else {
            $result = queryMysql("SELECT * FROM members WHERE user='$user'");

            if($result->num_rows)
                $error = 'That username is already taken<br><br>';
            else {
                queryMysql("INSERT INTO members(user, pass) VALUES('$user', '$pass')");
                die('<h4>Account created</h4>Please Log in.</div></body></html>');
            }
        }

    } 

    echo <<<_END
                        <form method='post' action='signup.php'>$error
                        <div class='ui-field-contain'>
                            <label></label>
                            Please enter your details to sign up
                        </div>
                        <div class='ui-field-contain'>
                            <label>Username</label>
                            <input type='text' maxlength='16' name='user' value='$user' onBlur='checkUser(this)'>
                            <label></label><div id='used'>&nbsp;</div>
                        </div>
                        <div class='ui-field-contain'>
                            <label>Password</label>
                            <input type='text' maxlength='16' name='pass' value='$pass'>
                        </div>
                        <div
                        <div class='ui-field-contain'>
                            <label></label>
                            <input data-transition='slide' type='submit' value='Sign Up'>
                        </div>
                    </div>
                </div>
            </body>
        </html>
    _END;
?>