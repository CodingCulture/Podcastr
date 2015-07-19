<?php
$dbexample = fopen("database.php.default", "r");
$db = fread($dbexample,filesize("database.php.default"));
;?>

<?php $user = "root";?>
<?php $host= "localhost";?>
<?php $password= "";?>
<?php $database= "install_podcastr";?>

<div class="jumbotron">
    <h2>Let us talk!</h2>
</div>

<?php $db = str_replace('{{user}}', $user, $db);?>
<?php $db = str_replace('{{host}}', $host, $db);?>
<?php $db = str_replace('{{password}}', $password, $db);?>
<?php $db = str_replace('{{database}}', $database, $db);?>


<?php
    $dbsettings = fopen("..\\..\\Config\\database.php", "w");
    fwrite($dbsettings, "<?php \n");
        fwrite($dbsettings, "class DATABASE_CONFIG { \n");
            fwrite($dbsettings, "\tpublic \$default = array( \n");
                fwrite($dbsettings, $db . "\n");
            fwrite($dbsettings, "\t);\n");
            fwrite($dbsettings, "}");

    fclose($dbsettings)
;?>


<?php
    mysql_connect($host, $user, $password) or die('Error connecting to MySQL server: ' . mysql_error());

    // Select database
    mysql_select_db($database) or die('Error');

    //Query temp
    $q = "";

    //Read file
    $imports = file("import.sql");

    foreach($imports as $import){
        if (substr($import, 0, 2) == '--' || $import == '') {
            continue;
        }

        $q .= $import;

        if(substr(trim($import), -1, 1) === ";"){
            mysql_query($q) or print('Could not import the database, please contact support');
            $q = "";
        }
    }

    header("Location: http://" . $_SERVER["HTTP_HOST"] . explode('?', $_SERVER['REQUEST_URI'], 2)[0] . "?step=3");
    die();

?>
