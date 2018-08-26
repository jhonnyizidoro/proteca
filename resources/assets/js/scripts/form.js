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
    counter.innerHTML = maxLength - input.value.length;
    input.addEventListener('keyup', ()=>{
        if (counter.innerHTML = maxLength - input.value.length >= 0){
            input.classList.remove('is-invalid');
            counter.classList.remove('text-danger'); 
            counter.innerHTML = maxLength - input.value.length;
        } else {
            input.classList.add('is-invalid');
            counter.classList.add('text-danger');
            counter.innerHTML = 0;
        }
    });
}

const initMaskedDateForm = inputSelector => {
    const input = document.querySelector(inputSelector);
    const isNumericRegex = /^[0-9]+$/;
    const dateRegex = {
        ddmm: /^\d{2}$/,
        yyyy: /^\d{2}\/\d{2}$/
    };
    input.addEventListener('keypress', (e)=> {
        if (input.value.length > 9 || !e.key.match(isNumericRegex)) {
            e.preventDefault();
        } else if (input.value.match(dateRegex.ddmm) || input.value.match(dateRegex.yyyy)) {
            input.value = input.value + '/';
        }
    });
}

const initMaskedTimeForm = inputSelector => {
    const input = document.querySelector(inputSelector);
    const isNumericRegex = /^[0-9]+$/;
    const timeRegex = /^([0-1]?[0-9]|2[0-3]):([0-5][0-9])(:[0-5][0-9])?$/;
    input.addEventListener('keypress', (e)=> {
        if (input.value.length >= 5 || !e.key.match(isNumericRegex)) {
             e.preventDefault();
        }
        if (input.value.length == 2){
            input.value = input.value + ':';
        }
    });
    input.addEventListener('keyup', (e)=> {
        if (input.value.length == 5) {
            if (timeRegex.test(input.value)) {
                input.classList.remove('is-invalid');
            } else {
                input.classList.add('is-invalid');
            }
       }
    });
}

export {initFileField, initCharCounter, changeImageSrcWhenInputChanges, initMaskedDateForm, initMaskedTimeForm};