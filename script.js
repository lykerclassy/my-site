document.addEventListener("DOMContentLoaded", function() {
    const loginForm = document.getElementById("loginForm");
    const signupForm = document.getElementById("signupForm");
    const loginBtn = document.getElementById("loginBtn");
    const signupBtn = document.getElementById("signupBtn");

    // Function to show login and hide signup
    loginBtn.addEventListener("click", function() {
        loginForm.style.display = "block";
        signupForm.style.display = "none";
        loginBtn.classList.add("active");
        signupBtn.classList.remove("active");
    });

    // Function to show signup and hide login
    signupBtn.addEventListener("click", function() {
        signupForm.style.display = "block";
        loginForm.style.display = "none";
        signupBtn.classList.add("active");
        loginBtn.classList.remove("active");
    });

    // Ensure login form is shown first when page loads
    loginForm.style.display = "block";
    signupForm.style.display = "none";
});
