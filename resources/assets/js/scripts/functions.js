const includes = (string, substring) => string.indexOf(substring) !== -1

const forEach = (list, callback) => {
	for (let index = 0; index < list.length; index++) {
		callback(list[index])
	}
}

const forEachIndex = (list, callback) => {
	for (let index = 0; index < list.length; index++) {
		callback(list[index], index)
	}
}

const on = (eventName, elements, callback)=> {
	if (!eventName || !elements || !callback) {
		return
	}
	if (elements instanceof NodeList && elements.length > 0) {
		forEach(elements, element => {
			element.addEventListener(eventName, event => {
				callback(element, event)
			})
		});
	} else if (elements instanceof Element || elements instanceof HTMLDocument) {
		elements.addEventListener(eventName, event => {
			callback(event)
		})
	}
}

export { forEach, forEachIndex, includes, on }