<div id="grid">
	<?
		foreach ($profiles as $profile)
		{
			echo "<div id='" . $profile["username"] . "' class='row'>";

			echo "<div class='col-md-3 col-md-offset-3 profile-picture'><img src='" . $profile["photo"] . "' alt='picture' class='img-rounded' height='100px'/></div>";
            echo "<div class='col-md-3 profile-info'>";
            echo "<p>" . $profile["first"]  . " " . $profile["last"] . "</p>";
            echo "<p>" . $profile["year"] . "</p>";
            echo "<p>" . $profile["house"] . "</p>";
            echo "</div>";

            echo "</div>";
		}
	?>
</div>