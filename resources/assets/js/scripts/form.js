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
            counter.classList.remove('text-danger'); 
            counter.innerHTML = maxLength - input.value.length;
        } else {
            counter.classList.add('text-danger');
            counter.innerHTML = 0;
        }
    });
}

export {initFileField, initCharCounter, changeImageSrcWhenInputChanges};