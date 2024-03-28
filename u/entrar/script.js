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

// showLoginModal

const modal = document.querySelector('.modal');

function showModal() {
	modal.classList.add("active");

	modalHeader.children[1].addEventListener('click', () =>{
		modal.classList.remove("active");
	});
}

// redirectAfterTime function

function redirectAfterTimeout(url, time) {

    setTimeout(() => {
        window.location.href = url;
    }, time);
}
