class PortfolioManager {
    constructor() {
        this.grid = document.getElementById('portfolio-grid');
        this.filterButtons = document.querySelectorAll('.filter-btn');
        this.init();
    }

    async init() {
        await this.loadProjects();
        this.setupEventListeners();
    }

    async loadProjects() {
        try {
            const response = await fetch('/includes/get_projects.php');
            const projects = await response.json();
            
            this.displayProjects(projects);
        } catch (error) {
            console.error('Error loading projects:', error);
        }
    }

    displayProjects(projects) {
        this.grid.innerHTML = '';
        
        projects.forEach(project => {
            const projectElement = this.createProjectElement(project);
            this.grid.appendChild(projectElement);
        });
    }

    createProjectElement(project) {
        const projectElement = document.createElement('div');
        projectElement.className = 'portfolio-item group relative overflow-hidden rounded-lg shadow-lg';
        projectElement.dataset.category = project.category.toLowerCase();
        
        projectElement.innerHTML = `
            <div class="relative h-64 overflow-hidden">
                <img src="${project.image_path}" alt="${project.title}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                    <button class="view-details px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition" data-id="${project.id}">
                        View Details
                    </button>
                </div>
            </div>
            <div class="p-4">
                <h3 class="text-xl font-semibold mb-1">${project.title}</h3>
                <p class="text-gray-600 dark:text-gray-300">${project.category}</p>
            </div>
        `;
        
        return projectElement;
    }

    filterProjects(category) {
        const items = document.querySelectorAll('.portfolio-item');
        
        items.forEach(item => {
            if (category === 'all' || item.dataset.category === category) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    }

    setupEventListeners() {
        this.filterButtons.forEach(button => {
            button.addEventListener('click', () => {
                // Update active button
                this.filterButtons.forEach(btn => {
                    btn.classList.remove('bg-indigo-600', 'text-white');
                    btn.classList.add('bg-gray-200', 'dark:bg-gray-700', 'hover:bg-gray-300', 'dark:hover:bg-gray-600');
                });
                
                button.classList.add('bg-indigo-600', 'text-white');
                button.classList.remove('bg-gray-200', 'dark:bg-gray-700', 'hover:bg-gray-300', 'dark:hover:bg-gray-600');
                
                // Filter projects
                this.filterProjects(button.dataset.filter);
            });
        });
    }
}

// Initialize portfolio manager when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    new PortfolioManager();
});
