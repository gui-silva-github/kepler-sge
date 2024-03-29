// overlayer animation
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

const historyBackBtn = document.querySelector('.return-page-btn');
historyBackBtn.addEventListener('click', () => history.back());

// Mostrar modal pós-cadastro

const modal = document.querySelector('.modal');
const closeModalBtn = document.querySelector('#closeModal-btn');
closeModalBtn.addEventListener('click', () =>{window.location.href = "../entrar/";});

function showModal() {
	modal.classList.add("active");
}
