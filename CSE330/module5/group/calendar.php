<!DOCTYPE html> 
<html> 
<?php 
ini_set("session.cookie_httponly", 1);
session_start();
?>
<head>
<link rel="stylesheet" href="calendar.css">
<script src='moment.js'></script>
<title> Calendar </title> 
<script> 
var jsondata = null;

var today=moment().format('YYYY-MM-DD');

(today);
document.addEventListener("DOMContentLoaded", loadEvents, false);
	function loadEvents(){
	var xmlHttp = new XMLHttpRequest();
	xmlHttp.open("GET", "getEvents2.php", true);
	xmlHttp.send(null);
	xmlHttp.addEventListener("load", eventCallback,false);
	}
	function eventCallback(event){
  	jsondata = JSON.parse(event.target.responseText);
	
	updateCalendar();
	}
function login(){
	var name = document.getElementById("username").value ;
	var password = document.getElementById("password").value;
	if(name == '' || password == ''){
	alert("Enter username and password");
	}
	else{
	var xmlHttp = new XMLHttpRequest();
	xmlHttp.open("POST", "calendarLogin.php", true);
	xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xmlHttp.send("username="+name+"&password="+password);
	xmlHttp.addEventListener("load", loginCallback, false);
	
	}
}
function createUser(){
	var name = document.getElementById("username").value ;
	var password = document.getElementById("password").value;
	(name);
	(password);
	if(name == '' || password == ''){
	alert("Enter username and password");
	}
	else{
	var xmlHttp = new XMLHttpRequest();
	xmlHttp.open("POST", "newUserCal.php", true);
	xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xmlHttp.send("username="+name+"&password="+password);
	xmlHttp.addEventListener("load", loginCallback, false);
	
	}
}
function logout(){
	var xmlHttp = new XMLHttpRequest();
	xmlHttp.open("GET", "calLogout.php", true);
	xmlHttp.send(null);
	xmlHttp.addEventListener("load", loginCallback, false);
}
function loginCallback(){
	
location.reload();
}


var currentMonth = new Month(2017, 9);
var gridArray = ['one','two','three','four','five','six','seven','eight','nine','ten','eleven','twelve','thirteen','fourteen','fifteen','sixteen','seventeen','eighteen','nineteen','twenty','twentyone','twentytwo','twentythree','twentyfour','twentyfive','twentysix','twentyseven','twentyeight','twentynine','thirty','thirtyone','thirtytwo','thirtythree','thirtyfour','thirtyfive','thirtysix','thirtyseven','thirtyeight','thirtynine','forty','fortyone','fortytwo'];

(function(){
Date.prototype.deltaDays=function(c){
return new Date(this.getFullYear(),this.getMonth(),this.getDate()+c)};Date.prototype.getSunday=function(){
return this.deltaDays(-1*this.getDay())}})();
function Week(c){
this.sunday=c.getSunday();this.nextWeek=function(){return new Week(this.sunday.deltaDays(7))};this.prevWeek=function(){
return new Week(this.sunday.deltaDays(-7))};this.contains=function(b){
return this.sunday.valueOf()===b.getSunday().valueOf()};this.getDates=function(){
for(var b=[],a=0;7>a;a++)b.push(this.sunday.deltaDays(a));return b}}
function Month(c,b){this.year=c;this.month=b;this.nextMonth=function(){
return new Month(c+Math.floor((b+1)/12),(b+1)%12)};this.prevMonth=function(){
return new Month(c+Math.floor((b-1)/12),(b+11)%12)};this.getDateObject=function(a){
return new Date(this.year,this.month,a)};this.getWeeks=function(){
var a=this.getDateObject(1),b=this.nextMonth().getDateObject(0),c=[],a=new Week(a);for(c.push(a);!a.contains(b);)a=a.nextWeek(),c.push(a);return c}
};


