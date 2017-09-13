var this_js_script = document.getElementById("notificationsJS"); // or better regexp to get the file name.. // or better regexp to get the file name..
var notificationsCounter = this_js_script.getAttribute('notificationsCounter');
var acknowledgedURL = this_js_script.getAttribute('acknowledgedURL');
var xhr = new XMLHttpRequest();

function acknowledged(notificationName,containerId){
		
	xhr.onreadystatechange = function() {		
	    if (this.status == 200 && this.readyState == 4) {	    	  	
	        notificationsCounter = notificationsCounter - 1
    		changeNotificationsCounter(notificationsCounter)
    		document.getElementById(containerId).style.display = "none";
            // hide all modals
            $('.modal').modal('hide');            
	    }
	}
	var params = { name:notificationName }
	csrfToken = document.head.querySelector("[name=csrf-token]").content;	
	
	xhr.open("POST",acknowledgedURL + formatParams(params), true);
	xhr.setRequestHeader('X-CSRF-Token',csrfToken);
	xhr.send(null);
}

function formatParams( params ){
  return "?" + Object
        .keys(params)
        .map(function(key){
          return key+"="+encodeURIComponent(params[key])
        })
        .join("&")
}

function changeNotificationsCounter(number){
    $('.notifications-counter').html(number);    
    if(notificationsCounter <= 0)
        $('.notifications-counter').hide()
    else
        $('.notifications-counter').show()
}

window.onload = function(){        
    changeNotificationsCounter(notificationsCounter)
}