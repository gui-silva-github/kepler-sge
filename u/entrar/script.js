const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

signUpButton.addEventListener('click', () => {
	container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
	container.classList.remove("right-panel-active");
});

// return history btn function

const historyBackBtn = document.querySelector('h2::before');

console.log(historyBackBtn)
historyBackBtn.addEventListener('click', () => {
	console('clicou')
    history.back();
});