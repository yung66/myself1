function ajax(object){
    var request = new XMLHttpRequest();
    request.open("POST", "index.php");
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send(objectToString(object));
}
function objectToString(object){
    let str = "";
    Object.keys(object).forEach(function(key){
        str += key;
        str += `=${object[key]}&`; //``模板字符串 
    });
    console.log(str);
    return str;
}