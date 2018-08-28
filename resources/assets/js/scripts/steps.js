const initSteps = stepsSelector => {
    const stepsTitle = document.querySelectorAll(stepsSelector + ' .step-item');
    const stepsContent = document.querySelectorAll(stepsSelector +' .step-content');
    const nextButton = document.querySelector(stepsSelector + ' .next-step');
    const previousButton = document.querySelector(stepsSelector + ' .previous-step');
    const maxSteps = stepsTitle.length - 1;
    let activeStep = 0;

    /**
     * Um do título ('.step-item') deve ter a classe 'is-active', esse trecho de código adiciona
     * a classe 'is-active' no conteúdo do step referente ao título ativo.
     * Exemplo: se o step 2 está com a classe 'is.active', o segunto step também terá essa classe
     * esse código também adiciona a classe 'is-completed' nos títulos enquanto não encontrar no título ativo
     */
    let found = false;
    stepsTitle.forEach(stepTitle => {
        if (stepTitle.classList.contains('is-active') && !found){
            found = true;
        }else if (!found) {
            stepTitle.classList.add('is-completed');
            activeStep++;
        }
    });
    if (!found){
        activeStep = 0;
        stepsTitle[activeStep].classList.add('is-active');
        stepsTitle.forEach(stepTitle => {
            stepTitle.classList.remove('is-completed');
        });
    }
    stepsContent[activeStep].classList.add('is-active');

    //Adiciona a classe is-disabled nos botões caso esteja no primeiro ou no último step
    if (activeStep == maxSteps){
        nextButton.classList.add('is-disabled');
    } else if (activeStep == 0){
        previousButton.classList.add('is-disabled');
    }

    //Evento botão next
    nextButton.addEventListener('click', () => {
        previousButton.classList.remove('is-disabled');
        if (activeStep < maxSteps){
            stepsTitle[activeStep].classList.remove('is-active');
            stepsContent[activeStep].classList.remove('is-active');
            stepsTitle[activeStep].classList.add('is-completed');
            activeStep++;
            stepsTitle[activeStep].classList.add('is-active');
            stepsContent[activeStep].classList.add('is-active');
        }
        if (activeStep == maxSteps) {
            nextButton.classList.add('is-disabled');
        }
    });

    //Evento botão previous
    previousButton.addEventListener('click', () => {
        nextButton.classList.remove('is-disabled');
        if (activeStep > 0){
            stepsTitle[activeStep].classList.remove('is-active');
            stepsContent[activeStep].classList.remove('is-active');
            stepsTitle[activeStep].classList.remove('is-completed');
            activeStep--;
            stepsTitle[activeStep].classList.add('is-active');
            stepsContent[activeStep].classList.add('is-active');
        }
        if (activeStep == 0) {
            previousButton.classList.add('is-disabled');
        }
    });

}

export {initSteps};