//функции js, нужные для работы.
function jscoretransurljq(moduls,funct,params) {
	var ReturnedAdresURL;
	ReturnedAdresURL=location.protocol+"//"+location.host;
	ReturnedAdresURL=ReturnedAdresURL+"/"+moduls+".jq/"+funct+"/"
	for(var i=0; i<params.length; i++){
    	ReturnedAdresURL=ReturnedAdresURL+params[i]+"/";
	}
	return ReturnedAdresURL;
}
function redirecttomain(){
document.location=location.protocol+"//"+location.host;
}
