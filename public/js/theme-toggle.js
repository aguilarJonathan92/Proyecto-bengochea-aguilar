const themeToggleBtn = document.getElementById('theme-toggle');
const sunIcon = document.getElementById('theme-toggle-light-icon');
const moonIcon = document.getElementById('theme-toggle-dark-icon');

function updateIcons() {
    const isLight = document.documentElement.classList.contains('light');
    if (isLight) {
        moonIcon.classList.remove('hidden');
        sunIcon.classList.add('hidden');
    } else {
        sunIcon.classList.remove('hidden');
        moonIcon.classList.add('hidden');
    }
}

themeToggleBtn.addEventListener('click', function() {
    // Solo alternamos la clase .light
    document.documentElement.classList.toggle('light');

    // Guardamos el estado basado en si la clase existe
    const currentTheme = document.documentElement.classList.contains('light') ? 'light' : 'dark';
    localStorage.setItem('theme', currentTheme);

    updateIcons();
});

// Al cargar la página
const savedTheme = localStorage.getItem('theme');
if (savedTheme === 'light') {
    document.documentElement.classList.add('light');
} else {
    document.documentElement.classList.remove('light');
}
updateIcons();
