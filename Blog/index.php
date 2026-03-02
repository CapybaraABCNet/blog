<?php
try {
	$pdo = new PDO('mysql:host=localhost;dbname=cart;port=3309', 'root', 'root');
} catch (PDOException $e) {
	die('Error' . $e->getMessage());
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-8'>
		<meta name='viewport'content='width=device-width, initial-scale=1.0'>
		<title>Персональный сайт Хуснутдинова Нияза</title>
		<style>
			body {
	background-color: white;
	color: black;
	font-family: 'Courier New', monospace;
	margin: 0;
	padding: 0;
}
header {
	background: linear-gradient(90deg, rgba(0, 255, 208), rgba(0, 255, 13));
	text-align: center;
	color: white;
	box-shadow:  0 4px 20px rgba(0, 0, 0, 0.1);
	padding: 20px;
	margin: 0 auto;
}
.container {
	text-align: center;
	background-color: white;
	border-radius: 10px;
	box-shadow:  0 4px 20px rgba(0, 0, 0, 0.1);
	padding: 20px;
	margin: 0 auto;
}
.text {
	color: black;
	text-align: center;
	opacity: 0;
	transform: translateY(-50px);
	animation: appear 2s forwards; 
}
img {
	width: 250px;
	border-radius: 15px;
	opacity: 0;
	transform: translateY(-50px);
	animation: appear 2s forwards; 
}
@keyframes appear {
	from {
		opacity: 0;
		transform: translateY(-50px);
	}
	to {
		opacity: 1;
		transform: translateY(0);
	}
}

		</style>
	</head>
	<body>
		<header>
			<h1>Хуснутдинов Нияз</h1>
			<em>Программист, Создатель сайтов</em>
		</header>
		<br>
		<div class="container">
			<br><br>
			<strong>Привет! Это я, Хуснутдинов Нияз, и вот мои достижения:</strong>
			<ol start="0">
				<li>Создавать сайты на HTML, CSS и JS</li>
				<li>Добавлять к сайтам PHP с MySQL (для форумов и т.д.</li>
				<li>Я продал сайт в 12 лет</li>
				<li>Занял в олимпиаде по питону 2 место</li>
				<li>Умею делать мини программы на языках таких как: C++, C#, Python, Lua и Pascal</li>
				<li>Рассказывал в школе про мой сайт</li>
				<b>И многое другое!</b>
			</ol>
		</div>
		<div class="text">
			<h2>Мой блог:</h2>
			<br><br><br>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$parol = $_POST['parol'];
	$parol1 = '3ce30011835c6047a2a36cf5ae7cb47bc6ee3e974a742be132882a532c659455';
	$title = trim($_POST['title']);
	$photo = trim($_POST['photo']);
	$text = trim($_POST['text']);

	if (empty($title) || empty($photo) || empty($text)) {
		die('Error' . $e->getMessage());
	}
	try {

		if (!password_verify($parol, $parol1)) {
	    
	    	$sql = 'INSERT INTO blog(title, photo, `text`) VALUES(?, ?, ?)';
	    	$query = $pdo->prepare($sql);
	    	$query->execute([$title, $photo, $text]);
	    	header('Location: index.php');
	    	exit();
	    } else {
	    	echo "error";
	    }
	} catch (PDOException $e) {
		die('Error' . $e->getMessage());
	}
}

try {
	$sql = 'SELECT title, photo, `text` FROM blog ORDER BY id DESC';
	$query = $pdo->prepare($sql);
	$query->execute();
	$c = $query->fetchAll(PDO::FETCH_OBJ);
	foreach ($c as $b) {
		echo '
		<div class="container">
		
		    <h2>'.htmlspecialchars($b->title).'</h2>
		    <img src="'.htmlspecialchars($b->photo).'">
		    <p>'.htmlspecialchars($b->text).'</p>
		    
		</div>
		<br><br>';
	}
} catch (PDOException $e) {
	die('Error' . $e->getMessage());
}
?>
		</div>
		<div class="container">
			<form method="post" action="index.php">
				<label>Parol</label>
				<input type="number" name="parol">
				<label>Title</label>
				<input type="text" name="title">
				<label>photo</label>
				<input type="text" name="photo">
				<label>text</label>
				<input type="text" name="text">
				<button>reg</button>
			</form>
		</div>
	</body>
</html>