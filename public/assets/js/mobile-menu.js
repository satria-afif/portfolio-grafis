class MobileMenu {
    constructor() {
        this.menuButton = document.getElementById('mobile-menu-button');
        this.menu = document.getElementById('mobile-menu');
        this.init();
    }

    init() {
        this.setupEventListeners();
    }

    setupEventListeners() {
        this.menuButton.addEventListener('click', () => this.toggleMenu());
    }

    toggleMenu() {
        this.menu.classList.toggle('hidden');
    }
}

// Initialize mobile menu when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    new MobileMenu();
});
