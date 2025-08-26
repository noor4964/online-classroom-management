document.addEventListener('DOMContentLoaded', function() {
    console.log('Validation script loaded');
    
    // Login Form Validation
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        console.log('Login form found');
        loginForm.addEventListener('submit', function(e) {
            let isValid = true;
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value.trim();
            
            clearErrors();
            
            if (email === '') {
                displayError('email', 'Email address is required');
                isValid = false;
            } else if (!isValidEmail(email)) {
                displayError('email', 'Please enter a valid email address');
                isValid = false;
            }
            
            if (password === '') {
                displayError('password', 'Password is required');
                isValid = false;
            }
            
            if (!isValid) {
                console.log('Validation failed, preventing form submission');
                e.preventDefault();
            } else {
                console.log('Form validated successfully');
            }
        });
    }
    
    //Registration Form Validation
    
    const registerForm = document.getElementById('registerForm');
    if (registerForm) {
        console.log('Register form found');
        registerForm.addEventListener('submit', function(e) {
            let isValid = true;
            const firstName = document.getElementById('firstName').value.trim();
            const lastName = document.getElementById('lastName').value.trim();
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value.trim();
            const confirmPassword = document.getElementById('confirmPassword').value.trim();
            
            clearErrors();
            
            if (firstName === '') {
                displayError('firstName', 'First name is required');
                isValid = false;
            }
            
            if (lastName === '') {
                displayError('lastName', 'Last name is required');
                isValid = false;
            }
            
            if (email === '') {
                displayError('email', 'Email address is required');
                isValid = false;
            } else if (!isValidEmail(email)) {
                displayError('email', 'Please enter a valid email address');
                isValid = false;
            }
            
           
            if (password === '') {
                displayError('password', 'Password is required');
                isValid = false;
            } else if (password.length < 6) {
                displayError('password', 'Password must be at least 6 characters long');
                isValid = false;
            }
            
           
            if (confirmPassword === '') {
                displayError('confirmPassword', 'Please confirm your password');
                isValid = false;
            } else if (password !== confirmPassword) {
                displayError('confirmPassword', 'Passwords do not match');
                isValid = false;
            }
            
            if (!isValid) {
                console.log('Validation failed, preventing form submission');
                e.preventDefault();
            } else {
                console.log('Form validated successfully');
            }
        });
    }
    
   
    function displayError(inputId, message) {
        console.log('Displaying error for ' + inputId + ': ' + message);
        const inputElement = document.getElementById(inputId);
        if (!inputElement) {
            console.error('Element with ID ' + inputId + ' not found');
            return;
        }
        const errorDiv = document.createElement('div');
        errorDiv.className = 'error-message';
        errorDiv.textContent = message;
        
        
        inputElement.parentNode.insertBefore(errorDiv, inputElement.nextSibling);
        
        
        inputElement.classList.add('is-invalid');
    }
    
    function clearErrors() {
        
        const errorMessages = document.querySelectorAll('.error-message');
        errorMessages.forEach(function(error) {
            error.remove();
        });
        
        
        const inputs = document.querySelectorAll('.is-invalid');
        inputs.forEach(function(input) {
            input.classList.remove('is-invalid');
        });
    }
    
    function isValidEmail(email) {
        
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
});