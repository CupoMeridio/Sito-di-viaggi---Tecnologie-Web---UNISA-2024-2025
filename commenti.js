
var ID_ULTIMO_COMMENTO=0;
function InserisciCommento(){
        var com = document.forms["commenti"]["experience"].value;
        var stelle= document.forms["commenti"]["rating"].value;
        if( confirm("Vuoi inserire il mommento\n "+ com) ){
        var xhr= new XMLHttpRequest();

        xhr.onreadystatechange= function(){
        if( xhr.readyState == 4 && xhr.status == 200){
            alert(this.responseText);
            PrendiCommenti();
        }
    }

        xhr.open("POST", "commenti.php");
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send( "experience="+ encodeURIComponent(com)+ "&rating="+encodeURIComponent(stelle ));
    }
}

function PrendiCommenti(){
    
    var xhrCommenti= new XMLHttpRequest();
    xhrCommenti.onreadystatechange= function(){

        if( xhrCommenti.readyState == 4 && xhrCommenti.status == 200){

            LeggiCommenti(this.responseText);
        }
}  
    xhrCommenti.open("GET", "prova_JSON");
    xhrCommenti.send(ID_ULTIMO_COMMENTO);
}

function LeggiCommenti(response){

var commento= JSON.parse(response);
let i;
var html = "<div>";
for(i=0 ; i<commento.length; i++){
    html += "<p>"+ commento[i].email +"</p>";
    html += "<p>"+ commento[i].id_testo +"</p>";
    html += "<p>"+ commento[i].testo+ "</p>";
    ID_ULTIMO_COMMENTO = commento[i].id_testo;
}

    html += "</div>";

    document.getElementById("reviews-container").innerHTML= html;
}
setInterval(PrendiCommenti,2000);
