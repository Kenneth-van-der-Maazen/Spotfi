<?php

?>

    </div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const toggle = document.querySelector(".dropdown-toggle");
    const menu = document.querySelector(".dropdown-menu");

    if (toggle && menu) {
        toggle.addEventListener("click", function (e) {
            e.stopPropagation();
            menu.style.display = menu.style.display === "block" ? "none" : "block";
        });

        // Klik buiten dropdown sluit het menu
        window.addEventListener("click", function () {
            menu.style.display = "none";
        });
    }
});
</script>

</body>
</html>