document.addEventListener("DOMContentLoaded", function () {
  eventListeners();

  darkMode();
});

function eventListeners() {
  const mobileMenu = document.querySelector(".mobile-menu");

  mobileMenu.addEventListener("click", responsiveNavigation);
}

function responsiveNavigation() {
  const navigation = document.querySelector(".navegacion");

  navigation.classList.toggle("mostrar");
}

function darkMode() {
  const modeSettings = window.matchMedia("(prefers-color-schema: dark)");
  // console.log(modeSettings)

  if (modeSettings.matches) {
    document.body.classList.add("dark-mode");
  } else {
    document.body.classList.remove("dark-mode");
  }

  modeSettings.addEventListener("change", function () {
    if (modeSettings.matches) {
      document.body.classList.add("dark-mode");
    } else {
      document.body.classList.remove("dark-mode");
    }
  });

  const btnDarkMode = document.querySelector(".dark-mode-boton");
  btnDarkMode.addEventListener("click", () => {
    document.body.classList.toggle("dark-mode");
  });
}
