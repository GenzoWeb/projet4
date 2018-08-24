var report = document.querySelectorAll(".rep");
window.addEventListener("load",function(){
	var myFunction = function() {
		alert("Vous venez de signaler un message.");
	};  
 
    for(var i=0;i<report.length;i++){
        report[i].onclick = myFunction;
    }
});