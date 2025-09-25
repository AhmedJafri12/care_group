<?php 
$page_title = 'Login - CareGroup';
include 'includes/header.php'; 

if (isLoggedIn()) {
    redirect('index.php');
}
?>

<section class="auth-container">
    <div class="auth-wrapper">
        <div class="text-center mb-4">
            <div class="logo mb-3">
                <i class="fas fa-sign-in-alt" style="font-size: 3rem; color: var(--primary-color);"></i>
            </div>
            <h2 class="auth-title">Welcome Back</h2>
            <p class="text-muted">Sign in to your CareGroup account</p>
        </div>
        
        <form id="login-form" class="auth-form">
            <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">
            
            <div class="form-group">
                <label for="login_email">Email or Username</label>
                <input type="text" 
                       id="login_email" 
                       name="email" 
                       placeholder="Enter your email or username" 
                       required 
                       autocomplete="username">
            </div>
            
            <div class="form-group password-toggle">
                <label for="login_password">Password</label>
                <div class="position-relative">
                    <input type="password" 
                           id="login_password" 
                           name="password" 
                           placeholder="Enter your password" 
                           required 
                           autocomplete="current-password">
                    <i class="fas fa-eye-slash" id="toggleLoginPassword"></i>
                </div>
            </div>
            
            <div class="form-group form-check mb-4">
                <input type="checkbox" class="form-check-input" id="remember_me" name="remember_me">
                <label class="form-check-label" for="remember_me">
                    Remember me
                </label>
            </div>
            
            <button type="submit" class="btn btn-primary w-100 mb-3">
                <i class="fas fa-sign-in-alt me-2"></i>Sign In
            </button>
            
            <div class="text-center">
                <a href="#" onclick="showPasswordReset()" class="text-muted text-decoration-none">
                    Forgot your password?
                </a>
            </div>
        </form>
        
        <div class="auth-links">
            <p class="mb-0">Don't have an account?</p>
            <a href="signup.php">Create a new account</a>
        </div>
    </div>
</section>

<!-- Password Reset Modal -->
<div id="passwordResetModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3><i class="fas fa-key"></i> Reset Password</h3>
            <span class="close" onclick="closePasswordReset()">&times;</span>
        </div>
        <div class="modal-body">
            <form id="passwordResetForm">
                <div class="form-group">
                    <label for="reset_email">Email Address</label>
                    <input type="email" id="reset_email" name="email" placeholder="Enter your email address" required>
                    <small class="form-text text-muted">We'll send you a password reset link</small>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Send Reset Link</button>
                    <button type="button" class="btn btn-secondary" onclick="closePasswordReset()">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.auth-container {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 20px;
}

.auth-wrapper {
    background: var(--white);
    padding: 3rem;
    border-radius: var(--border-radius);
    box-shadow: var(--shadow-lg);
    width: 100%;
    max-width: 450px;
    animation: fadeInUp 0.8s ease;
}

.logo {
    display: flex;
    justify-content: center;
    align-items: center;
}

.auth-title {
    color: var(--text-dark);
    margin-bottom: 0.5rem;
}

.auth-form .form-group {
    margin-bottom: 1.5rem;
}

.auth-form .btn {
    padding: 12px;
    font-size: 1rem;
    font-weight: 600;
}

.password-toggle {
    position: relative;
}

.password-toggle input {
    padding-right: 40px;
}

.password-toggle i {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
    color: var(--text-light);
    transition: var(--transition);
}

.password-toggle i:hover {
    color: var(--primary-color);
}

.form-check {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.form-check-input {
    width: auto;
    margin: 0;
}

.auth-links {
    text-align: center;
    margin-top: 2rem;
    padding-top: 2rem;
    border-top: 1px solid var(--border-color);
}

.auth-links a {
    color: var(--primary-color);
    text-decoration: none;
    font-weight: 500;
}

.auth-links a:hover {
    text-decoration: underline;
}

@media (max-width: 480px) {
    .auth-wrapper {
        margin: 1rem;
        padding: 2rem;
    }
    
    .modal-content {
        margin: 1rem;
        width: calc(100% - 2rem);
    }
}
</style>

<script>
// Initialize password toggle
document.addEventListener('DOMContentLoaded', function() {
    const toggleLoginPassword = document.getElementById('toggleLoginPassword');
    const loginPassword = document.getElementById('login_password');
    
    if (toggleLoginPassword && loginPassword) {
        toggleLoginPassword.addEventListener('click', function() {
            const type = loginPassword.getAttribute('type') === 'password' ? 'text' : 'password';
            loginPassword.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
            this.classList.toggle('fa-eye');
        });
    }
    
    // Password reset form
    const resetForm = document.getElementById('passwordResetForm');
    if (resetForm) {
        resetForm.addEventListener('submit', handlePasswordReset);
    }
    
    // Close modals on escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closePasswordReset();
        }
    });
});

function showPasswordReset() {
    document.getElementById('passwordResetModal').style.display = 'block';
    document.body.style.overflow = 'hidden';
    document.getElementById('reset_email').focus();
}

function closePasswordReset() {
    document.getElementById('passwordResetModal').style.display = 'none';
    document.body.style.overflow = 'auto';
    document.getElementById('passwordResetForm').reset();
}

function handlePasswordReset(e) {
    e.preventDefault();
    
    if (!validateForm('passwordResetForm')) {
        return;
    }
    
    const formData = new FormData(this);
    const submitBtn = this.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';
    submitBtn.disabled = true;
    
    fetch('api/password-reset.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showNotification(data.message || 'Password reset link sent to your email!', 'success');
            closePasswordReset();
        } else {
            showNotification(data.message || 'Failed to send reset link', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('An error occurred. Please try again.', 'error');
    })
    .finally(() => {
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
    });
}

// Close modal when clicking outside
window.addEventListener('click', function(e) {
    const modal = document.getElementById('passwordResetModal');
    if (e.target === modal) {
        closePasswordReset();
    }
});
</script>

<?php include 'includes/footer.php'; ?>