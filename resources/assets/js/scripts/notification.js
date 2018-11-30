import { forEach, on } from './functions';

const initNotification = () => {
	const notifications = document.querySelectorAll('.notification');
	forEach(notifications, notification => {
		on('click', notification.children[0], ()=> {
			notification.style.display = 'none';
		})
	});
}

export {initNotification};