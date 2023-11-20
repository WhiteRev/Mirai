<?php

class Mysql
{

    private $adresse = "localhost";
    private $user = "root";
    private $pass = "root";
    private $bdd = "dataMirai";

    public function OuvrirBase()
    {
        // CONNEXION A MYSQL
        $mysqli = new mysqli($this->adresse, $this->user, $this->pass, $this->bdd);

        if (mysqli_connect_errno()) {
            printf("Echec de la connexion : %s\n", mysqli_connect_error());
            exit();
        }
 
        return $mysqli;
    }

    public function Erreur($query, $file)
    {

        global $SQL;

        $date = date("Y-m-d H:i:s");
        if (isset($_SERVER["REMOTE_ADDR"])) {
            $ip = $_SERVER["REMOTE_ADDR"];
        } else {
            $ip = "localhost";
        }

        if (isset($SQL->error)) {
            $error = $SQL->error;
        } else {
            $error = '';
        }

        $headers = 'From: "Erwan" <noreply@miraitech.fr>' . "\r\n";
        $headers .= 'Reply-to: "IDP PRO" <noreply@miraitech.fr' . ">\r\n";
        $headers .= 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Return-Path: <erreur@miraitech.fr' . ">\r\n";
        $headers .= 'Content-Type: text/html; charset="UTF-8"' . "\r\n";
        $headers .= 'Content-Transfer-Encoding: 8bit' . "\r\n";

        /*if (isset($_SERVER['REQUEST_URI'])) {
            @mail("erwan@miraitech.fr", "Erreur SQL : $file", "date : $date - IP : $ip - SQL : $query - $error - " . $_SERVER['REQUEST_URI'], $headers, "-ferreur@idp-video.com");
        } else {
            @mail("erwan@miraitech.fr", "Erreur SQL : $file", "date : $date - IP : $ip - SQL : $query - $error", $headers, "-ferreur@idp-video.com");
        }*/

        echo json_encode(array('success' => false, 'message' => "internal error","$query - $error"));

        exit();
    }

    public function CloseBase($mysqli)
    {
        $mysqli->close();
    }

}
