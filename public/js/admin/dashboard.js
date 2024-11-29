function toggleSidebar() {
    const sidebar = document.getElementById("sidebar");
    const currentWidth = sidebar.style.width;

    const sidebarWidth = "210px";

    const hamburger = document.getElementById('hamburger');
    hamburger.classList.toggle('change');

    if (currentWidth === sidebarWidth || currentWidth === "100%") {
        sidebar.style.width = "0";
    } else {
        if (window.innerWidth <= 768) {
            sidebar.style.width = "100%";
        } else {
            sidebar.style.width = sidebarWidth;
        }
    }

    window.addEventListener('DOMContentLoaded', (event) => {
        const path = window.location.pathname;
        const menuItem = document.querySelector(`.menu-item[href="${path}"]`);
      
        if (menuItem) {
          menuItem.classList.add('active'); // Add 'active' class to the current page link
        }
      });
}