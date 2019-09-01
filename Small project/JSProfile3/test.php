<!DOCTYPE html>
<html>
<head>
	<title>test</title>
	<?php require_once "head.php" ?>
</head>
<body>
	<input type="text" class="test" name="test">
	<!-- <input type="text" id="birds" name="birds"> -->
</body>
<script type="text/javascript">
	var test = ["haha", "hehe", "dandan"];
	$( ".test" ).autocomplete({
		source: test
	});
	// $( ".test" ).autocomplete({
	//   	source: [ "c++", "java", "php", "coldfusion", "javascript", "asp", "ruby" ]
	// 	// response: function(event, ui) { 
	// 	// 	console.log(ui);
	// 	// };
	// });

	$.getJSON("school.php", function (data) {
		$( ".test" ).autocomplete({
			source: data
		});
	})

</script>
</html>