function buscador(){

    var n = document.getElementById('bus').value;
    //document.getElementById("myDiv").innerHTML =n;
    xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function ()
    {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
        {
            document.getElementById("myDiv").innerHTML = xmlhttp.responseText;
        }
    };
     /*$.ajax({
                data:  q=n,
                url:   '../../asset/js/proc.php',
                type:  'post',
                contentType: "application/x-www-form-urlencoded",
                beforeSend: function () {
                        $("#resultado").html("Procesando, espere por favor...");
                },
                success:  function (response) {
                        $("#resultado").html(response);
                }
        });*/
    
    
    
    xmlhttp.open("POST","VerEmpresa",true);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.send("q="+n);
}
    
