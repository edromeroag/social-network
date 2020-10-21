<?php // Example 27-4: index.php
    require_once 'header/header.php';

    echo "<div class='center'> Welcome to Edgardo's social network,";
 
    if($loggedin)
        echo " $user. You are logged in";
    else
        echo " please sign up or log in";


    echo <<<_END
                    </div><br>
                </div>
                <div data-role='footer'>
                    <h4>Web App from <i><a href='http://lpmj.net/5thedition' target='_blank'>Learning PHP MySQL & JavaScript Ed. 5</a></i></h4>
                </div>
            </body>
        </html>
    _END;
?>
