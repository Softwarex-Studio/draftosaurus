/* Tener en cuenta que los nombres de funciones, variables, y demas deben estar en ingles por buena practica de programacion, y segun el profe, debemos usar kebab-case
para los nombres de funciones y variables, Ejemplo kebab-case function function-name(){"Codigo de Funcion"} */

document.addEventListener("DOMContentLoaded", () => {
  const btnPlay = document.getElementById("btnPlay");
  if (btnPlay) {
    btnPlay.addEventListener("click", function () {
      window.location.href = "game.html";
    });
  }

  /* Exportacion de Componentes a los distintos HTML 
  Este codigo crea una constante de cada componente creado, como la Navbar, el Footer, El carousel.
  y luego en caso de que esxista un id que haga match con document.getElementById ("nombre"), lo exporta en caso de existir, si no tira un mensaje de error.*/

  const fetchElements = [];

  if (document.getElementById("navbar")) {
    fetchElements.push(
      fetch("/Software-x/views/navbar.html")
        .then((res) =>
          res.ok ? res.text() : Promise.reject("Navbar not found")
        )
        .then((navData) => {
          document.getElementById("navbar").innerHTML = navData;
        })
    );
  }

  if (document.getElementById("carousel")) {
    fetchElements.push(
      fetch("/Software-x/views/carousel.html")
        .then((res) =>
          res.ok ? res.text() : Promise.reject("Carousel not found")
        )
        .then((carouselData) => {
          document.getElementById("carousel").innerHTML = carouselData;
        })
    );
  }

  if (document.getElementById("footer")) {
    fetchElements.push(
      fetch("/Software-x/views/footer.html")
        .then((res) =>
          res.ok ? res.text() : Promise.reject("Footer not found")
        )
        .then((footerData) => {
          document.getElementById("footer").innerHTML = footerData;
        })
    );
  }

  Promise.all(fetchElements)
    .then(() => {
      console.log("Componentes cargados correctamente");
    })
    .catch((error) => {
      console.error("Error cargando componentes:", error);
    });
});
