modal = require('./scripts/modal');

const workScript = ()=> {
	const modalButtons = document.querySelectorAll('.work');
	const cardButton = document.querySelector('.card a');
	let buttonText;
	modalButtons.forEach(modalButton => {
		modalButton.addEventListener('click', ()=> {
			if (!modalButton.dataset.file){
				cardButton.classList.add('is-disabled');
			} else {
				cardButton.classList.remove('is-disabled');
				cardButton.href = modalButton.dataset.file;
			}
			modalButton.dataset.file ? buttonText = 'Download do arquivo' : buttonText = 'Nenhum arquivo disponível';
			modal.changeModalContent(
				[
					'.card .card-header-title',
					'.card .content',
					'.card a',
				],
				[
					modalButton.dataset.title,
					modalButton.dataset.abstract,
					buttonText,
				],
			);
		});
	});
}

export {workScript};