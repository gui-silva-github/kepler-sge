function createInput(){
	let radioButtons = document.querySelectorAll('input[name="entrarUserType"]');
	radioButtons.forEach((radioButton) => {
        radioButton.addEventListener('change', function(){
    		let selectedUserType;
			for (const radioButton of radioButtons) {
				if (radioButton.checked) {
					selectedUserType = radioButton.value;
					break;
				}
			}
			
			if (selectedUserType != "instituicao") {
				let newInput = document.createElement('input');
				newInput.type = 'text';
				newInput.placeholder = 'Nome da Instituição';
				newInput.name = 'entrarNomeInstituicao';
				newInput.id = 'entrarNomeInstituicao';
				newInput.required = true;

				let formContainer = document.querySelector('body .container .sign-in-container form');

				let existInput = formContainer.querySelector("#entrarNomeInstituicao");

				if (!existInput) {

				let userTypeInputs = formContainer.querySelector('.userType-inputs');

				formContainer.insertBefore(newInput, userTypeInputs.nextSibling);
				}
			}
        });
	});
}