<?php

    // configuration
    require("../includes/config.php"); 

    // query database for user
    $rows = query("SELECT * FROM users WHERE id = ?", $_SESSION["id"]);

    // if we couldn't find the user, apologize
    if (count($rows) != 1)
    {
        apologize("Something went wrong. Please try again.");
    }

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
        if ($_FILES["photo"]["error"] > 0 && $_FILES["photo"]["error"] != UPLOAD_ERR_NO_FILE)
        {
            apologize("You must choose a file to upload.");
        }
        else if (empty($_POST["first"]))
        {
            apologize("You must provide your first name.");
        }
        else if (empty($_POST["last"]))
        {
            apologize("You must provide your last name.");
        }
        else if (empty($_POST["year"]))
        {
            apologize("You must provide your year.");
        }
        else if (empty($_POST["at_college"]))
        {
            apologize("You must provide your @college email.");
        }
        else if (empty($_POST["house"]))
        {
            apologize("You must provide your house.");
        }

        // update the user's information
        $rows = query("UPDATE users SET first = ?, last = ?, year = ?, at_college = ?, house = ? WHERE id = ?",
            $_POST["first"], $_POST["last"], $_POST["year"], $_POST["at_college"], $_POST["house"], $_SESSION["id"]);

        // move the uploaded file
        if (!$_FILES["photo"]["error"])
        {
            $dst = "img/" . $_SESSION["id"] . ".jpg";
            if (!move_uploaded_file($_FILES["photo"]["tmp_name"], $dst))
            {
                apologize("Something went wrong. Please try again.");
            }
            else
            {
                // update file's permissions
                chmod($dst, 0644);
            }
        }

        // redirect to home
        redirect("/");
    }
    else
    {
        // else render form
        render("edit_form.php", ["title" => "Edit Profile", "username" => $rows[0]["username"], "profile" => $rows[0]]);
    }

?>
