document.addEventListener("DOMContentLoaded", () => {
  const users = [
    { username: "user", password: "user1234", rol: "user" },
    { username: "admin", password: "admin1234", rol: "admin" },
  ];

  const loginbtn = document.querySelector(".modal-footer .btn.btn-primary");
  const sesionbtn = document.getElementById("sesion");
  const inputuser = document.getElementById("usuario-login");
  const inputpassword = document.getElementById("password-login");

  const isLogged = sessionStorage.getItem("Usuario Logueado");
  if (isLogged) {
    playbutton();
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
      window.location.href = "/Software-x/views/game.html";
    };
  }
});
