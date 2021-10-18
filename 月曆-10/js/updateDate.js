function getWeekName(day){
  if (day == 0) return "Sunday";
  if (day == 1) return "Monday";
  if (day == 2) return "Tuesday";
  if (day == 3) return "Wednesday";
  if (day == 4) return "Thursday";
  if (day == 5) return "Friday";
  if (day == 6) return "Saturday";
}

function getMonthName(month){
  // switch (month)  {        
  //   case 0: return "January";
  //   case 1: return "February";
  //   case 2: return "March";
  //   case 3: return "April";        
  //   case 4: return "May";        
  //   case 5: return "June";        
  //   case 6: return "July";
  //   case 7: return "August";
  //   case 8: return "September";
  //   case 9: return "October";
  //   case 10: return "November";                                    
  //   case 11: return "December";        }
    var monthNames = [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ];
    return monthNames[month];
}

function addDateOrdinal(date) { //加上日期序數
switch (date) {
  case 1:
  case 21:
  case 31: return date + "<sup>st</sup>";
  case 2:
  case 22: return date + "<sup>nd</sup>";        
  case 3:
  case 23: return date + "<sup>rd</sup>";        
  default: return date + "<sup>th</sup>";      
}
}
   
function updateDate(){
var today = new Date(); //新增一個Date物件，此物件命名為today，new具現化 instantiation
// getElementById 用Id找出要找的tag元素，此函式會回傳一個物件，注意element是單數行式
document.getElementById("bg-year").innerHTML = today.getFullYear();
document.getElementById("cur-year").innerHTML = today.getFullYear();
document.getElementById("cal-year").innerHTML = today.getFullYear();
document.getElementById("cur-month").innerHTML = getMonthName( today.getMonth() );
document.getElementById("cal-month").innerHTML = getMonthName( today.getMonth() );
document.getElementById("cur-date").innerHTML = addDateOrdinal( today.getDate() );
document.getElementById("cur-day").innerHTML = getWeekName( today.getDay() );
}

function getUID(year, month, date){
  if(month == -1) {
    month = 11;
    year--;
  }  
  if(month == 12) {
    month = 0;
    year++;
  }
  // return ""+year+month+date;
  return year.toString()+month.toString()+date.toString();
}

//記事圖示與ToolTip處理
function appendSpriteToCellAndTooltip(uid, elem){
  for(let i = 0; i < postIts.length; i++){
      if(uid == postIts[i].id){
          elem.innerHTML += `<img src='images/note${postIts[i].note_num}.png' alt='A post-it note'>`;
          elem.classList.add("tooltip");
          elem.innerHTML += `<span>${postIts[i].note}</span>`;
      }
  }
}

function fillInMonth(thisYear, thisMonth){ //參數化，可調整年份月份 駝峰式命名法
  // 算出今年今月1日是星期幾
  document.getElementById("cal-year").innerHTML = thisYear;
  document.getElementById("cal-month").innerHTML = getMonthName( thisMonth );
  
  let firstDayofMonth = new Date(thisYear, thisMonth, 1); //這年這月的1號的日期物件
  let weekDayofFDOM = firstDayofMonth.getDay(); //這年這月1號是星期幾
  let monthDays = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
  if ( thisYear % 400 == 0 || (thisYear % 4 == 0 && thisYear % 100 != 0)){
    monthDays[1]=29; }   

  let thisDate = today.getDate();
  let days = document.getElementsByTagName("td");  //擷取文件中所有td元素，return td元素的集合陣列

  //去除td中class設有tooltip之屬性
  let elementsHasTooltip = document.getElementsByClassName("tooltip");
  for (let i = 0; i < elementsHasTooltip.length; i++){
    // elementsHasTooltip[i].classList.remove("tooltip");
    elementsHasTooltip[i].removeAttribute("class", "class");
  }

  //去除原先"current-day"元素id
  if (document.getElementById("current-day")) {
    document.getElementById("current-day").removeAttribute("id");
  }

  //今日加上"current-day
  if(thisYear == today.getFullYear() && thisMonth == today.getMonth()){
    days[weekDayofFDOM + thisDate - 1].setAttribute("id", "current-day");
  }

  //填滿本月日期
  for (let i = 1; i <= monthDays[thisMonth] ; i++){
    days[weekDayofFDOM + i - 1].innerHTML = i;
    days[weekDayofFDOM + i - 1].setAttribute("data-uid",getUID(thisYear, thisMonth, i));
    // console.log(days[i]);
    appendSpriteToCellAndTooltip(getUID(thisYear, thisMonth, i),  days[weekDayofFDOM + i - 1]);
  }

  //清除td元素裡的color
  for (let i = 0; i < days.length; i++) {
    days[i].classList.remove("color");
    days[i].classList.remove("prev-month-last-day"); 
  }

  //填入上個月的日期到Day[0]為止
  //改成0-11循環，thisMonth-1=-1會變成11
  if (weekDayofFDOM > 0){
    days[weekDayofFDOM - 1].classList.add("prev-month-last-day");
  } 
  for (let i = weekDayofFDOM - 1, d= monthDays[(thisMonth - 1 + 12) % 12];i >= 0; i--,d--){
    days[i].innerHTML = d;
    days[i].setAttribute("data-uid", getUID(thisYear, thisMonth - 1, d));
    days[i].classList.add("color"); 
    appendSpriteToCellAndTooltip(getUID(thisYear, thisMonth - 1, d), days[i]);
    // console.log(days[i]);
  }

  //填入下個月的日期到Day[41]為止
  for (let i = weekDayofFDOM + monthDays[thisMonth], d=1 ; i < 42; i++, d++){
    days[i].innerHTML = d;
    days[i].setAttribute("data-uid", getUID(thisYear, thisMonth + 1, d));
    days[i].classList.add("color");
    appendSpriteToCellAndTooltip(getUID(thisYear, thisMonth + 1, d), days[i]);
    // console.log(days[i]);
  }
  changeColor();
}   

document.onkeydown = function(e){
  switch (e.keyCode){
    case 37: previousMonth(); break
    case 39: nextMonth(); break
  }
};

function previousMonth(){
  thisMonth = thisMonth - 1;
  if (thisMonth == -1) {
    thisMonth = 11;
    thisYear--;
  }  
  fillInMonth(thisYear, thisMonth);
  // console.log("上個月");
}
function nextMonth(){
  thisMonth = thisMonth + 1;
  if (thisMonth == 12) {
    thisMonth = 0;
    thisYear++;
  }
  fillInMonth(thisYear, thisMonth);
}