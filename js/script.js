document.querySelectorAll('.view-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        // Aktywuj przycisk
        document.querySelectorAll('.view-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        
        // Przełącz widok
        document.querySelectorAll('.task-view').forEach(view => view.style.display = 'none');
        document.getElementById(`${btn.dataset.view}-view`).style.display = 'block';
    });
});
