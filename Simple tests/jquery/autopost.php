<form id='target'>
	<input type="text" name="one" value='hello there' style='vertical-align: middle;'>
	<img src="spinner" src="spinner.gif" height="25" style="vertical-align: middle; display: none;">
</form>
<div id="result"></div>

<script type="text/javascript">
	$('#target').change(function (event) {
		event.preventDefault();
		$('#spinner').show();
		var form = $('#target');
		var txt = form.find('input[name="one"]').val();
		window.console && console.log('Sending POST');
		$.post('autopost.php', {'val': txt}, 
			function(data) {
				window.console && console.log(data);
				$('#result').empty().append(data);
				$('#spinner').hide();
			}).error(function () {
				window.console && console.log('Error');
			});
			return false;
	});
</script>