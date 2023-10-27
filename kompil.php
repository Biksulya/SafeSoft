<html>
<!DOCTYPE html>
<html>
<head>
	<title>PHP Code Executor</title>
	<style>
		body {
			font-family: Arial, sans-serif;
		}
		textarea {
			width: 500px;
			height: 300px;
		}
	</style>
	<script>
	</script>
</head>
<body>
<form method="post" action="">
	<h1>Python Code Executor</h1>
	<textarea id="code"
	          name="code"
	          placeholder="Введите код Python"
	          class="result"><?php echo !empty($_POST["code"]) ? $_POST['code'] : '' ?></textarea>
	<br /><br />
	<button type="submit">Выполнить</button>
</form>

Результат:
<?php
if (!empty($_POST["code"])) {
?>
	<div>
		<?php
		
		$pythonCode = $_POST["code"];

		
		$fileName = 'test.py';

		file_put_contents($fileName, $pythonCode);

		
		$command = "python $fileName";
		$output = shell_exec($command);

		
		echo $output;

		
		unlink($fileName);
		?>
	</div>
<?php } ?>
</body>
</html>