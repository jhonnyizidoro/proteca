const initModal = (modalSelector, openModalButtonsSelector, closeModalButtonSelector) => {
    const modal = document.querySelector(modalSelector);
    const openModalButtons = document.querySelectorAll(openModalButtonsSelector);
	const closeModalButton = document.querySelector(closeModalButtonSelector);
	openModalButtons.forEach(openModalButton => {
		openModalButton.addEventListener('click', ()=> {
			modal.classList.add('is-active');
		});
	});
    closeModalButton.addEventListener('click', ()=> {
        modal.classList.remove('is-active');
    });
}
/**
 * @param Array recebe dois arrays de mesmo tamanho
 * @return void
 * Cada endereço do array modalSections receberá o conteúdo do mesmo endereço do array contents
 */
const changeModalContent = (modalSectionsSelector, contents) => {
	const modalSections = document.querySelectorAll(modalSectionsSelector);
	modalSections.forEach((section, index) => {
		section.innerHTML = contents[index];
	});
}

export {initModal, changeModalContent};