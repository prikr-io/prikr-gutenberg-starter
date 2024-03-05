import Splide from '@splidejs/splide';

var splideSliders = document.getElementsByClassName('splide');
for (var i = 0; i < splideSliders.length; i++) {
	const splider = new Splide(splideSliders[i])
	handleExceptions(splider, splideSliders[i]);
}

function handleExceptions(slider, element) {
	slider.mount()
}

