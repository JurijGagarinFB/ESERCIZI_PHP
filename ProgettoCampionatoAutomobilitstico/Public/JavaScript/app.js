(() => {
    const burger = document.getElementById("burger");
    const overlay = document.getElementById("overlay");

    if (!burger || !overlay) {
        return;
    }

    const closeSidebar = () => {
        document.body.classList.remove("sidebar-open");
    };

    burger.addEventListener("click", () => {
        document.body.classList.toggle("sidebar-open");
    });

    overlay.addEventListener("click", closeSidebar);

    window.addEventListener("resize", () => {
        if (window.innerWidth > 900) {
            closeSidebar();
        }
    });
})();
