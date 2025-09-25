<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Responsive Logout Component</title>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f4f6f8;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .logout-container {
      background-color: white;
      padding: 2rem;
      border-radius: 12px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
      text-align: center;
      width: 90%;
      max-width: 400px;
    }

    .logout-container h2 {
      margin-bottom: 1rem;
      color: #333;
    }

    .logout-button {
      background-color: #dc3545;
      color: white;
      border: none;
      padding: 0.8rem 1.5rem;
      border-radius: 8px;
      font-size: 1rem;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .logout-button:hover {
      background-color: #c82333;
    }

    .confirm-box {
      display: none;
      margin-top: 1.5rem;
      background-color: #fff3cd;
      color: #856404;
      padding: 1rem;
      border-radius: 8px;
      border: 1px solid #ffeeba;
    }

    .confirm-actions {
      margin-top: 1rem;
      display: flex;
      justify-content: center;
      gap: 1rem;
    }

    .confirm-button,
    .cancel-button {
      padding: 0.6rem 1.2rem;
      border: none;
      border-radius: 6px;
      font-size: 0.95rem;
      cursor: pointer;
    }

    .confirm-button {
      background-color: #28a745;
      color: white;
    }

    .confirm-button:hover {
      background-color: #218838;
    }

    .cancel-button {
      background-color: #6c757d;
      color: white;
    }

    .cancel-button:hover {
      background-color: #5a6268;
    }

    @media (max-width: 480px) {
      .logout-container {
        padding: 1.5rem;
      }

      .logout-button {
        width: 100%;
      }

      .confirm-actions {
        flex-direction: column;
        gap: 0.5rem;
      }

      .confirm-button,
      .cancel-button {
        width: 100%;
      }
    }
  </style>
</head>
<body>

<div class="logout-container">
  <h2>Are you sure you want to logout?</h2>
  <button class="logout-button" id="logoutBtn">Logout</button>

  <div class="confirm-box" id="confirmBox">
    <p>Please confirm you want to log out.</p>
    <div class="confirm-actions">
      <button class="confirm-button" id="confirmLogout">Yes, Logout</button>
      <button class="cancel-button" id="cancelLogout">Cancel</button>
    </div>
  </div>
</div>

<script>
  const logoutBtn = document.getElementById('logoutBtn');
  const confirmBox = document.getElementById('confirmBox');
  const confirmLogout = document.getElementById('confirmLogout');
  const cancelLogout = document.getElementById('cancelLogout');

  logoutBtn.addEventListener('click', () => {
    confirmBox.style.display = 'block';
  });

  cancelLogout.addEventListener('click', () => {
    confirmBox.style.display = 'none';
  });

  confirmLogout.addEventListener('click', () => {
    // Simulate logout process
    alert("You have been logged out.");
    
    // Redirect to login page (example)
    window.location.href = "/login"; // change this to your actual login page
  });
</script>

</body>
</html>
