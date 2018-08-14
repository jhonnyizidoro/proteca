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

const initNotification = () => {
    const notifications = document.querySelectorAll('.notification');
    notifications.forEach(notification => {
        notification.children[0].addEventListener('click', ()=> {
            notification.style.display = 'none';
        });
    });
}

const initFileField = (inputSelector, labelSelector) => {
    const input = document.querySelector(inputSelector);
    const label = document.querySelector(labelSelector);
    input.addEventListener('change', ()=> {
        label.innerHTML = input.files[0].name;
    });
}

const changeImageSrcWhenInputChanges = (inputSelector, imgSelector)=> {
    const input = document.querySelector(inputSelector);
    const image = document.querySelector(imgSelector);
    input.addEventListener('change', ()=> {
        if (input.files[0]) {
            const reader = new FileReader();
            reader.readAsDataURL(input.files[0]);
            reader.onloadend = data => {
                image.src = data.target.result;
            }
        }
    });
}

const initCharCounter = (inputSelector, charCounterSelector) => {
    const input = document.querySelector(inputSelector);
    const counter = document.querySelector(charCounterSelector);
    const maxLength = counter.innerHTML;
    input.addEventListener('keyup', ()=>{
        if (counter.innerHTML = maxLength - input.value.length >= 0){
            counter.classList.remove('text-danger'); 
            counter.innerHTML = maxLength - input.value.length;
        } else {
            counter.classList.add('text-danger');
            counter.innerHTML = 0;
        }
    });
}

export {initModal, initNotification, initFileField, changeImageSrcWhenInputChanges, initCharCounter};