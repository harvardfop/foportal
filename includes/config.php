<?php

    /**
     * config.php
     *
     * FOPortal
     * v.0.1
     *
     * Configures pages.
     */

    // enable sessions
    session_start();

    // display errors, warnings, and notices
    ini_set("display_errors", true);
    error_reporting(E_ALL);

    // requirements
    require("fields.php");
    require("houses.php");
    require("constants.php");
    require("functions.php");

    // require authentication for most pages
    if (!preg_match("{(?:login|logout|register)\.php$}", $_SERVER["PHP_SELF"]))
    {
        if (empty($_SESSION["id"]))
        {
            redirect("login.php");
        }
    }

?>
