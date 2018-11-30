import { forEach, on, forEachIndex } from './functions';

const initModal = (modalSelector, openModalButtonsSelector, closeModalButtonSelector) => {
    const modal = document.querySelector(modalSelector);
    const openModalButtons = document.querySelectorAll(openModalButtonsSelector);
	const closeModalButton = document.querySelector(closeModalButtonSelector);
	forEach(openModalButtons, openModalButton => {
		on('click', openModalButton, ()=> {
			modal.classList.add('is-active');
		});
	});
	on('click', closeModalButton, ()=> {
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
	forEachIndex(modalSections, (section, index) => {
		section.innerHTML = contents[index];
	});
}

export {initModal, changeModalContent};