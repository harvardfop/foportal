<div id="grid">
	<?
		foreach ($profiles as $profile)
		{
			echo "<div id='" . $profile["username"] . "' class='row'>";

			echo "<div class='col-md-3 col-md-offset-3 right'><img src='" . $profile["photo"] . "' alt='picture' class='img-rounded' height='100px'/></div>";
            echo "<div class='col-md-3 left'>";
            echo "<p><strong>" . $profile["first"]  . " " . $profile["last"] . "</strong></p>";
            echo "<p>" . $profile["year"] . "</p>";
            echo "<p>" . $profile["house"] . "</p>";
            echo "<p>" . $profile["at_college"] . "@college.harvard.edu</p>";
            echo "</div>";

            echo "</div>";
		}
	?>
</div>