import "./bootstrap";
const menusDesplegables = document.querySelectorAll(".menudesplegable");

menusDesplegables.forEach((menuDesplegable) => {
    menuDesplegable.addEventListener("click", () => {
        const Submenu = menuDesplegable.children[1];
        if (Submenu.classList.contains("hidden")) {
            Submenu.classList.remove("hidden");
        } else {
            Submenu.classList.add("hidden");
        }
    });
})
