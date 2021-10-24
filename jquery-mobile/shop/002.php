<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>食品兌換</title>
	<style type="text/css">
		.bg1{
			background: #EECDCE;
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
		<tr><td><div align="center"><font size="6">食品兌換</font>
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

		$data=array(0=>array("011","吐司麵包","pokemon/001.png","60","澱粉","011"),
					1=>array("012","通心粉","pokemon/002.png","60","澱粉","012"),
					2=>array("013","特選蘋果","pokemon/003.png","80","蔬果","013"),
					3=>array("014","洋芋片","pokemon/004.png","30","點心","014"),
					4=>array("015","炸物拼盤","pokemon/005.png","180","點心","015"),
					5=>array("016","新鮮的蛋","pokemon/006.png","30","蛋白","016"),
					6=>array("017","哞哞鮮奶","pokemon/007.png","100","蛋白","017"),
					7=>array("018","即時咖哩","pokemon/008.png","150","主食","018"),
					8=>array("019","杯麵","pokemon/009.png","50","點心","019"),
					9=>array("020","罐頭","pokemon/010.png","30","主食","020"));
	
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