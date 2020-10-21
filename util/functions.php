<?php
    $dbhost =  'us-cdbr-east-02.cleardb.com'; 
    $dbname = 'heroku_280b6a7200efd57';
    $dbuser = 'b8c7bf235a5ade';
    $dbpass = 'e19af2cd';

    $connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname); //creates connection object to the specified DB
    if($connection->connect_error)
        die("Fatal Error");

    function createTable ($name, $query) { //creates a table with the specified name if it does not exist already
        queryMysql("CREATE TABLE IF NOT EXISTS $name($query)");
        echo "Table '$name' created or already exists.<br>";
    }

    function queryMysql($query) { //used to query the database
        global $connection;
        $result = $connection->query($query);
        if(!$result)
            die("Fatal Error");
        return $result;
    }

    function destroySession () { //destroys the current session
        $_SESSION = array();

        if(session_id() != "" || isset($_COOKIE[session_name()])) //if there is a cookie set, it destroys said cookie before ending the current session
            setcookie(session_name(), '', time() - 2592000, '/');
        
        session_destroy();
    }

    function sanitizeString($var) { //sanitizes the provided string to prevent any sql injections or xss attacks
        global $connection;
        $var = strip_tags($var);
        $var = htmlentities($var);
        if(get_magic_quotes_gpc())
            $var = stripslashes($var);
        return $connection->real_escape_string($var);
    }

    function showProfile($user) { //checks for user image and text and if they exist will display their value
        if(file_exists("$user.jpg"))
            echo "<img src='$user.jpg' style='float:left;'>";

        $result =  queryMysql("SELECT * FROM profiles WHERE user='$user'");

        if($result->num_rows) {
            $row = $result->fetch_array(MYSQLI_ASSOC);
            echo stripslashes($row['text']) . "<br style='clear:left;'><br>";
        } else {
            echo "<p>Nothing to see here, yet</p><br>";
        }
    }

    function set_url($url) {
        echo "<script>document.location.href = $url;</script>";
    }

?>