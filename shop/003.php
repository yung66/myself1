<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>精靈球</title>
	<style type="text/css">
		.bg1{
			background-color: #D1E5EB;
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
		<tr><td><div align="center"><font size="6">精靈球兌換</font>
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

		$data=array(0=>array("021","精靈球","pokemon/0001.png","30","捕捉率低","011"),
					1=>array("022","超級球","pokemon/0002.png","60","捕捉率中","012"),
					2=>array("023","高級球","pokemon/0003.png","90","捕捉率中","013"),
					3=>array("024","大師球","pokemon/0004.png","10000","必定捕捉","014"),
					4=>array("025","狩獵球","pokemon/0005.png","120","森林捕捉","015"),
					5=>array("026","等級球","pokemon/0006.png","120","捕捉率中","016"),
					6=>array("027","月亮球","pokemon/0007.png","120","夜晚捕捉","017"),
					7=>array("028","紀念球","pokemon/0008.png","1000","捕捉率高","018"),
					8=>array("029","潛水球","pokemon/00009.png","130","水中捕捉","019"),
					9=>array("030","豪華球","pokemon/0010.png","3000","捕捉率高","020"));
	
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