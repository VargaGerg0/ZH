
const szamInput =document.getElementById('szam');
const szivekhelye=document.getElementById('hely');

szamInput.addEventListener('change',()=> {
    szivekhelye.innerHTML="";

    const szam = parseInt(szamInput.value);
    
     for(let i=0;i<szam;i++){
    szivekhelye.innerHTML +="♥"
} });