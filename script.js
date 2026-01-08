document.addEventListener("DOMContentLoaded", function () {
  var alertElement = document.querySelector(".alert");

  if (alertElement) {
    setTimeout(function () {
      alertElement.style.transition = "opacity 0.5s ease";
      alertElement.style.opacity = "0";
      setTimeout(function () {
        alertElement.remove();
      }, 500);
    }, 5000);
  }
});

//fungsi waktu
function tampilWaktu() {
  var waktu = new Date();
  var bulan = waktu.getMonth() + 1;

  var tanggalLengkap =
    waktu.getDate() + "/" + bulan + "/" + waktu.getFullYear();
  function formatDuaDigit(angka) {
    return angka < 10 ? "0" + angka : angka;
  }

  var jamLengkap =
    formatDuaDigit(waktu.getHours()) +
    ":" +
    formatDuaDigit(waktu.getMinutes()) +
    ":" +
    formatDuaDigit(waktu.getSeconds());

  document.getElementById("tanggal").innerHTML = tanggalLengkap;
  document.getElementById("jam").innerHTML = jamLengkap;
}

tampilWaktu();

setInterval(tampilWaktu, 1000);

//theme switcher
const tombolIreng = document.getElementById("tombolIreng");
const tombolPth = document.getElementById("tombolPth");

//tombol dark
tombolIreng.addEventListener("click", () => {
  document.body.classList.add("dark-mode");
});

//tombol light
tombolPth.addEventListener("click", () => {
  document.body.classList.remove("dark-mode");
});

//fungsi scroll
document.querySelectorAll('a.nav-link[href^="#"]').forEach((link) => {
  link.addEventListener("click", function (e) {
    e.preventDefault();
    const target = document.querySelector(this.getAttribute("href"));
    if (target) {
      target.scrollIntoView({ behavior: "smooth" });
    }
  });
});

//login
const tmblLogin1 = document.getElementById("tmblLogin1");
const tmblLogin2 = document.getElementById("tmblLogin2");

tmblLogin1?.addEventListener("click", () => {
  window.open("login.php", "_blank");
});

tmblLogin2.addEventListener("click", () => {
  window.open("login.php", "_blank");
});

// buka form login
tmblLogin1?.addEventListener("click", () => {
  loginContainer.classList.remove("d-none");
  loginContainer.scrollIntoView({ behavior: "smooth" });
});

tmblLogin2?.addEventListener("click", () => {
  loginContainer.classList.remove("d-none");
  loginContainer.scrollIntoView({ behavior: "smooth" });
});
