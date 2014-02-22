
<form enctype="multipart/form-data" action="edit.php" method="post">
    <fieldset>
        <?
            foreach ($fields as $field)
            {
                $f = $field["field"];

                // format for all input fields
                if (strcmp("photo", $f) != 0)
                {
                    echo "<div class='input-group'>";
                    echo "<span class='input-group-addon'>" . $field["long"] . "</span>";
                    
                    // format select for house list
                    if (strcmp("house", $f) == 0)
                    {
                        echo "<select class='form-control' name='" . $f . "'><option></option>";
                        foreach ($houses as $house)
                        {
                            echo "<option value='" . $house . "'";
                            if (strcmp($profile[$f], $house) == 0)
                            {
                                echo "selected='selected'";
                            }
                            echo ">" . $house . "</option>";
                        }
                        echo "</select>";
                    }

                    // format textarea for bio paragraph
                    else if (strcmp("bio", $f) == 0)
                    {
                        echo "<textarea class='form-control' name='" . $f . "' rows='5'>";
                        if (empty($profile[$f]))
                        {
                            echo $field["example"];
                        }
                        else
                        {
                            echo htmlspecialchars($profile[$f]);
                        }
                        echo"</textarea>";

                        
                    }

                    // else add input field
                    else
                    {
                        echo "<input class='form-control' name='" . $f . "' type='text' placeholder='" . $field["example"] . "' value='" . $profile[$f] . "'>";
                    }

                    // add text at the end for email address field
                    if (strcmp("at_college", $f) == 0)
                    {
                        echo "<span class='input-group-addon'>@college.harvard.edu</span>";
                    }

                    echo "</div>";
                }

            }
            
            // format photo upload input
            $field = $fields[4];
            echo "<br><div>Upload a new profile picture below.<br>(Your picture should be either a JPEG or PNG file<br>
                and have <a href='//www.noproblemmac.com/blog/2013/03/11/preview-the-fastest-way-to-crop-an-image-on-your-mac/'
                target='_blank'>equal width and height dimensions</a>.)</div>";
            echo "<input class='form-control' name='" . $field["field"] . "' type='file'>";
        ?>
        <div class="form-group">
            <button type="submit" class="btn btn-default">Submit</button>
        </div>
    </fieldset>
</form>