// This updateCalendar() function only alerts the dates in the currently specified month.  You need to write
// it to modify the DOM (optionally using jQuery) to display the days and weeks in the current month.
function updateCalendar(){

(jsondata);
document.getElementById('event').innerHTML = ' ';
	if(<?php echo (int)(!isset($_SESSION['user_id']) && empty($_SESSION['user_id']));?>){
	document.getElementById('html').innerHTML = `<form> 
		Username: <br/>
		<input type="text" name = "username" id = "username"><br/>
		
		Password: <br/>
		<input type="password" name = "password" id = "password"><br/>
	</form>
	<button type = "button" id = "login">Login</button>
	<button type = "button" id = "newUser">Create User</button>
	<p id = "loginInfo"></p> ` ;
	document.getElementById("login").addEventListener("click",login,false);
	document.getElementById("newUser").addEventListener("click",createUser,false);
	}
	else{ 
	document.getElementById('html').innerHTML = ` <div class='html'> Welcome <?php echo $_SESSION['user_id'] ?></div>
  
  <button type='button' id = 'addEvent'>Add Event</button>
  
  <button type='button' id = 'logout'>Logout</button> `;

  document.getElementById("logout").addEventListener("click",logout,false);
  document.getElementById("addEvent").addEventListener("click",addEvent,false);
  }
	var weeks = currentMonth.getWeeks();
	var monthNames = ['January','February','March','April','May','June','July','August','September','October','November','December'];
	var currentMonthName = monthNames[currentMonth.month];
	document.getElementById('month').innerHTML = currentMonthName +"  " + currentMonth.year;
	for(k=0;k<gridArray.length;k++){
			gridClear = gridArray[k];
			document.getElementById(gridClear).innerHTML = " ";
			}
	for(var w in weeks){
		var days = weeks[w].getDates();
		// days contains normal JavaScript Date objects.
		//document.getElementById('weeks').innerHTML = days;
		
			var daysOfWeek = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
			for(j = 0; j < 7; j++){
			
			if(days[j].getDate() == 1 && days[j].getMonth() == currentMonth.month){
			var startDay = days[j].getDay();
			var i = startDay;
			//(jsondata);
			}
			}
			for(var d in days){
			
			if(days[d].getMonth() == currentMonth.month){
			var gridPlace = gridArray[i];
			if(days[d].toISOString().split('T')[0]==today){
			('today');
			document.getElementById(gridPlace).innerHTML = '<div class="today">'+days[d].getDate()+'</div>';
			}
			else{
			
			document.getElementById(gridPlace).innerHTML = days[d].getDate();
			}
			i++;
			 if(!(jsondata.length < 1) || jsondata != null){
			 for(events = 0; events<jsondata.length;events++){
			 var dateVar = days[d].toISOString().split('T')[0];
			 
			if(jsondata[events].date == dateVar){
			if(jsondata[events].shared == 0){
			var className = 'event';
			}
			else{
			var className = 'shared';
			}
			
			document.getElementById(gridPlace).innerHTML += '<div id = '+jsondata[events].event_id+' class="'+className+'">'+jsondata[events].title+'</div>';
			if(document.getElementById("showTags").checked){
				if(jsondata[events].tagged == 'Work'){
				document.getElementById(gridPlace).innerHTML += "<div class = 'blue'>&#x25C6</div>";
				}
				if(jsondata[events].tagged == 'School'){
				document.getElementById(gridPlace).innerHTML += "<div class = 'yellow'>&#x25C6</div>";
				}
				if(jsondata[events].tagged == 'Appointment'){
				document.getElementById(gridPlace).innerHTML += "<div class = 'red'>&#x25C6</div>";
				}
				if(jsondata[events].tagged == 'Other'){
				document.getElementById(gridPlace).innerHTML += "<div class = 'green'>&#x25C6</div>";
				}
			}
			document.getElementById(gridPlace).innerHTML += '<div class="time">('+jsondata[events].time.slice(0,-3)+')</div>';
			
			document.getElementById(jsondata[events].event_id).addEventListener("click",function(event){
			editEvent(event);
			},false);
			}
			}
			}
			}
		}
	}
}
var event_id = 0;
function editEvent(event){

 event_id = event.target.id;
document.getElementById('event').innerHTML =' ';
document.getElementById('editEv').innerHTML =' ';
 document.getElementById('eventOptions').innerHTML = ` Event Options: <br><button type='button' id = 'deleteEvent'>Delete Event</button>
  <button type='button' id = 'shareEvent'>Share Event</button>
  <button type = 'button' id = 'editEvent' > Edit Event</button>
  <button id = 'cancelEdit'>Cancel</button>`;
  document.getElementById('cancelEdit').addEventListener("click",function(){
  document.getElementById('eventOptions').innerHTML =' ';
    },false);
  document.getElementById('deleteEvent').addEventListener("click",deleteEvent,false);
  document.getElementById('editEvent').addEventListener("click",eventEditor,false);
  document.getElementById('shareEvent').addEventListener("click",eventSharer,false);
  

}
function eventSharer(){
 document.getElementById('eventOptions').innerHTML =' ';
 document.getElementById('editEv').innerHTML= ` 
 <form> 
		Event Username To Share With: <br/>
		<input type="text" maxlength="18" name = "shareUser" id = "shareUser"><br/>
 </form>
  <button type = 'button' id = 'shareEventSubmit' > Share</button>
  <button id = 'cancelShare'>Cancel</button>`;
  document.getElementById('cancelShare').addEventListener("click",function(){
  document.getElementById('editEv').innerHTML =' ';
    },false);
  document.getElementById('shareEventSubmit').addEventListener("click",shareEventAJAX,false);
}
function shareEventAJAX(){
	var shareUser = document.getElementById("shareUser").value;
	
	var xmlHttp = new XMLHttpRequest();
	xmlHttp.open("POST", "shareEvent.php", true);
	xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xmlHttp.send("&event_id="+event_id+"&shareUser="+shareUser);
	xmlHttp.addEventListener("load", eventSubmitted, false);
	
}

