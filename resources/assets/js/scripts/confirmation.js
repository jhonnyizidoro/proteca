const initConfirmation = (confirmationSelector, triggersSelector) => {

    const triggers = document.querySelectorAll(triggersSelector);
    const confirmationWindow = document.querySelector(confirmationSelector);
    const trueButton = document.querySelector(confirmationSelector + ' .true');
    const falseButton = document.querySelector(confirmationSelector + ' .false');
    const closeButton = document.querySelector(confirmationSelector + ' .confirmation-close');
    let clickEvent;

    closeButton.addEventListener('click', ()=> {
        confirmationWindow.classList.remove('is-active');
    });
    falseButton.addEventListener('click', ()=> {
        confirmationWindow.classList.remove('is-active');
    });

    triggers.forEach(trigger => {
        trigger.addEventListener('click', e => {
            e.preventDefault();
            confirmationWindow.classList.add('is-active');
            clickEvent = e;
        });
    });

    trueButton.addEventListener('click', ()=> {
        confirmationWindow.classList.remove('is-active');
        try {
            window.location.replace(clickEvent.target.href);
        } catch (error) {
            location.reload();
        }
    });

}

export {initConfirmation}