class ThemeManager {
    constructor() {
        this.themeToggle = document.getElementById('theme-toggle');
        this.htmlElement = document.documentElement;
        this.init();
    }

    init() {
        // Check for saved theme preference or use preferred color scheme
        const savedTheme = localStorage.getItem('theme') || 
                         (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
        
        this.setTheme(savedTheme);
        this.setupEventListeners();
    }

    setTheme(theme) {
        this.htmlElement.classList.remove('light', 'dark');
        this.htmlElement.classList.add(theme);
        localStorage.setItem('theme', theme);
        
        // Update toggle button icon
        const iconMoon = this.themeToggle.querySelector('.fa-moon');
        const iconSun = this.themeToggle.querySelector('.fa-sun');
        
        if (theme === 'dark') {
            iconMoon.classList.add('hidden');
            iconSun.classList.remove('hidden');
        } else {
            iconMoon.classList.remove('hidden');
            iconSun.classList.add('hidden');
        }
    }

    toggleTheme() {
        const currentTheme = localStorage.getItem('theme') || 'light';
        const newTheme = currentTheme === 'light' ? 'dark' : 'light';
        this.setTheme(newTheme);
    }

    setupEventListeners() {
        this.themeToggle.addEventListener('click', () => this.toggleTheme());
    }
}

// Initialize theme manager when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    new ThemeManager();
});
