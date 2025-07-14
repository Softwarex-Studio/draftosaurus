document.addEventListener("DOMContentLoaded", () => {
  const users = [
    { username: "Nacho", password: "nacho1234", rol: "admin" },
    { username: "Marcos", password: "marcos1234", rol: "admin" },
    { username: "Marcel", password: "marcel1234", rol: "admin" },
    { username: "Profe", password: "profe1234", rol: "user" },
  ];

  const loginbtn = document.querySelector(".modal-footer .btn.btn-primary");
  const sesionbtn = document.getElementById("sesion");
  const inputuser = document.getElementById("usuario-login");
  const inputpassword = document.getElementById("password-login");

  const isLogged = sessionStorage.getItem("Usuario Logueado");
  if (isLogged) {
    playbutton();
    updateWelcome(sessionStorage.getItem("Username"));
  }

  loginbtn.addEventListener("click", () => {
    const username = inputuser.value.trim();
    const password = inputpassword.value.trim();
    const userLogged = users.find(
      (user) => user.username === username && user.password === password
    );

    if (userLogged) {
      sessionStorage.setItem("Usuario Logueado", "true");
      sessionStorage.setItem("Username", userLogged.username);
      sessionStorage.setItem("Rol", userLogged.rol);

      playbutton();
      updateWelcome(userLogged.username);

      const modal = bootstrap.Modal.getInstance(
        document.getElementById("modalLogin")
      );
      modal.hide();
    } else {
      alert("Usuario o contraseña incorrectos");
    }
  });

  function playbutton() {
    sesionbtn.textContent = "Jugar";
    sesionbtn.removeAttribute("data-bs-toggle");
    sesionbtn.removeAttribute("data-bs-target");

    sesionbtn.onclick = () => {
      window.location.href = "views/game.html";
    };
  }

  function updateWelcome(username) {
    const welcomeText = document.getElementById("welcome");
    if (welcomeText) {
      welcomeText.textContent = `Bienvenido ${username}`;
      welcomeText.classList.remove("d-none");
    }
  }
});
