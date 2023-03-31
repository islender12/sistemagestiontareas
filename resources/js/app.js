import "./bootstrap";
const menusDesplegables = document.querySelectorAll(".menudesplegable");

menusDesplegables.forEach((menuDesplegable) => {
    const Submenu = document.querySelector(".submenu");
    menuDesplegable.addEventListener("click", () => {
        if (Submenu.classList.contains("hidden")) {
            Submenu.classList.remove("hidden");
        } else {
            Submenu.classList.add("hidden");
        }
    });
});
