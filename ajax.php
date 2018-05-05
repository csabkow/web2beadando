<?php

require_once("Database.php");

if(isset($_GET["action"]) && $_GET["action"] != '') {
    switch($_GET["action"]) {
        case 'review':
            if(isset($_POST["review"]) && $_POST["review"] != '') {
                session_start();
                $rev = '<li class="reviews"><div class="about"><p class="name">' . $_SESSION["username"] . '</p><p class="date">' . date("Y-m-d H:i:s") . '</p><p class="description">' . $_POST["review"] . '</p></div></li>';
                $database = Database::getInstance();
                $req = $database->prepare("INSERT INTO reviews (user_id, review, insert_date) VALUES (:user_id, :review, :insert_date)");
                $req->execute(array('user_id' => $_SESSION["user_id"], 'review' => $_POST["review"], 'insert_date' => date("Y-m-d H:i:s")));
                echo json_encode(array('code' => 1, 'review' => $rev));
            } else {
                echo json_encode(array('code' => 0, 'message' => 'Hiányos adatok'));
            }
            break;
        case 'login':
            if(isset($_POST["username"], $_POST["password"]) && $_POST["username"] != "" && $_POST["password"] != "") {
                $database = Database::getInstance();
                $req = $database->prepare("SELECT user_id, username, role FROM users WHERE username = :username AND password = PASSWORD(:password) LIMIT 1");
                $req->execute(array('username' => $_POST["username"], 'password' => $_POST["password"]));
                if($req->rowCount() == 1) {
                    $data = $req->fetch();
                    session_start();
                    $_SESSION["user_id"] = $data["user_id"];
                    $_SESSION["username"] = $data["username"];
                    $_SESSION["role"] = $data["role"];
                    echo json_encode(array('code' => 1));
                } else {
                    echo json_encode(array('code' => 0, 'message' => 'Hibás adatok'));
                }
            } else {
                echo json_encode(array('code' => 0, 'message' => 'Hiányos adatok'));
            }
            break;
        case 'register':
            if(isset($_POST["username"], $_POST["password"], $_POST["email"]) && $_POST["email"] != "" && $_POST["username"] != "" && $_POST["password"] != "") {
                $database = Database::getInstance();
                $req = $database->prepare("SELECT user_id FROM users WHERE username = :username OR email = :email");
                $req->execute(array('username' => $_POST["username"], 'email' => $_POST["email"]));
                if($req->rowCount() == 0) {
                    $req = $database->prepare("INSERT INTO users (username, password, email) VALUES (:username, PASSWORD(:password), :email)");
                    $req->execute(array('username' => $_POST["username"], 'email' => $_POST["email"], 'password' => $_POST["password"]));
                    if($req->rowCount() == 1) {
                        echo json_encode(array('code' => 1));
                    } else {
                        echo json_encode(array('code' => 0, 'message' => 'Váratlan hiba történt'));
                    }
                } else {
                    echo json_encode(array('code' => 0, 'message' => 'Ilyen regisztráció már létezik'));
                }
            } else {
                echo json_encode(array('code' => 0, 'message' => 'Hiányos adatok'));
            }
            break;
        case 'logout':
            session_start();
            session_destroy();
            echo json_encode(array('code' => 1));
            break;
        default:
            break;
    }
}
 