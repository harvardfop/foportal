<div id="grid">
	<?
		foreach ($profiles as $profile)
		{
			echo "<div class='media'>";
				echo "<a class='pull-left'>";
					echo "<img class='media-object img-rounded' src='" . $profile["photo"] . "' alt='picture' height='150px'>";
				echo "</a>";
				echo "<div class='media-body'>";
					echo "<h4 class='media-heading'>" . $profile["first"]  . " " . $profile["last"] . "</h4>";
            		echo "<p>" . $profile["year"] . "</p>";
            		echo "<p>" . $profile["house"] . "</p>";
            		echo "<p>" . $profile["at_college"] . "@college.harvard.edu</p>";
            		echo "<p>" . nl2br(htmlspecialchars($profile["bio"])) . "</p>";
				echo "</div>";
			echo "</div>";
		}
	?>
</div>