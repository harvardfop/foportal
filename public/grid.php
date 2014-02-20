<?php
	
    // configuration
    require("../includes/config.php");

    // query database for user
    $rows = query("SELECT username FROM users WHERE id = ?", $_SESSION["id"]);
	
	// if we found user, store username
    if (count($rows) == 1)
    {
    	$username = $rows[0]["username"];
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
            $profiles[$index]["photo"] = $row["photo"];
            $profiles[$index]["first"] = $row["first"];
            $profiles[$index]["last"] = $row["last"];
            $profiles[$index]["year"] = $row["year"];
            $profiles[$index]["house"] = $row["house"];
    	}
    }
    else
    {
        pologize("Something went wrong. Please try again.");
    }

    render("grid_view.php", ["title" => "Home", "username" => $username, "profiles" => $profiles]);

?>