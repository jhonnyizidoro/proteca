import { forEach } from './functions';

const setHeight = ()=> {
	const iframes = document.querySelectorAll('iframe');
	forEach(iframes, iframe => {
		iframe.height = iframe.parentElement.clientWidth * (9 / 16);
	})
}

export {setHeight};