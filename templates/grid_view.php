<div id="filters">
	<script>
		$(document).ready(function() {
			// sort profiles by first name
			$("#filters button:eq(0)").on("click", function() {
				$(".media").tsort("div h4 span:eq(0)");
				$(this).removeClass("btn-default");
				$(this).addClass("btn-primary active");
			});

			// sort profiles by last name
			$("#filters button:eq(1)").on("click", function() {
				$(".media").tsort("div h4 span:eq(1)");
			});

			// sort profiles by class year
			$("#filters button:eq(2)").on("click", function() {
				$(".media").tsort("div p:eq(0)", "div h4 span:eq(0)");
			});

			// sort profiles by house or dorm
			$("#filters button:eq(3)").on("click", function() {
				$(".media").tsort("div p:eq(1)", "div h4 span:eq(0)");
			});

			// make button active
			$("#filters button").on("click", function() {
				$("#filters button").removeClass("btn-primary active")
					.addClass("btn-default");
				$(this).addClass("btn-primary active");
			});

			// start with first name button selecte
			$("#filters button:eq(0)").addClass("btn-primary active");
		});
	</script>
	<div class="btn-group">
  		<button type="button" class="btn btn-default">First</button>
  		<button type="button" class="btn btn-default">Last</button>
  		<button type="button" class="btn btn-default">Class</button>
  		<button type="button" class="btn btn-default">House</button>
	</div>
</div>
<div id="grid">
	<?
		foreach ($profiles as $profile)
		{
			echo "<div class='media'>";
				echo "<a class='pull-left'>";
					echo "<img class='media-object img-rounded' src='" . $profile["photo"] . "' alt='picture' height='150px'>";
				echo "</a>";
				echo "<div class='media-body'>";
					echo "<h4 class='media-heading'><span class='first'>" . $profile["first"] .
						"</span> <span class='last'>" . $profile["last"] . "</span></h4>";
            		echo "<p>" . $profile["year"] . "</p>";
            		echo "<p>" . $profile["house"] . "</p>";
            		echo "<p>" . $profile["at_college"] . "@college.harvard.edu</p>";
            		echo "<p>" . nl2br(htmlspecialchars($profile["bio"])) . "</p>";
				echo "</div>";
			echo "</div>";
		}
	?>
</div>