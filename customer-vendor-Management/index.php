<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Management System</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      background-image: url('./assets/Image/background.webp');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      background-attachment: fixed;
    }

    body::before {
      content: "";
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5);
      pointer-events: none;
      z-index: 1;
    }

    .container {
      display: flex;
      justify-content: space-between;
      align-items: stretch;
      width: 100%;
      height: 100vh;
      margin: auto;
      z-index: 2;
      position: relative;
    }

    /* Left Panel */
    .left-panel {
      flex: 1;
      padding: 40px 20px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      color: #00ff99;
    }

    .left-panel h1 {
      font-size: 2.5rem;
      text-align: center;
      margin-bottom: 30px;
    }

    .button-row {
      display: flex;
      gap: 20px;
      justify-content: center;
    }

    .button-row .btn {
      display: inline-block;
      padding: 12px 30px;
      font-size: 18px;
      font-weight: bold;
      color: white;
      background-color: #ff3b3b;
      border-radius: 8px;
      text-decoration: none;
      transition: all 0.3s ease;
    }

    .button-row .btn:hover {
      background-color: #e03434;
      transform: scale(1.05);
    }


    /* Right Panel */
    .right-panel {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
      position: relative;
    }

    .right-panel img {
      width: 100%;
      max-width: 630px;
      border-radius: 25px;
      transition: transform 0.5s ease;
    }

    /* Arrows */
    .arrows {
      position: absolute;
      display: flex;
      gap: 10px;
      font-size: 24px;
      color: #00ff99;
      animation: floatArrow 2s ease-in-out infinite alternate;
    }

    @keyframes floatArrow {
      0% {
        transform: translateY(0);
      }

      100% {
        transform: translateY(-10px);
      }
    }

    .top-right {
      top: 20px;
      right: 20px;
      flex-direction: column;
    }

    .bottom-left {
      bottom: 20px;
      left: 20px;
      flex-direction: column-reverse;
    }

    /* Responsive Media Query */
    @media (max-width: 992px) {
      .container {
        flex-direction: column;
        height: auto;
        padding: 20px 0;
      }

      .left-panel,
      .right-panel {
        flex: unset;
        width: 100%;
        padding: 20px;
        text-align: center;
      }

      .left-panel h1 {
        font-size: 2rem;
      }

      .button-row {
        flex-direction: column;
        gap: 15px;
      }

      .button-row .btn {
        width: 80%;
        margin: 0 auto;
        padding: 10px 0;
      }

      .right-panel img {
        width: 90%;
        max-width: 500px;
      }
    }

    @media (max-width: 576px) {
      .left-panel h1 {
        font-size: 1.6rem;
      }

      .button-row .btn {
        font-size: 16px;
        padding: 8px 0;
      }

      .right-panel img {
        width: 100%;
        border-radius: 15px;
      }
    }
  </style>
</head>

<body>
  <div class="container">
    <!-- Left Panel -->
    <div class="left-panel">
      <h1>Welcome<br />Customer & Vendor Management</h1>
      <div class="button-row">
        <a href="customers/index.php" class="btn">Manage Customers</a>
        <a href="vendors/index.php" class="btn">Manage Vendors</a>
      </div>
      <div class="arrows bottom-left">
        <span>▶</span><span>▶</span><span>▶</span>
      </div>
    </div>

    <!-- Right Panel -->
    <div class="right-panel">
      <img src="./assets/Image/background-image.png" alt="Person">
      <div class="arrows top-right">
        <span>▶</span><span>▶</span><span>▶</span>
      </div>

    </div>
  </div>
</body>

</html>