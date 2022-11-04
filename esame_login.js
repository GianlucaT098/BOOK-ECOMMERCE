function validazione(event)
{
    // Verifica se tutti i campi sono riempiti
    if(form.nome.value.length == 0 ||
       form.cognome.value.length == 0 ||
       form.email.value.length == 0 ||
       form.password.value.length == 0)
    {
        // Avvisa utente
        // (meglio con div nascosto)
        alert("Compilare tutti i campi.");
        // Blocca l'invio del form
        event.preventDefault();
    }
        
}

// Riferimento al form
const form = document.forms['nome_form'];
// Aggiungi listener
form.addEventListener('submit', validazione);


/* Toggle between adding and removing the "responsive" class to topnav when the user clicks on the icon */
function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
      x.className += " responsive";
    } else {
      x.className = "topnav";
    }
  }