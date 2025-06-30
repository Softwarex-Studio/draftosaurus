document.addEventListener("DOMContentLoaded", () => {
  const btnPlay = document.getElementById("btnPlay");
  if (btnPlay) {
    btnPlay.addEventListener("click", () => {
      window.location.href = "/Software-x/views/game.html";
    });
  }

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

  if (document.getElementById("game-board")) {
    fetchElements.push(
      fetch("/Software-x/views/game-board.html")
        .then((res) =>
          res.ok ? res.text() : Promise.reject("Game board not found")
        )
        .then((boardData) => {
          document.getElementById("game-board").innerHTML = boardData;
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
      console.log("All components loaded successfully.");
    })
    .catch((error) => {
      console.error("Error loading components:", error);
    });
});
