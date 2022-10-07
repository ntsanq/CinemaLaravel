<!DOCTYPE html>
<html>
    <body>
        <form id="login-form">
            <div>
                <label>Email:</label>
                <input name="email" id="email"/>
            </div>
            <div>
                <label>Password:</label>
                <input name="password" id="password"/>
            </div>
            <button type="submit">Login</button>
        </form>
        <br><br>
        <div id="login-result">You haven't logged in yet!</div>
    </body>
</html>
<script>
    const form = document.querySelector('#login-form');
    const result = document.querySelector('#login-result');

    async function login() {
        window.token = null;

        const email = document.querySelector('#email');
        const password = document.querySelector('#password');
        if (!email || !password) return;

        const res = await fetch('http://localhost:8001/api/auth', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                email: email.value,
                password: password.value
            })
        })

        if (res.status !== 200) {
            const data = await res.json();
            result.textContent = 'Login error: ' + data.message;
            throw new Error('Login status is not 200');
        }

        const data = await res.json();
        localStorage.setItem('token', data.token);
        result.textContent = 'Login successfully! Token: ' + data.token;
    }

    async function getUser() {
        result.textContent = 'Login successfully! User is not defined yet';

        if (!localStorage.getItem('token')) return;

        const res = await fetch('http://localhost:8001/api/user', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'Authorization': 'Bearer ' + localStorage.getItem('token')
            }
        });

        if (res.status !== 200) {
            const data = await res.json();
            result.textContent = 'User error: ' + data.message;
            return;
        }

        const data = await res.json();
        result.textContent = 'User data: ' + data.message;
    }

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        if (!form || !result) return;

        try {
            await login();
            await getUser();
        } catch (e) {
            console.log(e);
            // window.location = 'https://google.com';
        }
    });
</script>
