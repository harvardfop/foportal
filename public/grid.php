<?php
	
    // configuration
    require("../includes/config.php");

    // query database for user
    $rows = query("SELECT * FROM users WHERE id = ?", $_SESSION["id"]);

    if (count($rows) == 1)
    {
        // redirect to edit page if there's missing information
        if (empty($rows[0]["first"]) || empty($rows[0]["last"]) || empty($rows[0]["year"])
            || empty($rows[0]["at_college"]) || empty($rows[0]["house"]))
        {
            redirect("edit.php");            
        }
        // if we found user, store username
        else
        {
            $username = $rows[0]["username"];
        }
    }
    else
    {
        apologize("Something went wrong. Please try again.");
    }

    // query database for all users
    $rows = query("SELECT * FROM users ORDER BY last ASC");
	
	// store information for all users
    if (count($rows) >= 1)
    {
    	foreach ($rows as $index => $row)
    	{
            $profiles[$index]["username"] = $row["username"];
            foreach ($fields as $field)
            {
                $f = $field["field"];
                $profiles[$index][$f] = $row[$f];
            }
    	}
    }
    else
    {
        apologize("Something went wrong. Please try again.");
    }

    render("grid_view.php", array("title" => "Home", "username" => $username, "profiles" => $profiles));

?>