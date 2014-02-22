<?php

    // configuration
    require("../includes/config.php"); 

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
        if (empty($_POST["username"]))
        {
            apologize("You must provide your username.");
        }
        else if (empty($_POST["password"]))
        {
            apologize("You must provide your password.");
        }
        else if (empty($_POST["confirmation"]) || $_POST["password"] != $_POST["confirmation"])
        {
            apologize("You must confirm your password.");
        }

        // register the user
        $rows = query("INSERT INTO users (username, hash) VALUES(?, ?)", $_POST["username"], crypt($_POST["password"]));

        // if registration failed, apologize to the user
        if ($rows === false)
        {
            apologize("Something went wrong. Please try again.");
        }
        else
        {
            // remember that user's now logged in by storing user's ID in session
            $rows = query("SELECT LAST_INSERT_ID() AS id");
            $id = $rows[0]["id"];
            $_SESSION["id"] = $id;

            // create a new copy of the default profile picture
            $src = "img/default.jpg";
            $dst = "img/" . $id . ".jpg";
            if (copy($src, $dst))
            {
                // save the name of the new photo
                $rows = query("UPDATE users SET photo = ? WHERE id = ?", $dst, $id);
                if ($rows === false) 
                {
                    apologize("Something went wrong. Please try again.");
                }

                // update its permissions
                chmod($dst, 0644);
            }
            else
            {
                apologize("Something went wrong. Please try again.");
            }

            // redirect to profile
            redirect("edit.php");
        }
    }
    else
    {
        // else render form
        render("register_form.php", array("title" => "Register"));
    }

?>
