<?php

    // configuration
    require("../includes/config.php"); 

    // ensure string contains only alphabetic characters
    function validate_text($str)
    {
        $valid = array("-", " ");
        if (ctype_alpha(str_replace($valid, "", $str)))
        {
            return true;
        }
        return false;
    };

    // ensure string contains only four integers
    function validate_year($str)
    {
        $valid = array("");
        if (ctype_digit(str_replace($valid, "", $str)) && strlen($str) == 4)
        {
            return true;
        }
        return false;
    }; 

    // ensure string contains only alphabetic characters
    function validate_at_college($str)
    {
        $valid = array("");
        if (ctype_alnum(str_replace($valid, "", $str)))
        {
            return true;
        }
        return false;
    };  

    // ensure string is a valid house
    function validate_house($str, $houses)
    {
        if (in_array($str, $houses))
        {
            return true;
        }
        return false;
    }

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
        
        // validate data entry fields
        if (empty($_POST["first"]) || !validate_text($_POST["first"]))
        {
            apologize("You must provide a valid first name.");
        }
        else if (empty($_POST["last"]) || !validate_text($_POST["last"]))
        {
            apologize("You must provide a valid last name.");
        }
        else if (empty($_POST["year"]) || !validate_year($_POST["year"]))
        {
            apologize("You must provide a valid class year.");
        }
        else if (empty($_POST["at_college"]) || !validate_at_college($_POST["at_college"]))
        {
            apologize("You must provide a valid @college email address.");
        }
        else if (empty($_POST["house"]) || !validate_house($_POST["house"], $houses))
        {
            apologize("You must provide a valid residential house or dormitory.");
        }
        else if (empty($_POST["bio"]))
        {
            apologize("You must provide a valid biography.");
        }

        // validate photo upload
        if ($_FILES["photo"]["error"] > 0 && $_FILES["photo"]["error"] != UPLOAD_ERR_NO_FILE)
        {
            apologize("You must choose a valid file to upload.");
        }

        // save the uploaded file
        if ($_FILES["photo"]["error"] != UPLOAD_ERR_NO_FILE)
        {
            $valid_types = array(IMAGETYPE_JPEG, IMAGETYPE_PNG);
            $size = getimagesize($_FILES["photo"]["tmp_name"]);
            if (!$size)
            {
                apologize("You must choose a valid file to upload.");            
            }
            else if (!in_array($size[2], $valid_types))
            {
                apologize("The image must be a JPEG or PNG file.");
            }
            else if ($size[0] != $size[1] || $size[0] < 200)
            {
                apologize("The image must have equal width and height dimensions and be at least 200px by 200px.");
            }

            // move the uploaded file
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

        // update the user's information
        $rows = query("UPDATE users SET first = ?, last = ?, year = ?, at_college = ?, house = ?, bio = ? WHERE id = ?",
            $_POST["first"], $_POST["last"], $_POST["year"], $_POST["at_college"], $_POST["house"], $_POST["bio"], $_SESSION["id"]);

        // redirect to home
        redirect("index.php");
    }
    else
    {
        // else render form
        render("edit_form.php", array("title" => "Edit Profile", "username" => $rows[0]["username"],
               "profile" => $rows[0], "fields" => $fields, "houses" => $houses));
    }

?>
