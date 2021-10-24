<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>精靈兌換</title>
	<style type="text/css">
		.bg1{
			background: #CDDFCE;
		}
		.block{
			text-align: center;
			float: left;
			margin-left: 30px;
			margin-top: 30px;

		}
		.btn{
			position: absolute;
			bottom: 0;
			right: 50%;
		}
	</style>
</head>
<body>	
	<table>
		<tr><td><div align="center"><font size="6">精靈兌換</font>
	<?php
		//接收帳號資料
		if(isset($_GET["idname"])){
			$idname=$_GET["idname"];
		 	session_id($idname);
		 	session_start();
		}
	  	else{
			session_start();
			$idname=session_id();
	  	}

		$data=array(0=>array("001","妙蛙種子","pokemon/01.png","100","草系","001"),
					1=>array("002","小火龍","pokemon/02.png","100","火系","002"),
					2=>array("003","傑尼龜","pokemon/03.png","100","水系","003"),
					3=>array("004","呆呆獸","pokemon/04.png","150","水/超能系","004"),
					4=>array("005","伊布","pokemon/05.png","180","一般系","005"),
					5=>array("006","菊草葉","pokemon/06.png","120","草系","006"),
					6=>array("007","火球鼠","pokemon/07.png","120","火系","007"),
					7=>array("008","小鉅鱷","pokemon/08.png","120","水系","008"),
					8=>array("009","貓頭夜鷹","pokemon/09.png","300","飛行/一般系","009"),
					9=>array("010","天然鳥","pokemon/10.png","300","飛行/超能系","010"));
	
		//讀取已購物資料，修正數量
	  	$prno=array(0,0,0,0,0,0,0,0,0,0);
	  	if(isset($_SESSION["evershop"])){
			 //讀取已購物品項資料
			$evershop=$_SESSION["evershop"];          //已購物品項資料
			$evershopnu=$_SESSION["evershopnu"];      //已購物品項數量
			//判斷並修改購買數量
				for($x=0;$x<$evershopnu;$x++){
					for($y=0;$y<10;$y++)
					{
						if($evershop[$x][0]==$data[$y][0])
						{
							$prno[$y]=$evershop[$x][3];
						}
					}
			   }
		}
		//設定表單傳送資料	
		echo '<form name="pokemon" method="post" action="cart.php" target="cart">';   
		echo '<input type="hidden" name="idname" value="'.$idname.'">';                         //傳送 session_id() 帳號
		echo '<input type="hidden" name="goodsnu" value="10">';                                 //傳送貨品數量(如從資料庫中讀取,可獲得讀取資料筆數)
			for($x=0;$x<=9;$x++)
			{
				echo '<input type="hidden" name="new'.$x.'0" value="'.$data[$x][0].'">';          //傳送貨品編號
				echo '<input type="hidden" name="new'.$x.'1" value="'.$data[$x][1].'">';          //傳送貨品名稱
				echo '<input type="hidden" name="new'.$x.'2" value="'.$data[$x][3].'">';          //傳送貨品單價
			}
		  
			for($x=0;$x<=9;$x++)
			{
				echo '<table border="5" class="block" width="200">';
				echo '<tr align="center"><td>'.$data[$x][0].'</td></tr>';
				echo '<tr align="center"><td>'.$data[$x][1].'</td></tr>';
				echo '<tr><td class="bg1"><img src="'.$data[$x][2].'" width="150" height="150"></td></tr>';
				echo '<tr align="center"><td>兌換：'.$data[$x][3].'點</td></tr>';
				echo '<tr align="center"><td>'.$data[$x][4].'</td></tr>';
				$name="new".$x."3";
				echo '<tr align="center"><td>購買<input type="text" name="'.$name.'" value="'.$prno[$x].'" size="4">個</td></tr>';
				echo '</table>';
			}
	?>
		   </div>
		   </td></tr>
		   <tr><td align="center">
			   <br><br>
			   <input type="submit" name="send" value="加入購物車">
			   <br>
			</td></tr>
		   </table>
		   </form>

</body>
</html>