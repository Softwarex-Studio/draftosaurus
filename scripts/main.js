document.addEventListener("DOMContentLoaded", () => {
  const path = window.location.pathname.includes("/views/") ? "../" : "";

  const fetchElements = [];

  if (document.getElementById("navbar")) {
    fetchElements.push(
      fetch(`${path}views/navbar.html`)
        .then((res) =>
          res.ok ? res.text() : Promise.reject("Navbar not found")
        )
        .then((navData) => {
          const navContainer = document.getElementById("navbar");
          navContainer.innerHTML = navData;

          const welcomeText = document.getElementById("welcome");
          const storedUsername = sessionStorage.getItem("Username");
          if (storedUsername && welcomeText) {
            welcomeText.textContent = `Bienvenido ${storedUsername}`;
            welcomeText.classList.remove("d-none");
          }

          const navLinks = navContainer.querySelectorAll(".nav-link");
          const navbarCollapse = navContainer.querySelector(".navbar-collapse");
          navLinks.forEach((link) => {
            link.addEventListener("click", () => {
              if (window.innerWidth < 992 && navbarCollapse) {
                const bsCollapse = new bootstrap.Collapse(navbarCollapse, {
                  toggle: false,
                });
                bsCollapse.hide();
              }
            });
          });
        })
    );
  }

  if (document.getElementById("carousel")) {
    fetchElements.push(
      fetch(`${path}views/carousel.html`)
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
      fetch(`${path}views/game-board.html`)
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
      fetch(`${path}views/footer.html`)
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
