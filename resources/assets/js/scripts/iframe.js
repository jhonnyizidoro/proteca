const setHeight = ()=> {
	const iframes = document.querySelectorAll('iframe');
	iframes.forEach(iframe => {
		iframe.height = iframe.parentElement.clientWidth * (9 / 16);
	});
}

export {setHeight};