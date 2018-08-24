//Todo botão para abrir uma quickview tem um atributo 'data-target' => esse atributo é o ID da quickview
const initQuickview = quickviewTriggerSelector => {
    const quickviewTriggers = document.querySelectorAll(quickviewTriggerSelector);
    const quickviews = document.querySelectorAll('.quickview');
    quickviewTriggers.forEach(trigger => {
        const quickview = document.getElementById(trigger.dataset.target);
        const closeButton = quickview.querySelector('.delete');
        trigger.addEventListener('click', ()=> {
            quickviews.forEach(el => {
                if (el != quickview) {
                    el.classList.remove('is-active');
                }
            });
            quickview.classList.toggle('is-active');
        });
        closeButton.addEventListener('click', ()=> {
            quickview.classList.remove('is-active');
        });
    });
}

export {initQuickview};