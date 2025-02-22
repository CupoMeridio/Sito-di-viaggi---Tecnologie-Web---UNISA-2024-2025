const videos = [
    'video/registrazione/Video1.mp4',
    'video/registrazione/Video2.mp4',
    'video/registrazione/Video3.mp4',
    'video/registrazione/Video4.mp4',
  ];

  // Seleziona un video casuale
  const randomVideo = videos[Math.floor(Math.random() * videos.length)];

  // Imposta il video come sorgente
  const videoElement = document.getElementById('background-video');
  videoElement.innerHTML = `<source src="${randomVideo}" type="video/mp4">`;

  // Aggiunge un messaggio se il browser non supporta il video
  videoElement.innerHTML += 'Errore nella riproduzione del video.';


//------------ xona email recuperp------------
const emailProviders = [
    "@gmail.com",
    "@outlook.com",
    "@yahoo.com",
    "@icloud.com",
    "@protonmail.com",
    "@zoho.com",
    "@gmx.com",
    "@aol.com",
    "@mail.com",
    "@libero.it",
    "@tiscali.it",
    "@fastwebnet.it",
    "@email.it",
    "@aruba.it",
    "@kataweb.it",
    "@studenti.unisa.it" ,
    "@hotmail.it",
    "@hotmail.com"
  ];

function patternEmail(email){
    let pattern = /^[a-zA-Z0-9_.±]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/; 
    if (!pattern.test(email)){   
        //alert("sono nell'if");     
        return false;
    }else{
        let split=email.split('@');
        let dominio = '@'+split[1];
        return emailProviders.includes(dominio);
    }
}

//CONTROLLO EMAIL PATTERN 
let email=document.getElementById("email");
if(email!=null){
email.addEventListener("input", function(){
    let email =document.getElementById("email").value;
    let email_style =document.getElementById("email");
    if(!patternEmail(email))
       email_style.style.outline="solid red 3px";
    else{
        email_style.style.outline="solid green 3px";
    }

});
}

//----------PATTERN PASSWORD
function patternPassword(password){
    let pattern=/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&_])[A-Za-z\d@$!%*?&_]{8,}$/;
    return pattern.test(password);
}
if(document.getElementById("Cambia_password") != null){
document.getElementById("Cambia_password").addEventListener("input", function(){
  //  alert("sono qui");
    let password=document.getElementById("Cambia_password").value;
    let password_style=document.getElementById("Cambia_password");
    let password_error=document.getElementById("error");
   
    if(patternPassword(password)){
        password_style.style.outline="solid 3px green";
        password_error.textContent="";
    }else{
        password_style.style.outline="solid 3px red";
        password_error.textContent="La password non rispetta i requisiti";
    }
});}
