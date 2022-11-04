function showPage()
{
document.getElementById("loader").style.display = "none";
document.getElementById("data").style.display = "block";
}


    
function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
  }
    
    var id = null;
    function myMove() { 
    var ordinato = getCookie("ordinato");
    console.log(ordinato);
    var elem = document.getElementById("immagine");   
    console.log(elem);
    var mycontrect= document.getElementById("myContainer").getBoundingClientRect();
    var rect=elem.getBoundingClientRect();
    console.log(rect.top, rect.right, rect.bottom, rect.left);
    console.log(mycontrect.top, mycontrect.right, mycontrect.bottom, mycontrect.left);
    var data = document.getElementById("data"); 
    var da=elem.getBoundingClientRect();
    
    
    
    
    deg=30;
    pos1 = rect.top-da.top;
    pos2 = rect.left;
    clearInterval(id);
    id = setInterval(frame, 1);
    var width = document.documentElement.clientWidth;
    console.log(width);


    
    function frame() {
    if(width>=645)
    {
    if(pos2>= mycontrect.left)
    {
    deg++;
    pos2=pos2-3; 
    elem.style.left = pos2 + 'px'; 
    elem.style.webkitTransform = 'rotate('+deg+'deg)'; 
    elem.style.mozTransform    = 'rotate('+deg+'deg)'; 
    elem.style.msTransform     = 'rotate('+deg+'deg)'; 
    elem.style.oTransform      = 'rotate('+deg+'deg)'; 
    elem.style.transform       = 'rotate('+deg+'deg)';
    //elem.setAttribute("style","width:50px");
    
    }
    else if (pos1 <= mycontrect.top-da.top) {
    pos1=pos1+5; 
    elem.style.top = pos1 + 'px'; 
    
    } 
    else 
    {
    
    clearInterval(id);
    elem.classList.toggle('rotated');
    
    }
    }
    
    }
    }