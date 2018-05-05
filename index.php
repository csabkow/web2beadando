<?php

session_start();

require_once("Database.php");

$page = null;
if(isset($_GET["action"])) {
    $database = Database::getInstance();
    
    $req = $database->prepare("SELECT * FROM menus WHERE page_name = :name LIMIT 1");
    $req->execute(array('name' => $_GET["action"]));
    if($req->rowCount() == 1) {
        $page = "pages/" . $_GET["action"] . ".php";
    } else {
        $page = "pages/error.php";
    }
} else {
    $page = "pages/home.php";
}

function getMenu($parent_id = 0) {
        $role = 1;
        if(isset($_SESSION["role"])) {
            $role = $_SESSION["role"] + 1;
        }
        $database = Database::getInstance();
        $req = $database->prepare("SELECT * FROM menus WHERE role < :role AND parent_id = :parent_id ORDER BY ordering, parent_id");
        $req->execute(array('role' => $role, 'parent_id' => $parent_id));
        if ($req->rowCount() > 0) {
            if($parent_id == 0) {
                echo '<ul class="menu">';
            } else {
                echo '<ul class="menu submenu">';
            }

            foreach ($req->fetchAll() as $menu) {
                echo '<li class="item">';
                if($menu["page_name"] != '') {
                    if(isset($_SESSION["user_id"]) && ($menu["page_name"] == 'login' || $menu["page_name"] == 'register')) {
                    } else { 
                        echo '<a id="' . $menu["id"] . '" href="index.php?action=' . $menu["page_name"] . '">' . $menu["title"] . '</a>';
                    }  
                } else {
                    if(isset($_SESSION["user_id"]) && ($menu["page_name"] == 'login' || $menu["page_name"] == 'register')) {
                    } else { 
                        echo '<a id="' . $menu["id"] . '" href="#">' . $menu["title"] . '</a>';
                    }
                }
                getMenu($menu["menu_id"]);
                echo '</li>';
            }
            echo '</ul>';
        }
    }
?>

<!DOCTYPE html>
<html lang="hu">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/main.css" type="text/css" />
        <script src="scripts/jquery.min.js"></script>
        <script src="scripts/main.js"></script>
        <title>Hrubos Csaba</title>
    </head>
    <body>
        <header>
            <h1>HRUBOS CSABA</h1>
            <h2>Automotive Photographer</h2>
        </header>
        <nav>
            <?php getMenu(); ?>
        </nav>
        <?php require_once($page); ?>
        <footer>
            <h5> hrubos csaba - neptun kód: EK7H3Y </h5>
        </footer>
    </body>
</html>