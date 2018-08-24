const initModal = (modalSelector, openModalButtonSelector, closeModalButtonSelector) => {
    const modal = document.querySelector(modalSelector);
    const openModalButton = document.querySelector(openModalButtonSelector);
    const closeModalButton = document.querySelector(closeModalButtonSelector);
    openModalButton.addEventListener('click', ()=> {
        modal.classList.add('is-active');
    });
    closeModalButton.addEventListener('click', ()=> {
        modal.classList.remove('is-active');
    });
}

export {initModal};