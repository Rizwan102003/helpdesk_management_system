document.addEventListener("DOMContentLoaded", () => {
    console.log("Main JS Loaded.");

    const loginForm = document.querySelector("form");
    if (loginForm) {
        loginForm.addEventListener("submit", (e) => {
            const empId = loginForm.querySelector("input[name='employee_id']").value.trim();
            const password = loginForm.querySelector("input[name='password']").value.trim();
            if (!empId || !password) {
                e.preventDefault();
                alert("Please enter both Employee ID and Password.");
            }
        });
    }
});
