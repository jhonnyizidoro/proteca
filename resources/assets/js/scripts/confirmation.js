const initConfirmation = () => {
	
	const triggers = document.querySelectorAll('.confirmed');
	const confirmationWindow = document.querySelector('.confirmation');
	const trueButton = document.querySelector('.confirmation .true');
	const falseButton = document.querySelector('.confirmation .false');
	const closeButton = document.querySelector('.confirmation .confirmation-close');
	
	triggers.forEach(trigger => {
		trigger.addEventListener('click', (e)=> {
			confirmationWindow.classList.add('is-active');
			confirmationWindow.onclick = (click)  => {
				if (click.target == trueButton) {
					window.location.href = trigger.dataset.action;
				}
			}
		});
	});
	
	closeButton.addEventListener('click', ()=> {
		confirmationWindow.classList.remove('is-active');
	});
	falseButton.addEventListener('click', ()=> {
		confirmationWindow.classList.remove('is-active');
	});
	
}

export {initConfirmation}