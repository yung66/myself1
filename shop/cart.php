<html>
   <head>
      <title>購物車</title>
   </head>
   <style>
	   table{
		text-align: center;

	   }
   </style>
   <body>
	   <center>
      <h2>購物車</h2>
<?php
///////////  判斷是否已有購物資料  //////////////
  if((!(isset($_SESSION["evershop"]))) and (!(isset($_POST["goodsnu"]))))
  {
     echo "目前無購物資料<br>";
  }
  else    //已有購物資料
  {
    //////////// 接收傳送購物資料 //////////////
      $goodsnu=$_POST["goodsnu"];    //接收最新購物資料
      $idname=$_POST["idname"];      //接收會員帳號
         session_id($idname);
         session_start(); 

      for($x=0;$x<$goodsnu;$x++)     //接收本次購物資料廻圈
      {
         for($y=0;$y<4;$y++)
         {
            $name="new".$x.$y;         
            @$newshop[$x][$y]=$_POST[$name];
         }                 
      }

  ///////////////  判斷是否已有購物資料 ///////////////////////////////
      if(!(isset($_SESSION["evershop"])))   //(初次購物)没有已購物資料
      {
         ////////// 愓除數量為0的項目 //////////////////////
         $np=0;
         for($x=0;$x<$goodsnu;$x++)     
         {
           if($newshop[$x][3]<>0)     //項目有購，進行轉檔
           {
               for($y=0;$y<4;$y++)
               {
                   $evershop[$np][$y]=$newshop[$x][$y];
               }
               $np++;
           }
         }      
      
         $_SESSION["evershop"]=$evershop; //存入購買品項內容
         $_SESSION["evershopnu"]=$np; //存入購買品項數量
        


      }
      else    //已有購物資料
      {
         //////// 讀取已購物品項資料 //////////////////////////////////
            $evershop=$_SESSION["evershop"];             //已購物品項資料
            $evershopnu=$_SESSION["evershopnu"];         //已購物品項數量
         ///////  進行購物品項資料更新   //////////////////////////////
            for($x=0;$x<$goodsnu;$x++)     //本次購買品項
            {
                 for($y=0;$y<$evershopnu;$y++)
                 { 
                    if($newshop[$x][0]==$evershop[$y][0])  //已有購物，進行數量資料變動
                    {
                        $evershop[$y][3]=$newshop[$x][3];
                        $newshop[$x][3]=0;                 //新增購物資料歸零        
                    }
                 }
             }        

         ////////// 新增購物數量非零項目加入購物車 //////////////////////
         $np=0;
         for($x=0;$x<$goodsnu;$x++)     
         {
           if($newshop[$x][3]<>0)     //項目有購，進行轉檔
           {
               for($y=0;$y<4;$y++)
               {
                   $evershop[$evershopnu+$np][$y]=$newshop[$x][$y];
               }
               $np++;
           }
         }  
         ////////// 愓除購物車數量為0的項目 //////////////////////
         $newnu=$evershopnu+$np;
         $np=0;
         for($x=0;$x<$newnu;$x++)     
         {
           if($evershop[$x][3]<>0)     //項目有購，進行轉檔
           {
               for($y=0;$y<4;$y++)
               {
                   $tem[$np][$y]=$evershop[$x][$y];
               }
               $np++;
           }
         }   
            $_SESSION["evershop"]=$tem; //存入購買品項內容
            $_SESSION["evershopnu"]=$np; //存入購買品項數量
            $evershop=$_SESSION["evershop"];
      }
/////////////////////  顯示購物車內容  //////////////////////////////////////////
     echo '<table border="5"><tr><td>編號</td><td>品名</td><td>單價</td><td>數量</td><td>合計</td></tr>';   
     $total=0;
     for($x=0;$x<$np;$x++)
     {
        echo '<tr>';
        for($y=0;$y<4;$y++)
        {
           echo '<td>'.$evershop[$x][$y].'</td>';
        }
          $pay=$evershop[$x][2]*$evershop[$x][3];
          echo '<td>'.$pay.'</td>';
          $total+=$pay;
     }
        echo '<tr><td colspan="5">購物金額總計：'.$total.'元</td></tr></table>';
  }
////////////////////////////////////////////////

echo "<br><br><font style='color:#885353;'>店員小提醒：如需修改購物內容，請至商品區修改，謝謝光臨！";



?>
   </body>
</html>