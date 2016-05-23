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
    
    
    
    xmlhttp.open("POST","BuscaAjax",true);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.send("q="+n);
}

function MultiplesTareas(){

    var n = document.getElementById('idorden').value;
    xmlhttp = new XMLHttpRequest();
    
 
    
    xmlhttp.onreadystatechange = function ()
    {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
        {
            document.getElementById("myDiv").innerHTML = xmlhttp.responseText;
        }
    };

    
    xmlhttp.open("POST","../CreaZip",true);
    xmlhttp.setRequestHeader("Content-Type", "application/octet-stream");
    xmlhttp.send("q="+n);
    /*
    xmlhttp2 = new XMLHttpRequest();
    
    xmlhttp2.open("POST","../BorrarOrden",true);
    xmlhttp2.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp2.send("q="+n);*/
}
    
