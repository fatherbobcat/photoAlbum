 window.onload = initialize;
 var request;
 
 function initialize() {

    // Get our search button and setup an event handler
	var pid1 = parseInt(document.getElementById("pid_store").firstChild.nodeValue);
	var aid = parseInt(document.getElementById("aid_store").firstChild.nodeValue);
	var n="n";
	document.getElementById("next").onclick = function(){
	var pid2 = parseInt(document.getElementById("pid_store").firstChild.nodeValue);
	var aid2 = parseInt(document.getElementById("aid_store").firstChild.nodeValue);
		execute_ajax(pid2, aid2, n);
	}
	document.getElementById("prev").onclick = function(){
	var pid2 = parseInt(document.getElementById("pid_store").firstChild.nodeValue);
	var aid2 = parseInt(document.getElementById("aid_store").firstChild.nodeValue);
	var p="p";
		execute_ajax(pid2, aid2, p);
	}
	
    // Setup our request object
	request = null;
	createRequest();	
}
 
 function execute_ajax(int1, int2, name){
 
	request = null;
	createRequest();
	
	var url="http://info230.cs.cornell.edu/users/sabretooth/www/Project%203/ajax.php?pid="+int1+"&aid="+int2+"&funct="+name;
	
	/* Set up the Ajax call */
	
	//what function processes information once server sends it
	request.onreadystatechange=getPhoto;
	
	/* Make the Ajax call */
	//make the request 
	request.open('GET', url, true);
	request.send(null);
 }
 
 function getPhoto(){
	if(request.readyState==4){
	if(request.status===200){
			if(request.responseText!=""){
			eval(request.responseText);
			var viewing = document.getElementById("viewing");
			viewing.src = url;
			viewing.alt = caption;
			document.getElementById("viewingcap").innerHTML = caption;
			document.getElementById("viewingdate").innerHTML = date;
			var newpid=parseInt(pid);
			document.getElementById("pid_store").innerHTML = newpid;
			}
			
		
	}
	}
 }
 
 /*
 *
 * This function creates the Ajax request object; don't need to understand this
 *
 */

function createRequest() {

	// From "Head Rush Ajax" by Brett McLaughlin

	try {
		request = new XMLHttpRequest();
	} catch (trymicrosoft) {
		try {
			request = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (othermicrosoft) {
			try {
				request = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (failed) {
				request = null;
			}
		}
	}
	
	if (request == null) {
		alert("Error creating request object!");
	}
	

}
