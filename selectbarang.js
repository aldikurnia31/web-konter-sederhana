 var xmlHttp
  
 function showbarang(str){ 
   xmlHttp=GetXmlHttpObject();
   if (xmlHttp==null)  {
     alert ("Your browser does not support HTTP Request");
     return;
   } 
   var url="getbarang.php";
   url=url+"?q="+str;
   url=url+"&sid="+Math.random();
   xmlHttp.onreadystatechange=stateChanged;
   xmlHttp.open("GET",url,true);
   xmlHttp.send(null);
 }
  
 function stateChanged() { 
   if (xmlHttp.readyState==4)
     { document.getElementById("listbarang").innerHTML=xmlHttp.responseText;}
 }
  
 function GetXmlHttpObject(){
   var xmlHttp=null;
   try { xmlHttp=new XMLHttpRequest();  }   // Firefox, Opera 8.0+, Safari
   catch (e){ try {xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");}   // Internet Explorer
   catch (e){xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");}
 }
 return xmlHttp;
 }