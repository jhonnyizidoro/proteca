import { forEach, on } from './functions';

const initConfirmation = () => {
	
	const triggers = document.querySelectorAll('.confirmed');
	const confirmationWindow = document.querySelector('.confirmation');
	const trueButton = document.querySelector('.confirmation .true');
	const falseButton = document.querySelector('.confirmation .false');
	const closeButton = document.querySelector('.confirmation .confirmation-close');

	forEach(triggers, trigger => {
		on('click', trigger, e => {
			confirmationWindow.classList.add('is-active');
			confirmationWindow.onclick = (click)  => {
				if (click.target == trueButton) {
					window.location.href = trigger.dataset.action;
				}
			}
		});
	})
	
	on('click', closeButton, ()=> {
		confirmationWindow.classList.remove('is-active');
	});

	on('click', falseButton, ()=> {
		confirmationWindow.classList.remove('is-active');
	});
	
}

export {initConfirmation}