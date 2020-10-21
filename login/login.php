<?php
    require_once '../header/header.php';
    $error = $user = $pass = '';

    if(isset($_POST['user']) && isset($_POST['pass'])) {
        $user = sanitizeString($_POST['user']);
        $pass = sanitizeString($_POST['pass']);

        if($user == '' || $pass == '')
            $error = 'Not all fields were entered';
        else {
            $result = queryMysql("SELECT user, pass FROM members WHERE user='$user'");
            $row = $result->fetch_array(MYSQLI_ASSOC);

            if($result->num_rows < 1)
                $error='User does not exist';
            elseif (password_verify($pass, $row['pass'])) {
                $_SESSION['user'] = $user;
                $_SESSION['pass'] = $pass;
                die("<div class='center'>You are now logged in. Please
                    <a data-transition='slide' href='../members/members.php?view=$user'>click here</a>
                    to continue
                    </div></div></body></html>");
            } else 
                $error = 'Invalid login attempt';
        }  
    }
 

    echo <<<_END
                <form method='post' action='login.php'>
                    <div class='ui-field-contain'>
                        <label></label>
                        <span class='error'>$error</span>
                    </div>
                    <div class='ui-field-contain'>
                        <label></label>
                        Please enter your details to log in
                    </div>
                    <div class='ui-field-contain'>
                        <label>Username</label>
                        <input type='text' maxlength='16' name='user' value='$user'>
                    </div>
                    <div class='ui-field-contain'>
                        <label>Password</label>
                        <input type='password' maxlength='16' name='pass' value='$pass'>
                    </div>
                    <div class='ui-field-contain'>
                        <label></label>
                        <input data-transition='slide' type='submit' value='login'>
                    </div>
                </form>
            </div>
        </body>
    </html>
    _END;
?>