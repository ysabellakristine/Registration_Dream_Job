<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>database eme</title>
    <link rel="stylesheet" href="styles.css"> 
</head>
    <div class = "container">
    <h1>ヾ(＠⌒ー⌒＠)ノWelcome to the user registration for data administrators!</h1>
    <hr>
    <h2>Input your data below</h2>
    <form action="main/handleForms.php" method="POST">
    <p><label for="firstName">First Name</label> <input type="text" name="firstName"></p>
		<p><label for="lastName">Last Name</label> <input type="text" name="lastName"></p>
		<p><label for="gender">Gender</label> <input type="text" name="gender"></p>
		<p><label for="yearLevel">Year Level</label> <input type="text" name="yearLevel"></p>
		<p><label for="section">Section</label> <input type="text" name="section"></p>
		<p><label for="adviser">Adviser</label> <input type="text" name="adviser"></p>
		<p><label for="religion">Religion</label> <input type="text" name="religion">
			<input type="submit" name="insertNewStudentBtn">
		</p>
	</form>
</div>
</body>
</html>
