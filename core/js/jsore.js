//функции js, нужные для работы.
function js_coretransurljq(moduls,funct,params) {
	var ReturnedAdresURL;
	ReturnedAdresURL=location.protocol+"//"+location.host;
	ReturnedAdresURL=ReturnedAdresURL+"/"+moduls+".jq/"+funct+"/"
	for(var i=0; i<params.length; i++){
    	ReturnedAdresURL=ReturnedAdresURL+params[i]+"/";
	}
	return ReturnedAdresURL;
}