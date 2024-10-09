const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

window.addEventListener('load', () => {
    setTimeout(() => {
        container.classList.add('right-panel-active');
    }, 100);
});

signInButton.addEventListener('click', () => {
	container.classList.add("right-panel-active");
});

signUpButton.addEventListener('click', () => {
	container.classList.remove("right-panel-active");
});