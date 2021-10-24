<!DOCTYPE html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>寶可夢中心</title>
	<style>
		.text1{
			background-color: #525252;
			color: white;
		}
		.text2{
			background: #C3B5D4;
		}
		body{
			height: 100vh;
			padding: 0;
			margin: 0;
		}
		.table1{
			width: 100%;
			height: 100%;
		}
		a{
			color: #525252;
			text-decoration: none;
		}
		a:hover{
			color: white;
		}
	</style>
</head>
<body>
	<table border="5" class="table1">
		<tr height="100"><td colspan="3" align="center" class="text1"><font size="7">寶可夢中心</font><br>
			<?php
				// 接收帳號資料
				$idname=$_POST["idname"];
				echo '會員：'.$idname;
	
				ob_start();  //開啟輸出暫存器
        		session_id($idname);   //指定session_ID
        		session_start();       //啟動session
		    ?>
		</td></tr>
			<tr align="center">
			<td valign="top" width="180" class="text2">
				<br><br>
				<font size="6">
					<?php
					echo '<a href="001.php?idname'.$idname.'" target="main">精靈兌換</a><br><br>';
					echo '<a href="002.php?idname='.$idname.'" target="main">食品兌換</a><br><br>';
					echo '<a href="003.php?idname='.$idname.'" target="main">精靈球</a><br><br>';
					?>
				</font>
			</td>
			<td>
				<iframe name="main" src="001.php" width="100%" height="100%"></iframe>
			</td>
			<td width="100" class="text2">
				<iframe name="cart" src="cart.php" height="100%"></iframe>
			</td>
		</tr>
	</table>

</body>
</html>