function showAdminSection(section) {
    const sections = [
        'dashboard', 'users', 'teachers', 'groups', 
        'chats', 'statistics', 'payments', 'settings'
    ];

    sections.forEach(sec => {
        const el = document.getElementById(`admin-${sec}-section`);
        if (el) el.style.display = 'none';
    });

    const links = document.querySelectorAll('.menu-link');
    links.forEach(link => link.classList.remove('active'));

    const target = document.getElementById(`admin-${section}-section`);
    if (target) target.style.display = 'block';

    event.currentTarget.classList.add('active');
}