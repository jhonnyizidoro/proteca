const resizeToFit = titleSelector => {
	const titles = document.querySelectorAll(titleSelector);
	titles.forEach(title => {
		if (title.innerHTML.length > 15 && window.innerWidth > 768){
			title.style.fontSize = '1rem';
		}
	});
}

export {resizeToFit};