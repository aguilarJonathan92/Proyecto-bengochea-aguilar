setTimeout(() => {
            const el = document.getElementById('flash-message');
            if (el) {
                el.style.transition = 'opacity 0.5s ease';
                el.style.opacity = '0';
                setTimeout(() => el.remove(), 500);
            }
        }, 3000); // 3 segundos antes de desaparecer