function postRequest(url, data){

    let http = new XMLHttpRequest();
    http.open("POST", url, false);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	formData = "";
	Object.entries(data).forEach(entry => {
			const [key, value] = entry;
			formData += (key + "=" + value + "&");
	});
	formData += "filler=1";


    http.send(formData);

    return JSON.parse(http.responseText);

}

function $_GET(param) {
	var vars = {};
	window.location.href.replace( location.hash, '' ).replace( 
		/[?&]+([^=&]+)=?([^&]*)?/gi, // regexp
		function( m, key, value ) { // callback
			vars[key] = value !== undefined ? value : '';
		}
	);

	if ( param ) {
		return vars[param] ? vars[param] : null;	
	}
	return vars;
}

function adminCheck(){
	let response = postRequest("/votemaster/backend/islogged_hall.php", {});
	if(response.status == 0 && response.code == 100){
        window.location.href = "/votemaster/hall/login/";
    }
}