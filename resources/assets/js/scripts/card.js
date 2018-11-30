import { forEach } from './functions';

const resizeToFit = titleSelector => {
	const titles = document.querySelectorAll(titleSelector);
	forEach(titles, title => {
		if (title.innerHTML.length > 15 && window.innerWidth > 768){
			title.style.fontSize = '1rem';
		}
	})
}

export {resizeToFit};