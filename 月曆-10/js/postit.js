      //呼叫記事對話方塊
      function openMakeNote(){
        var modal = document.getElementById("modal");
        modal.open = true;
        var template = document.getElementById("make-note");
        template.removeAttribute("hidden");
        document.getElementById("edit-post-it").focus(); //游標跳至文字輸入方塊中
        if(!newCurrentPostIt){
          document.getElementById("edit-post-it").value = postIts[currentPostItIndex].note;
        }
      }
      //關閉記事對話方塊
      function closeMakeNote(){
        var modal = document.getElementById("modal");
        modal.open = false;
        var template = document.getElementById("make-note");
        template.setAttribute("hidden", "hidden");
      }

      function currentDayHasNote(uid){ //測試特定UID是否已經有記事
        for(var i = 0; i < postIts.length; i++){ 
            if(postIts[i].id == uid){ //在記事資料物件集合中找到該日期之記事資料
                newCurrentPostIt = false; //不是新記事
                currentPostItIndex = i; //指向找到的記事資料物件索引
                return;
            }
        } //整個迴圈比對，未找到目前日期有記事資料
        newCurrentPostIt = true; //表示要新增一筆記事資料
      }
      function getRandom(min, max) { //傳回介於min與max間的亂數值
        return Math.floor(Math.random() * (max - min) ) + min;
      }
      function submitPostIt(){ //按了PostIt按鍵後，所要執行的方法
        const value = document.getElementById("edit-post-it").value;
        document.getElementById("edit-post-it").value = "";
        let num = getRandom(1, 6); //取得1~6的亂數，用來標示便利貼顏色的檔案代號
        let postIt = {
          id: currentPostItID,
          note_num: num,
          note: value
        }
        if(newCurrentPostIt){ //如果是新記事的話
          postIts.push(postIt); //將新記事postIT物件推入postIts陣列
          //新記事ajax呼叫
          ajax(
            {new_note_uid: postIt.id, 
            new_note_color: postIt.note_num, 
            new_note_text: postIt.note});
        } else {
            postIts[currentPostItIndex].note = postIt.note; //更新現有記事物件的記事資料
            //更新記事資料的ajax呼叫
            ajax({update_note_uid: postIts[currentPostItIndex].id, 
              update_note_text: postIt.note});
          }
        console.log(postIts);
        fillInMonth(thisYear, thisMonth); //重新填一次月曆日期，更新記事便利貼
        closeMakeNote();
      }

    function deleteNote(){
    document.getElementById("edit-post-it").value = "";
    let indexToDel;
    if(!newCurrentPostIt){
        indexToDel =currentPostItIndex;
    }
    if(indexToDel != undefined){
      //刪除記事資料的ajax呼叫
        ajax({delete_note_uid: postIts[indexToDel].id});  
        postIts.splice(indexToDel, 1);
    }
    fillInMonth(thisYear, thisMonth); //這個方法可以改成fillInCalendar比較貼切，之後，我們再來統一大改 (refactoring)
    closeMakeNote();
  }

      function dayClicked(elm){
        // console.log(elm.dataset.uid);
        currentPostItID = elm.dataset.uid; //目前的記事ID為所點擊的日期表格上的uid
        currentDayHasNote(currentPostItID);//判斷目前點蠕擊的日期是否有記事資料
        openMakeNote();
      }

      var postIts = []; //記事陣列，用來放置月曆中的記事物件資料
      //current 目前點擊的日期
      var currentPostItID = 0; //目前的記事ID
      var newCurrentPostIt = false; //目前的記事是否為新？也就是：目前點選的日期尚未有任何的記事資料
      var currentPostItIndex = 0; //目前的記事在postIts陣列中的位置索引