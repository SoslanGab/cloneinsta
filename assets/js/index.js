const switchers = [...document.querySelectorAll('.switcher')]

switchers.forEach(item => {
	item.addEventListener('click', function() {
		switchers.forEach(item => item.parentElement.classList.remove('is-active'))
		this.parentElement.classList.add('is-active')
	})
})


const usernameInput = document.getElementsByName('createUsername');
const loginInput = document.getElementsByName('createLogin');
const passwordInput = document.getElementsByName('createPassword');
const passwordConfirmationInput = document.getElementsByName('confirmPassword');


const usernameRequirements = [
	{regex: /^.{2,12}$/, index: 0},
	{regex: /^[a-zA-Z0-9]+$/, index: 1}
]

const loginRequirements = [
	{regex: /^.{6,12}$/, index: 0},
	{regex: /^[a-zA-Z0-9]+$/, index: 1}
]

const passwordRequirements = [
	{regex: /^.{6,12}$/, index: 0},
	{regex: /[a-zA-Z]/, index: 1},
	{regex: /\d/, index: 2},
	{regex: /[!@#$%]/, index: 3}
]


usernameInput.addEventListener("keyup", (event)=>{
	usernameRequirements.forEach(item => {
		let isValid = item.regex.test(event.target.value);

		if(isValid){

		} else {

		}
	})
})


loginInput.addEventListener("keyup", (event)=>{
	loginRequirements.forEach(item => {
		let isValid = item.regex.test(event.target.value);

		if(isValid){

		} else {
			
		}
	})
})


passwordInput.addEventListener("keyup", (event)=>{
	passwordRequirements.forEach(item => {
		let isValid = item.regex.test(event.target.value);

		if(isValid){

		} else {
			
		}
	})
})