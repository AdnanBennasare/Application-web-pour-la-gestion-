document.getElementById('signupbtn').onclick = function () {



    console.log("fff");
    function setErrorFor(element,errorMessage) {

        // ==================
        const parent = element.closest('.formvalid');
        if (parent.classList.contains('formvalid-success')) {
            parent.classList.remove('formvalid-success');
        }
        parent.classList.add('formvalid-error');
        // ---------------
        const small = parent.querySelector('small');
        small.textContent = errorMessage;
    }


    function setSuccessFor(element) {
        const parent = element.closest('.formvalid');
        if (parent.classList.contains('formvalid-error')) {
            parent.classList.remove('formvalid-error');
        }

        parent.classList.add('formvalid-success');
        const small = parent.querySelector('small');
        small.textContent = ' ';
    }

    //   ========================---------
    form = document.querySelector('#signupform');
    const name = document.querySelector("#name");
    const lastname = document.querySelector("#lastname");
    const email = document.querySelector("#email");
    const phone = document.querySelector("#phone");
    const pwd = document.querySelector("#pwd");
    const pwd_repeated = document.querySelector('#pwd_repeated');
    //   ========================---------



    document.querySelector('#signupform').addEventListener('submit',(event) => {
        validate_Form_updat_announce();

        console.log(isFormValid_updat_announce());

        if (isFormValid_updat_announce() == true) {
            form.submit();
        } else {
            event.preventDefault();
        }

    });

    function isFormValid_updat_announce() {
        const inputContainers = form.querySelectorAll('.formvalid');
        let result = true;
        inputContainers.forEach((container) => {
            if (container.classList.contains('formvalid-error')) {
                result = false;
            }
        });
        return result;
    }

    function validate_name() {
        if (name.value.match(/[a-zA-Z]{3,10}/g)) {
            setSuccessFor(name);
        } else {
            setErrorFor(name,'champ obligatoir');
        }
    }

    function validate_lastname() {
        if (lastname.value.match(/[a-zA-Z]{3,10}/g)) {
            setSuccessFor(lastname);
        } else {
            setErrorFor(lastname,'champ obligatoir');
        }
    }


    function validate_email() {
        if (email.value.match(/([a-z\d\.-]+)@[a-zA-Z]{3,10}\.([a-z]{2,8})(\.[a-z]{2,8})?$/g)) {
            setSuccessFor(email);
        } else {
            setErrorFor(email,'champ obligatoir');
        }
    }

    function validate_phone() {
        if (phone.value.match(/0(6|7|5)[0-9]{8}$/g)) {
            setSuccessFor(phone);
        } else {
            setErrorFor(phone,'champ obligatoir');
        }
    }

    function validate_pwd() {
        if (pwd.value.match(/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/g)) {
            setSuccessFor(pwd);
        } else {
            setErrorFor(pwd,'champ obligatoir');
        }
    }

    function validate_pwd_repeated() {
        if (pwd_repeated.value !== "" && pwd_repeated.value == pwd.value) {
            setSuccessFor(pwd_repeated);
        } else {
            setErrorFor(pwd_repeated,'champ obligatoir');
        }
    }

    function validate_Form_updat_announce() {
        validate_name();
        validate_lastname();
        validate_email();
        validate_phone()
        validate_pwd();
        validate_pwd_repeated();
    }


}




document.getElementById('loginbtn').onclick = function () {


    console.log("ggg");
    function setErrorFor(element,errorMessage) {

        // ==================
        const parent = element.closest('.formvalidation');
        if (parent.classList.contains('formvalidation-success')) {
            parent.classList.remove('formvalidation-success');
        }
        parent.classList.add('formvalidation-error');
        // ---------------
        const small = parent.querySelector('small');
        small.textContent = errorMessage;
    }


    function setSuccessFor(element) {
        const parent = element.closest('.formvalidation');
        if (parent.classList.contains('formvalidation-error')) {
            parent.classList.remove('formvalidation-error');
        }

        parent.classList.add('formvalidation-success');
        const small = parent.querySelector('small');
        small.textContent = ' ';
    }

    //   ========================---------
    const formlogin = document.querySelector('#loginform');
    const emaillogin = document.querySelector('#emaillogin');
    const pwdlogin = document.querySelector("#pwdlogin");

    //   ========================---------



    formlogin.addEventListener('submit',(event) => {
        validate_Form_updat_announce();

        console.log(isFormValid_updat_announce());

        if (isFormValid_updat_announce() == true) {
            formlogin.submit();
        } else {
            
            event.preventDefault();
        }

    });

    function isFormValid_updat_announce() {
        const inputContainers = formlogin.querySelectorAll('.formvalidation');
        let result = true;
        inputContainers.forEach((container) => {
            if (container.classList.contains('formvalidation-error')) {
                result = false;
            }
        });
        return result;
    }






    function validate_emaillogin() {
        if (emaillogin.value.match(/([a-z\d\.-]+)@[a-zA-Z]{3,10}\.([a-z]{2,8})(\.[a-z]{2,8})?$/g)) {
            setSuccessFor(emaillogin);
        } else {
            setErrorFor(emaillogin,'Please enter a valid email adresse');
        }
    }

    function validate_pwdlogin() {
        if (pwdlogin.value.match(/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/g)) {
            setSuccessFor(pwdlogin);
        } else {
            setErrorFor(pwdlogin,'Password must be atleast 8 characters and contain number');
        }
    }

    function validate_Form_updat_announce() {
        validate_emaillogin();
        validate_pwdlogin();
    }



}
// document.getElementById('gotosignup').onclick = function () {
    
// }
