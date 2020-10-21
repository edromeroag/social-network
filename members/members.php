<?php
    require_once '../header/header.php';

    if(!$loggedin)
        die("</div></body></html>");
    
    if(isset($_GET['view'])) {
        $view = sanitizeString($_GET['view']);

        if($view == $user)
            $name = 'Your';
        else
            $name = "$view's";

        echo "<h3>$name Profile</h3>";
        showProfile($view);
        echo "<a data-role='button' data-transition='slide' href='../messages/messages.php?view=$view'>View $name messages</a>";
        die("</div></body></html>");
    }

    if(isset($_GET['add'])) {
        $add = sanitizeString($_GET['add']);
        
        $result = queryMysql("SELECT * FROM friends WHERE user='$add' AND friend='$user'");
        if(!$result->num_rows)
            queryMysql("INSERT INTO friends VALUES('$add', '$user')");
    } elseif(isset($_GET['remove'])) {
        $remove = sanitizeString($_GET['remove']);
        queryMysql("DELETE FROM friends WHERE user='$remove' AND friend='$user'");
    }

    $result = queryMysql("SELECT user FROM members ORDER BY user");
    $num = $result->num_rows;

    echo "<h3>Other Members</h3><ul>";

    for($i = 0; $i < $num; ++$i) {
        $row = $result->fetch_array(MYSQLI_ASSOC);

        if($row['user'] == $user)
           continue;
        
        echo "<li><a data-transition='slide' href='members.php?view=" . $row['user'] . "'>" . $row['user'] . "</a>";
        $follow = "follow";

        $result1 = queryMysql("SELECT * FROM friends WHERE user='" . $row['user'] . "' AND friend='$user'");
        $t1 = $result1->num_rows;

        $result1 = queryMysql("SELECT * FROM friends WHERE user='$user' AND friend='" . $row['user'] . "'");
        $t2 = $result1->num_rows;

        if(($t1 + $t2) > 1)
            echo "&harr; is a mutual friend";
        elseif($t1)
            echo "&larr; you are following";
        elseif ($t2) {
            echo "&rarr; is following you";
            $follow = "recip";
        }

        if ($t1 < 1)
            echo " [<a data-transition='slide' href='members.php?add=" . $row['user'] . "'>$follow</a>]</li>";
        else
            echo " [<a data-transition='slide' href='members.php?remove=" . $row['user'] . "'>drop</a>]</li>";
    }
?>
        </u></div>
    </body>
</html>