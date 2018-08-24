const initNotification = () => {
    const notifications = document.querySelectorAll('.notification');
    notifications.forEach(notification => {
        notification.children[0].addEventListener('click', ()=> {
            notification.style.display = 'none';
        });
    });
}

export {initNotification};