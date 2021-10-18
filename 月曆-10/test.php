<?php
    $connection = mysqli_connect("localhost", "wda11s04_calendar", "58ipdwjfca", "wda11s04_calendar"); //連線資料庫
    if(!$connection){ //如果連線失敗
        die("There was an error connecting to the database."); //網頁宣告到此die，並在網頁輸出…
    }
    function db_updateTheme($newTheme){
        global $connection;
        $query = "UPDATE theme SET cur_theme = '$newTheme' WHERE id = 1"; //更新theme資料表格中，id欄位值為1的資料列中的cur_theme欄位值為$newTheme
        $result = mysqli_query($connection, $query); //送出SQL查詢
        if(!$result){ //查詢失敗的話…
            die("Query failed: " . mysqli_error($connection));
          }
        }
    if(isset($_GET['color'])){ //透過關聯陣列$_POST['color']取得傳送過來的color資料
      db_updateTheme($_GET['color']); //呼叫db_updateTheme方法
    }
?>  