      //叫出選擇主題顏色介面  
      function openFavColor(){
        var modal = document.getElementById("modal");
        modal.open = true;
        var template = document.getElementById("fav-color");
        template.removeAttribute("hidden");
      }
    
      var currentColor = { name : "purple", color : "#BB92D3", off_color : "#F2E5F5" };
      var color_data = [
        {
          name: 'purple',
          color_code:'#BB92D3',
          off_color_code:'#F2E5F5',
        },
        {
          name: 'blue',
          color_code:'#6989b8',
          off_color_code:'#d4ddeb',
        },
        {
          name: 'red',
          color_code:'#d37474d8',
          off_color_code:'#fbe4e5',
        },
        {
          name: 'green',
          color_code:'#78a78e',
          off_color_code:'#e4ece8',
        },
        {
          name: 'orange',
          color_code:'#cc9779',
          off_color_code:'#f2e5de',
        },
        {
          name: 'deep-orange',
          color_code:'#ce733f',
          off_color_code:'#f2d8ca',
        },
        {
          name: 'baby-blue',
          color_code:'#94c2dd',
          off_color_code:'#e4f0f6',
        },
        {
          name: 'cerise',
          color_code:'#a88894',
          off_color_code:'#e6d6dc',
        },
        {
          name: 'lime',
          color_code:'#a6d6ab',
          off_color_code:'#e3f2e5',
        },
        {
          name: 'teal',
          color_code:'#8fd1c9',
          off_color_code:'#e2f3f1',
        },
        {
          name: 'pink',
          color_code:'#e7a3c3',
          off_color_code:'#f6dbe7',
        },
        {
          name: 'black',
          color_code:'#3d4140de',
          off_color_code:'#d9d9d9',
        }
        
      ];

      function addCheckMark(color_name){
        currentColor.name = color_name;
        var colorPreviews = document.getElementsByClassName("color-preview");
        //清除原本色塊勾選
        for (let i = 0; i < colorPreviews.length; i++){
          if (colorPreviews[i].innerHTML != "") {
            colorPreviews[i].innerHTML = "";
            // console.log(colorPreviews[i].id);
            break;
          }
        }      
        //新增顏色勾選
        for (let i = 0; i < colorPreviews.length; i++){
          if (colorPreviews[i].id == color_name) {
          // console.log(colorPreviews[i].id + "," + color_name);
            colorPreviews[i].innerHTML = "<i class='fas fa-check checkmark'></i>"
            break;
          }
        }
      }
        //變更主題色彩
        function changeColor(){
        //將所選色彩，currentColor.name更新到資料庫
        ajax( {color:currentColor.name} );
        //找出使用者所選顏色
        for(var i = 0; i < color_data.length; i++) {
          if (currentColor.name == color_data[i].name) {
            currentColor.color = color_data[i].color_code;
            currentColor.off_color = color_data[i].off_color_code;
            break;
          }
        }       
        // 找出所有設置color類別的元素
        var elements;
        //清掉月曆日期表格td的style
        elements = document.getElementsByTagName("td");
        for (let i = 0; i < elements.length; i++){
          elements[i].style = null;
        }
        elements = document.getElementsByClassName("color");
        for (let i = 0; i < elements.length; i++){
          elements[i].style.backgroundColor = currentColor.color;
        }
        elements = document.getElementsByClassName("border-color");
        for (let i = 0; i < elements.length; i++){
          elements[i].style.borderColor = currentColor.color;
        }
        elements = document.getElementsByClassName("off-color");
        for (let i = 0; i < elements.length; i++){
          elements[i].style.color = currentColor.off_color;
        }
        var modal = document.getElementById("modal");
        modal.open = false;
        var template = document.getElementById("fav-color");
        template.setAttribute("hidden", "hidden");
      }