import { forEach, on } from './functions';

//Todo botão para abrir uma quickview tem um atributo 'data-target' => esse atributo é o ID da quickview
const initQuickview = quickviewTriggerSelector => {
	const quickviewTriggers = document.querySelectorAll(quickviewTriggerSelector);
	const quickviews = document.querySelectorAll('.quickview');
	forEach(quickviewTriggers, trigger => {
		const quickview = document.getElementById(trigger.dataset.target);
		const closeButton = quickview.querySelector('.delete');
		on('click', trigger, () => {
			forEach(quickviews, el => {
				if (el != quickview) {
					el.classList.remove('is-active');
				}
			})
			quickview.classList.toggle('is-active');
		});
		on('click', closeButton, () => {
			quickview.classList.remove('is-active');
		});
	});
}

export { initQuickview };