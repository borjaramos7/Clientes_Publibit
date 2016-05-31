function buscador(){

    var n = document.getElementById('bus').value;
    //document.getElementById("myDiv").innerHTML =n;
    if  (n.length>1)
    {
    xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function ()
    {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
        {
            document.getElementById("myDiv").innerHTML = xmlhttp.responseText;
        }
    };

    xmlhttp.open("POST","http://localhost/Clientes_publibit/index.php/Cont_empresa/BuscaAjax",true);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.send("q="+n);
}
}
    
