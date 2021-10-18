function fillInMonth(thisYear, thisMonth){ //參數化，可調整年份月份 駝峰式命名法
          // 算出今年今月1日是星期幾
          let firstDayofMonth = new Date(thisYear, thisMonth, 1); //這年這月的1號的日期物件
          let weekDayofFDOM = firstDayofMonth.getDay(); //這年這月1號是星期幾
          let monthDays = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
          if ( thisYear % 400 == 0 || (thisYear % 4 == 0 && thisYear % 100 != 0)) monthDays[2]=29;   
          //填滿本月日期
          let days = document.getElementsByTagName("td"); //擷取文件中所有td元素，return td元素的集合陣列
          for (let i =1; i <= monthDays[thisMonth] ; i++){
            days [weekDayofFDOM + i - 1].innerHTML = i;
          }
          //填入上個月的日期到Day[0]為止
          for (let i = weekDayofFDOM - 1, d= monthDays[thisMonth - 1];i>=0; i--,d--){
            days[i].innerHTML = d;
            days[i].classList.add("color"); 
            // console.log(days[i]);
          }
          //填入下個月的日期
          for (let i = weekDayofFDOM + monthDays[thisMonth - 1 ], d=1 ; i <days.length; i++, d++){
            days[i].innerHTML = d;
            days[i].classList.add("color");
            // console.log(days[i]);
          }

        if (document.getElementById("current-day")) {
            document.getElementById("current-day").removeAttribute("id");
        }
        let thisDate = today.getDate();
        days[weekDayofFDOM + thisDate - 1].setAttribute("id", "current-day");

      
}