function validateForm() {
    const user_name = document.getElementById('user_name').value;
    const auth_name = document.getElementById('emp_name').value;
    const contact_no = document.getElementById('contact_no').value;
    const password = document.getElementById('password').value;

    if (!user_name || !emp_name || !contact_no || !password) {
        alert("All fields must be filled out!");
        return false;
    }
    return true;
}

function searchAuth() {
    const search = document.getElementById('search').value;
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "../controller/authController.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            document.getElementById('authTable').innerHTML = this.responseText;
        }
    };
    xhr.send("action=search&search_term=" + search);
}