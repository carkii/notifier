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
            // hide all modals if bootstrap was used as modals 
            if($)          
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
    changeClassnamesContent("notifications-counter",number)   
    if(notificationsCounter <= 0)
        hideClassnames('notifications-counter')
}

function hideClassnames(classname){    
    elements = document.getElementsByClassName(classname);            
    while (elements.length) {
        elements[0].className = "hidden";
    }
}

function changeClassnamesContent(classname,content){    
    elements = document.getElementsByClassName(classname);    
    for (var i = 0; i < elements.length; i++) {
        elements[i].innerHTML=content;        
    }
}

window.onload = function(){        
    changeNotificationsCounter(notificationsCounter)
}