<html>
	<head>
		<meta http-equiv="content-type"
				content="text/html; charset=utf-8">
		<title>PHP Sample</title>
	<style>
		h2{
			font-weight:bold;
			border-style:none none solid solid;
			border-width:0px 0px 3px 7px;
			border-color:#0000ff;
			padding:5px 0px 0px 0px;
			color:#000066;
			background-color:#ddddff;
			width:90%;
		}
		h3{
			width:90%;
			margin-left:5%;
		}
		p{
			border-style:groove groove groove groove;
			border-width:3px 3px 3px 7px;
			border-color:#aaaaff;
			margin-left:5%;
			padding:5px 5px 5px 5px;
			color:#000033;
			background-color:#eeeeff;
			width:80%;
		}
		h4 {
			text-align:right;
			width:85%;			
		}
	</style>
	</head>
	<body>
	
<?php
	$id = htmlspecialchars($_GET['id']);
	$query1 = "select count(*) from myblog where id=" . $id;
	$query2 = "select * from myblog where id=" . $id;
	try {
		$pdo = new PDO("mysql:host=localhost; dbname=phpdata","root", "");
		$stmt = $pdo->query($query1);
		$n = $stmt->fetch(PDO::FETCH_ASSOC);
		if ($n['count(*)'] == 0){
			echo "データが見つかりませんでした。" ;
		} else {
			showAllMySQLData($pdo->query($query2));
		}
	}catch (PDOException $e){
		echo "ERROR: " . $e->getMessage();
	}
	$pdo = null;
	
	function showAllMySQLData($stmt){
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			$id = $row['id'];
			$title = $row['title'];
			$abstract = $row['abstract'];
			$content = $row['content'];
			$content = preg_replace("/\r\n/","<br/>",$content);
			$uptime = date('Y年 m月 d日',strtotime($row['uptime']));
			echo "<h2>" . $title . "　<font size=-1>[" . $id . "]</font></h2>";
			echo "<h3>" . $abstract . "</h3>";
			echo "<p>" . $content . "</p>";
			echo "<h4>" . $uptime . "</h4>";
			echo "<br/><br/>";
		}
	} 
	
?>

	</body>
</html>