function deleteEvent(){

var xmlHttp = new XMLHttpRequest();
	xmlHttp.open("POST", "deleteEvent.php", true);
	xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xmlHttp.send("event_id="+event_id);
	xmlHttp.addEventListener("load", eventDeleted, false);
}
function eventDeleted(){
 document.getElementById('eventOptions').innerHTML =' ';
loadEvents();
}
function eventEditor(){ 
document.getElementById('event').innerHTML =' ';
 document.getElementById('eventOptions').innerHTML =' ';
 document.getElementById('editEv').innerHTML= ` 
 <form> 
		Event Title: <br/>
		<input type="text" maxlength="18" name = "editEventTitle" id = "editEventTitle"><br/>
		Event date: <br/>
		<input type="date" name = "editEventDate" id = "editEventDate"><br/>
		Event time: <br/>
		<input type="time" name = "editEventTime" id = "editEventTime"><br/>
 </form>
  <button type = 'button' id = 'editEventSubmit' > Edit</button>
  <button id = 'cancelEdit'>Cancel</button>`;
  document.getElementById('editEventSubmit').addEventListener("click",editEventAJAX,false);
  document.getElementById('cancelEdit').addEventListener("click",function(){
	document.getElementById('editEv').innerHTML =' ';
	
	},false);
}
function editEventAJAX(){
	var title = document.getElementById("editEventTitle").value ;
	var date = document.getElementById("editEventDate").value;
	var time = document.getElementById("editEventTime").value;
	
	var xmlHttp = new XMLHttpRequest();
	xmlHttp.open("POST", "editEvent.php", true);
	xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xmlHttp.send("title="+title+"&date="+date+"&time="+time+"&event_id="+event_id);
	xmlHttp.addEventListener("load", eventSubmitted, false);
	

}
function addEvent(){
document.getElementById('eventOptions').innerHTML =' ';
document.getElementById('editEv').innerHTML=' ';
document.getElementById('event').innerHTML = `<form> 
		Event Title: <br/>
		<input type="text" maxlength="18" name = "eventTitle" id = "eventTitle"><br/>
		Event date: <br/>
		<input type="date" name = "eventDate" id = "eventDate"><br/>
		Event time: <br/>
		<input type="time" name = "eventTime" id = "eventTime"><br/>
		<!-- https://www.w3schools.com/tags/tag_select.asp -->

		<select id="tag">
  		<option value="Work">Work</option>
  		<option value="School">School</option>
  		<option value="Appointment">Appointment</option>
  		<option value="Other">Other</option>
		</select>	
		<!-- end -->
		</form> 
	<button id = 'submitEvent'>Submit Event</button>  
	  <button id = 'cancel'>Cancel</button>`;
	document.getElementById('submitEvent').addEventListener("click",addingEvent,false);
	document.getElementById('cancel').addEventListener("click",function(){
	document.getElementById('event').innerHTML =' ';
	
	},false);
}
function addingEvent(){

	var title = document.getElementById("eventTitle").value ;
	var date = document.getElementById("eventDate").value;
	var time = document.getElementById("eventTime").value;
	var tag = document.getElementById("tag").value;
	
	(title);
	(date);
	(time);
	if(title == '' || date == '' || time ==''){
	alert("Enter title, date, and time for event");
	}
	else{
	var xmlHttp = new XMLHttpRequest();
	xmlHttp.open("POST", "submitEvent.php", true);
	xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xmlHttp.send("eventTitle="+title+"&eventDate="+date+"&eventTime="+time+"&tagged="+tag);
	xmlHttp.addEventListener("load", eventSubmitted, false);
	
	}
	}
