// Simulated user database
const users = {
    approved: [
        { username: 'admin1', password: 'admin123', type: 'admin' },
        { username: 'driver1', password: 'drive123', type: 'bus-driver' },
        { username: 'student2', password: 'pass456', type: 'student-teacher' }
    ],
    pending: [
        { username: 'student1', password: 'pass123', type: 'student-teacher' },
        { username: 'teacher1', password: 'teach123', type: 'student-teacher' }
    ]
};

// Toggle mobile menu
document.querySelector('.menu-toggle').addEventListener('click', () => {
    document.querySelector('.nav-links').classList.toggle('active');
});

// Smooth scroll for nav links
document.querySelectorAll('.nav-links a').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        e.preventDefault();
        const href = this.getAttribute('href');
        if (href.includes('#')) {
            const section = document.querySelector(href);
            section.scrollIntoView({ behavior: 'smooth' });
        } else {
            window.location.href = href;
        }
        document.querySelector('.nav-links').classList.remove('active');
    });
});

// Handle login form submission
const loginForm = document.getElementById('login-form');
if (loginForm) {
    loginForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const userType = document.getElementById('user-type').value;
        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;

        console.log('Login Attempt:', { userType, username, password });

        const approvedUser = users.approved.find(u =>
            u.username === username && u.password === password && u.type === userType
        );
        const pendingUser = users.pending.find(u =>
            u.username === username && u.password === password && u.type === userType
        );

        if (approvedUser) {
            alert(`Logging in as ${userType} with username: ${username}`);
            if (userType === 'admin') {
                window.location.href = 'admin/admin.html';
            } else if (userType === 'bus-driver') {
                window.location.href = 'driver/driver.html';
            } else if (userType === 'student-teacher') {
                window.location.href = 'student-teacher/student-teacher.html';
            }
        } else if (pendingUser) {
            alert('Your account is pending admin approval. Please wait.');
        } else {
            alert('Invalid credentials or account not found.');
        }

        loginForm.reset();
    });
}

// Handle signup form submission
const signupForm = document.getElementById('signup-form');
if (signupForm) {
    signupForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const userType = document.getElementById('user-type').value;
        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirm-password').value;

        if (password !== confirmPassword) {
            alert('Passwords do not match!');
            return;
        }

        const existingUser = [...users.approved, ...users.pending].find(u => u.username === username);
        if (existingUser) {
            alert('Username already exists!');
            return;
        }

        const newUser = { username, password, type: userType };
        if (userType === 'student-teacher') {
            users.pending.push(newUser);
            alert('Account created! Awaiting admin approval.');
        } else {
            users.approved.push(newUser);
            alert('Account created! You can now log in.');
        }

        console.log('New User:', newUser);
        signupForm.reset();
        window.location.href = 'login.html';
    });
}