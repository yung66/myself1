<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar-PART10</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/current-day-info.css">
    <link rel="stylesheet" href="css/calendar.css">
    <link rel="stylesheet" href="css/modal.css">
    <link rel="stylesheet" href="css/portrait.css">
    <link rel="icon" href="images/icon3.png" type="image/png" sizes="72×72"/>
    <script src="https://kit.fontawesome.com/e45ac9a14a.js" crossorigin="anonymous"></script>
</head>
<body>
  <?php
    $connection = mysqli_connect("localhost", "wda11s04_calendar", "58ipdwjfca", "wda11s04_calendar"); //連線資料庫
    if(!$connection){ //如果連線失敗
        die("There was an error connecting to the database."); //網頁宣告到此die，並在網頁輸出…
    }

    function setTheme(){
      global $connection;
      $query = "SELECT * FROM theme";
      $result = mysqli_query($connection, $query);
      if(!$result){
          die("Something went wrong...`");
      }
      while($row = mysqli_fetch_assoc($result)){
          return $row['cur_theme'];
      }
    }

    function db_updateTheme($newTheme){
        global $connection;
        $query = "UPDATE theme SET cur_theme = '$newTheme' WHERE id = 1"; //更新theme資料表格中，id欄位值為1的資料列中的cur_theme欄位值為$newTheme
        $result = mysqli_query($connection, $query); //送出SQL查詢
        if(!$result){ //查詢失敗的話…
            die("Query failed: " . mysqli_error($connection));
          }
        }
    if(isset($_POST['color'])){ //透過關聯陣列$_POST['color']取得傳送過來的color資料
      db_updateTheme($_POST['color']); //呼叫db_updateTheme方法
    }

    function db_insertNote($uid, $color, $text){ //新增記事資料函式
      global $connection;
      $text = mysqli_real_escape_string($connection, $text);
      $query = "INSERT INTO notes(note_id, note_color, note_text) VALUES('$uid', '$color', '$text')";
      $result = mysqli_query($connection, $query);
      if(!$result){
          die("Something went wrong...");
      }
    }  
    if(isset($_POST['new_note_uid'])){ //前端傳來新增記事資料
      db_insertNote($_POST['new_note_uid'], $_POST['new_note_color'], $_POST['new_note_text']);
    }

    function db_updateNote($uid, $text){//更新記事資料函式
      global $connection;
      $text = mysqli_real_escape_string($connection, $text);
      $query = "UPDATE notes SET note_text = '$text' WHERE note_id = '$uid' LIMIT 1";
      $result = mysqli_query($connection, $query);
      if(!$result){
          die("Something went wrong....");
      }
  }
  if(isset($_POST['update_note_uid'])){ //若前端有傳來更新記事資料
    db_updateNote($_POST['update_note_uid'], $_POST['update_note_text']);
  }

  function db_deleteNote($uid){ //刪除記事資料函式
    global $connection;
    $query = "DELETE FROM notes WHERE note_id = '$uid'";
    $result = mysqli_query($connection, $query);
    if(!$result){
        die("Something went wrong…");
    }
  }
  if(isset($_POST['delete_note_uid'])){ //刪除記事資料
  db_deleteNote($_POST['delete_note_uid']);
  }
  ?>

    <h3 id="bg-year" class="background-text off-color">1999</h3>
    <h4 class="background-text off-color">　　Calendar</h4>
    <div id="current-day-info" class="color">
    <h1 id="app-name-landscape" class="off-color default-cursor center">Yung's Calendar</h1>
    <!-- landscape==橫式 -->
    <div>
        <h2 id="cur-year" class="current-day-heading default-cursor center">1999</h2>
    </div>
    <div class="">
        <h1 id="cur-day" class="current-day-heading default-cursor center">Monday</h1>
        <h1 id="cur-month" class="current-day-heading default-cursor center">August</h1>
        <h1 id="cur-date" class="current-day-heading default-cursor center">9</h1>
    </div>
    <div class="">
        <button type="button" name="button" id="theme-landscape" class="font button" onclick="openFavColor();">Change Theme!</button>
      </div>
    </div>
    <div id="calendar">
        <h1 id="app-name-portrait" class="center off-color">My Calendar</h1>
        <table>
            <thead class="color">
                <tr>
                    <th colspan="7" class="border-color">
                        <!-- h4#cal-year{2021} -->
                        <h4 id="cal-year">1999</h4>
                        <!-- div>h3#cal-month{August} -->
                        <div >
                            <i class="fas fa-caret-left icon"onclick="previousMonth();"></i>
                            <h3 id="cal-month">August</h3>
                            <i class="fas fa-caret-right icon" onclick="nextMonth();"></i>
                        </div>
                    </th>
                </tr>
                <tr>
                    <!-- th.weekday.border-color{Sun}*7 -->
                    <th class="weekday border-color">Sun</th>
                    <th class="weekday border-color">Mon</th>
                    <th class="weekday border-color">Tue</th>
                    <th class="weekday border-color">Wed</th>
                    <th class="weekday border-color">Thu</th>
                    <th class="weekday border-color">Fri</th>
                    <th class="weekday border-color">Sat</th>
                </tr>
            </thead>
            <!-- tbody#table-body.border-color>tr*6>td{1}*7 -->
            <tbody id="table-body" class="border-color">
                <tr>
                    <td onclick="dayClicked(this);">1</td>
                    <td onclick="dayClicked(this);">1</td>
                    <td onclick="dayClicked(this);">1</td>
                    <td onclick="dayClicked(this);">1</td>
                    <td onclick="dayClicked(this);">1</td>
                    <td onclick="dayClicked(this);">1</td>
                    <td onclick="dayClicked(this);">1</td>
                </tr>
                <tr>
                    <td onclick="dayClicked(this);">1</td>
                    <td onclick="dayClicked(this);">1</td>
                    <td onclick="dayClicked(this);">1</td>
                    <td onclick="dayClicked(this);">1</td>
                    <td onclick="dayClicked(this);">1</td>
                    <td onclick="dayClicked(this);">1</td>
                    <td onclick="dayClicked(this);">1</td>
                </tr>
                <tr>
                    <td onclick="dayClicked(this);">1</td>
                    <td onclick="dayClicked(this);">1</td>
                    <td onclick="dayClicked(this);">1</td>
                    <td onclick="dayClicked(this);">1</td>
                    <td onclick="dayClicked(this);">1</td>
                    <td onclick="dayClicked(this);">1</td>
                    <td onclick="dayClicked(this);">1</td>
                </tr>
                <tr>
                    <td onclick="dayClicked(this);">1</td>
                    <td onclick="dayClicked(this);">1</td>
                    <td id="current-day" onclick="dayClicked(this);">1</td>
                    <td onclick="dayClicked(this);">1</td>
                    <td onclick="dayClicked(this);">1</td>
                    <td onclick="dayClicked(this);">1</td>
                    <td onclick="dayClicked(this);">1</td>
                </tr>
                <tr>
                    <td onclick="dayClicked(this);">1</td>
                    <td onclick="dayClicked(this);">1</td>
                    <td onclick="dayClicked(this);">1</td>
                    <td onclick="dayClicked(this);">1</td>
                    <td class="tooltip">1 <img src="images/note1.png" alt="" onclick="dayClicked(this);"><span>這是提示！！！</span></td>
                    <td onclick="dayClicked(this);">1</td>
                    <td onclick="dayClicked(this);">1</td>
                </tr>
                <tr>
                    <td onclick="dayClicked(this);">1</td>
                    <td onclick="dayClicked(this);">1</td>
                    <td onclick="dayClicked(this);">1</td>
                    <td onclick="dayClicked(this);">1</td>
                    <td onclick="dayClicked(this);">1</td>
                    <td onclick="dayClicked(this);">1</td>
                    <td onclick="dayClicked(this);">1</td>
                </tr>
            </tbody>
        </table>
        <button id="theme-portrait" class="font button color b_hover" onclick="openFavColor();">Change theme</button>
    </div>
    <!-- 主題更換 -->
    <dialog id="modal">
        <div id="fav-color" hidden>
            <div class="popup">
              <h4 class="center">Wanna chane color?</h4>
              <div id="color-options">
                <div class="color-option">
                  <div class="color-preview checkmark" id="purple" style="background-color: #BB92D3;" onclick="addCheckMark('purple');"><i class="fas fa-check checkmark"></i></div>
                  <h5>Purple</h5>
                </div>
                <div class="color-option">
                  <div class="color-preview checkmark" id="red" style="background-color: #d37474d8;" onclick="addCheckMark('red');"></div>
                  <h5>Red</h5>
                </div>
                <div class="color-option">
                  <div class="color-preview checkmark" id="blue" style="background-color: #6989b8;" onclick="addCheckMark('blue');"></div>
                  <h5>Blue</h5>
                </div>
                <div class="color-option">
                  <div class="color-preview checkmark" id="green" style="background-color: #78a78e;" onclick="addCheckMark('green');"></div>
                  <h5>Green</h5>
                </div>
                <div class="color-option">
                  <div class="color-preview checkmark" id="orange" style="background-color: #cc9779;" onclick="addCheckMark('orange');"></div>
                  <h5>Orange</h5>
                </div>
                <div class="color-option">
                  <div class="color-preview checkmark" id="deep-orange" style="background-color: #ce733f;" onclick="addCheckMark('deep-orange');"></div>
                  <h5>Deep Orange</h5>
                </div>
                <div class="color-option">
                  <div class="color-preview checkmark" id="baby-blue" style="background-color: #94c2dd;" onclick="addCheckMark('baby-blue');"></div>
                  <h5>Baby Blue</h5>
                </div>
                <div class="color-option">
                  <div class="color-preview checkmark" id="cerise" style="background-color: #a88894;" onclick="addCheckMark('cerise');"></div>
                  <h5>Cerise</h5>
                </div>
                <div class="color-option">
                  <div class="color-preview checkmark" id="lime" style="background-color: #a6d6ab;" onclick="addCheckMark('lime');"></div>
                  <h5>Lime</h5>
                </div>
                <div class="color-option">
                  <div class="color-preview checkmark" id="teal" style="background-color: #8fd1c9;" onclick="addCheckMark('teal');"></div>
                  <h5>Teal</h5>
                </div>
                <div class="color-option">
                  <div class="color-preview checkmark" id="pink" style="background-color: #e7a3c3;" onclick="addCheckMark('pink');"></div>
                  <h5>Pink</h5>
                </div>
                <div class="color-option">
                  <div class="color-preview checkmark" id="black" style="background-color: #3d4140de;" onclick="addCheckMark('black');"></div>
                  <h5>Black</h5>
                </div>
              </div>
              <button id="update-theme-button" class="button font" onclick="changeColor();">choose it</button>
            </div>
        </div> 
        <div id="make-note" hidden>
            <div class="popup">
                <h4>Add a note to the calendar</h4>
                <textarea id="edit-post-it" class="font" name="post-it" autofocus></textarea>
                <div><button class="button font post-it-button" id="add-post-it" onclick="submitPostIt();">Post It</button>
                <button class="button font post-it-button" id="delete-button" onclick="deleteNote()">Delete It</button>
            </div>
        </div>       
    </dialog>
    
  <script src="js/changeTheme.js"></script>
  <script src="js/postit.js"></script>
  <script src="js/updateDate.js"></script>
  <script src="js/ajax.js"></script>


  <?php
     getNoteData();
    function getNoteData(){
    global $connection;
    $query = "SELECT * FROM notes";
    $result = mysqli_query($connection, $query);
    if(!$result){
        die("Something went wrong");
    }
    $id = 0;
    $color = 1;
    $text = "";
    while($row = mysqli_fetch_assoc($result)){
      $id = $row['note_id'];
      $color = $row['note_color'];
      $text = $row['note_text'];
      //以上為php碼 
  ?>
  <script type="text/javascript">
    postIt = {
     id: <?php echo json_encode($id); ?>,
     note_num: <?php echo json_encode($color); ?>,
     note: <?php echo json_encode($text); ?>
    }
  postIts.push(postIt);
</script>
<?php //再接著php碼，這種寫法在混合式的php、html、JavaScript很常見的寫法，要習慣。
    }
  }
?>

 
    <script>
      currentColor.name = <?php echo(json_encode( setTheme() )); ?> ;   
      let today = new Date();
      let thisYear = today.getFullYear();
      let thisMonth = today.getMonth(); 
      updateDate();
      fillInMonth(thisYear, thisMonth); //顯示今年今月
    </script>



</body>

</html>