function eventSubmitted(){

 loadEvents();
document.getElementById('event').innerHTML = ' ';
document.getElementById('editEv').innerHTML = ' ';
}
// function loadEvents(){

</script>
</head> 


<body>


<div id='html' ></div>
<div id='box'></div>
<!-- code taken from w3schools.com (calendar css section and css grid section)-->
<div class="month"> 
  <ul>
    <li class="prev"><button type="button" id = "prev_month_btn">Previous Month</button></li>
    <li class="next"><button type="button" id = "next_month_btn">Next Month</button></li>
    <li id ="month"><br><span style="font-size:18px"></span></li>
  </ul>
</div>
<ul class="weekdays">
   <li>Sunday</li>
   <li>Monday</li>
  <li>Tuesday</li>
  <li>Wednesday</li>
  <li>Thursday</li>
  <li>Friday</li>
  <li>Saturday</li>
 
</ul> 
 
<div class="grid-container">
  <div class="grid-item" id = 'one'></div>
  <div class="grid-item" id = 'two'></div>
  <div class="grid-item"  id = 'three'></div>
  <div class="grid-item" id = 'four'></div>
  <div class="grid-item" id = 'five'></div>
  <div class="grid-item" id = 'six'></div>
  <div class="grid-item" id = 'seven'></div>
  <div class="grid-item" id = 'eight'></div>
  <div class="grid-item" id = 'nine'></div>
  <div class="grid-item" id = 'ten'></div>
  <div class="grid-item" id = 'eleven'></div>
  <div class="grid-item" id = 'twelve'></div>
  <div class="grid-item" id = 'thirteen'></div>
  <div class="grid-item" id = 'fourteen'></div>
  <div class="grid-item" id = 'fifteen'></div>
  <div class="grid-item" id = 'sixteen'></div>
  <div class="grid-item" id = 'seventeen'></div>
  <div class="grid-item" id = 'eighteen'></div>
  <div class="grid-item" id = 'nineteen'></div>
  <div class="grid-item" id = 'twenty'></div>
  <div class="grid-item" id = 'twentyone'></div>
  <div class="grid-item" id = 'twentytwo'></div>
  <div class="grid-item" id = 'twentythree'></div>
  <div class="grid-item" id = 'twentyfour'></div>
  <div class="grid-item" id = 'twentyfive'></div>
  <div class="grid-item" id = 'twentysix'></div>
  <div class="grid-item" id = 'twentyseven'></div>
  <div class="grid-item" id = 'twentyeight'></div>
  <div class="grid-item" id = 'twentynine'></div>
  <div class="grid-item" id = 'thirty'></div>
  <div class="grid-item" id = 'thirtyone'></div>
  <div class="grid-item" id = 'thirtytwo'></div>
  <div class="grid-item" id = 'thirtythree'></div>
  <div class="grid-item" id = 'thirtyfour'></div>
  <div class="grid-item" id = 'thirtyfive'></div>
  <div class="grid-item" id = 'thirtysix'></div>
  <div class="grid-item" id = 'thirtyseven'></div>
  <div class="grid-item" id = 'thirtyeight'></div>
  <div class="grid-item" id = 'thirtynine'></div>
  <div class="grid-item" id = 'forty'></div>
  <div class="grid-item" id = 'fortyone'></div>
  <div class="grid-item" id = 'fortytwo'></div>
<!-- end of borrowed code -->
</div>
<!-- <p id = "month"></p> -->
<div id = 'event'></div>
<div id='eventOptions' class ='options'></div>
<div id='editEv'></div>
<script>
document.getElementById("box").innerHTML='<input type="checkbox" id = "showTags">Show Tags?</input>';document.getElementById("showTags").addEventListener("click",updateCalendar,false);
// Change the month when the "next" button is pressed
document.getElementById("next_month_btn").addEventListener("click", function(event){
	currentMonth = currentMonth.nextMonth(); // Previous month would be currentMonth.prevMonth()
	updateCalendar(); // Whenever the month is updated, we'll need to re-render the calendar in HTML
	//alert("The new month is "+currentMonth.month+" "+currentMonth.year);
}, false);
document.getElementById("prev_month_btn").addEventListener("click", function(event){
	currentMonth = currentMonth.prevMonth(); // Previous month would be currentMonth.prevMonth()
	updateCalendar(); // Whenever the month is updated, we'll need to re-render the calendar in HTML
	//alert("The new month is "+currentMonth.month+" "+currentMonth.year);
}, false);


</script>
</body>

</html> 