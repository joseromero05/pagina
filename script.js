let menuVisible = false;
//Función que oculta o muestra el menu
function mostrarOcultarMenu(){
    if(menuVisible){
        document.getElementById("nav").classList ="";
        menuVisible = false;
    }else{
        document.getElementById("nav").classList ="responsive";
        menuVisible = true;
    }
}
function seleccionar(){
    //oculto el menu una vez que selecciono una opcion
    document.getElementById("nav").classList = "";
    menuVisible = false;
}

document.addEventListener("DOMContentLoaded", function() {
    const anuncios = document.getElementById("anuncios");
    const toggleButton = document.getElementById("toggle-anuncios");

    // Comprobar estado de los anuncios en localStorage
    if (localStorage.getItem("anunciosVisible") === "false") {
        anuncios.style.display = "none";
    }

    // Manejar el clic del botón
    toggleButton.addEventListener("click", function() {
        if (anuncios.style.display === "none" || anuncios.style.display === "") {
            anuncios.style.display = "flex"; // Mostrar anuncios
            localStorage.setItem("anunciosVisible", "true");
        } else {
            anuncios.style.display = "none"; // Ocultar anuncios
            localStorage.setItem("anunciosVisible", "false");
        }
    });
});

document.addEventListener("DOMContentLoaded", function() {
    const anunciosContainer = document.getElementById("anuncios");

    fetch('anuncios.json')
        .then(response => response.json())
        .then(data => {
            data.forEach(anuncio => {
                const div = document.createElement("div");
                div.classList.add("anuncio");
                div.innerHTML = `
                    <h3>${anuncio.titulo}</h3>
                    <p>${anuncio.texto}</p>
                    <a href="${anuncio.enlace}" class="btn-anuncio">¡Aprovecha ahora!</a>
                `;
                anunciosContainer.appendChild(div);
            });
        });

    // Resto del código para mostrar/ocultar anuncios...
});