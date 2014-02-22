
<form enctype="multipart/form-data" action="edit.php" method="post">
    <fieldset>
        <?
            foreach ($fields as $field)
            {
                $f = $field["field"];
                
                // format select fields
                if (strcmp("house", $f) == 0)
                {
                    echo "<div class='form-group row'>";
                    echo "<div class='col-md-3 col-md-offset-3 right field-label'>" . $field["long"] . ":</div>";
                    echo "<div class='col-md-6 left'><select class='form-control' name='" . $f . "'>";
                    echo "<option></option>";
                    foreach ($houses as $house)
                    {
                        echo "<option value='" . $house . "'";
                        if (strcmp($profile[$f], $house) == 0)
                        {
                            echo "selected='selected'";
                        }
                        echo ">" . $house . "</option>";
                    }
                    echo "</select></div></div>";
                }

                // default format for fields
                else if (strcmp("photo", $f) != 0)
                {
                    echo "<div class='form-group row'>";
                    echo "<div class='col-md-3 col-md-offset-3 right field-label'>" . $field["long"] . ":</div>";
                    echo "<div class='col-md-6 left'><input class='form-control' name='" . $f . "'
                    type='text' placeholder='" . $field["example"] . "' value='" . $profile[$f] . "'>";
                    
                    // add text at the end for email address field
                    if (strcmp("at_college", $f) == 0)
                    {
                        echo "@college.harvard.edu";
                    }

                    echo "</div></div>";
                }

            }

            // format photo upload input
            $field = $fields[4];
            echo "<div class='form-group'>";
            echo "<div>" . $field["long"] . "</div><br>";
            echo "<div><img src='" . $profile[$field["field"]] . "' alt='picture' class='img-rounded' height='100px'/></div><br>";
            echo "<div>Upload a new profile picture:<br>(Your picture should be either a JPEG or PNG file<br>
                and have <a href='//www.noproblemmac.com/blog/2013/03/11/preview-the-fastest-way-to-crop-an-image-on-your-mac/'
                target='_blank'>equal width and height dimensions</a>.)</div><br>";
            echo "<input class='form-control' name='" . $field["field"] . "' type='file'>";
            echo "</div>";
        ?>
        <div class="form-group">
            <button type="submit" class="btn btn-default">Submit</button>
        </div>
    </fieldset>
</form>
