<form enctype="multipart/form-data" action="edit.php" method="post">
    <fieldset>
        <div class="form-group">
            <input class="form-control" name="photo" placeholder="Photo" type="file">
        </div>
        <div class="form-group">
            <input class="form-control" name="first" placeholder="First Name" type="text" <? echo "value='" . $profile["first"] . "'"?>>
        </div>
        <div class="form-group">
            <input class="form-control" name="last" placeholder="Last Name" type="text" <? echo "value='" . $profile["last"] . "'"?>>
        </div>
        <div class="form-group">
            <input class="form-control" name="year" placeholder="Year" type="text" <? echo "value='" . $profile["year"] . "'"?>>
        </div>
        <div class="form-group">
            <input class="form-control" name="at_college" placeholder="@college Email" type="text" <? echo "value='" . $profile["at_college"] . "'"?>>
        </div>
        <div class="form-group">
            <input class="form-control" name="house" placeholder="House" type="text" <? echo "value='" . $profile["house"] . "'"?>>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-default">Submit</button>
        </div>
    </fieldset>
</form>
