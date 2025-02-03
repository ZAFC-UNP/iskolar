<?php
  session_unset();
  $page_title = "Iskolar Online Login"; 
  include('includes/header.php'); 
  include('includes/dbcon.php');
  include('auth/signin.php')
  
?>

<link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
    <style>
      body {
      height: 100%;
      /* overflow: hidden; */
      /* background-image: url('img/index.png');
      background-size: cover; */
      }   
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        width: 100%;
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }

      .btn-bd-primary {
        --bd-violet-bg: #712cf9;
        --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

        --bs-btn-font-weight: 600;
        --bs-btn-color: var(--bs-white);
        --bs-btn-bg: var(--bd-violet-bg);
        --bs-btn-border-color: var(--bd-violet-bg);
        --bs-btn-hover-color: var(--bs-white);
        --bs-btn-hover-bg: #6528e0;
        --bs-btn-hover-border-color: #6528e0;
        --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
        --bs-btn-active-color: var(--bs-btn-hover-color);
        --bs-btn-active-bg: #5a23c8;
        --bs-btn-active-border-color: #5a23c8;
      }
        
      .bd-mode-toggle {
        z-index: 1500;
      }

      .bd-mode-toggle .dropdown-menu .active .bi {
        display: block !important;
      }

    /* Form style */
    .form-signin {
      max-width: 400px;
      padding: 1rem;
      backdrop-filter: blur(10px) brightness(0.7);
      background-color: rgba(255, 255, 255, .7);
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
      position:absolute;
      right: 15%;
    }
    
    .form-signin .form-floating:focus-within {
      z-index: 2;
    }

    .form-signin input[type="email"] {
      margin-bottom: -1px;
      border-bottom-right-radius: 0;
      border-bottom-left-radius: 0;
    }

    .form-signin input[type="password"],[type="text"] {
      margin-bottom: 10px;
      border-top-left-radius: 0;
      border-top-right-radius: 0;
    }
    .error{
      margin-top: 5%;
      margin-bottom: -10%;
      align-items: center;
      text-align: center;
      color: red;
    }    
    #error {
      transition: opacity 1s ease-out;
      opacity: 1;
      color: red;
    }
    #error.hide {
      opacity: 0;
    }
    .img-container {
      position: absolute;
      top: 0;
      left: 0;
      width: 100vw;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      z-index: -1;
      pointer-events: none;
    }

    .img-container img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
    </style>

<script>
  // JavaScript for toggling password visibility
  function togglePassword() {
    var passwordInput = document.getElementById("password");
    var eyeIcon = document.getElementById("showPassword");

    if (passwordInput.type == "password") {
      passwordInput.type = "text";
      eyeIcon.classList.remove("fa-eye");
      eyeIcon.classList.add("fa-eye-slash");
    } else {
      passwordInput.type = "password";
      eyeIcon.classList.remove("fa-eye-slash");
      eyeIcon.classList.add("fa-eye");
    }
  }

  // JavaScript for hiding error message
  document.addEventListener('DOMContentLoaded', function() {
    function hideError() {
      const errorElement = document.querySelector(".error");
      if (errorElement) {
        errorElement.classList.add("hide");
      }
    }
  });
</script>

</head>
    
  <body class="d-flex align-items-center py-4 bg-body-tertiary">
    
    

    <main class="container mt-5">
      <div class="row justify-content-center">
          <div class="col-lg-6 col-md-8 col-sm-12">
            <form id="sign-in" method="POST" class="form-signin">
              <!-- <img class="mb-4" style="width: 100%;" src="img/logo2.png" md-0 alt="UNP Iskolar" width="auto" height="72" > -->
              <h1 class="h2 mb-3 fw-normal welcome" style="font-family: 'Lobster', cursive;font-weight: 100;">Welcome ka-iSkolar!</h1>

              <div class="form-floating" name= "Username">
              <input type="text" class="form-control" id="floatingInput" placeholder="Enter ID number..." name="username" onfocus="hideError()" oninput="hideError()" onclick="hideError()" autocomplete="off">
            
                <label for="floatingInput" style="background-color: transparent;">ID Number</label>
                <i class="far fa-user" style="position: absolute; top: 50%; right: 10px; transform: translateY(-50%); opacity: .7;"></i>
              </div>
              <div class="form-floating">
                <input type="password" class="form-control" id="password" placeholder="Password" name="password" autocomplete="off">
                <label for="floatingPassword" style="background-color: transparent;">Password</label>
                <i class="far fa-eye" id="showPassword" onclick="togglePassword(this)" style="position: absolute; top: 50%; right: 10px; transform: translateY(-50%); cursor: pointer; opacity: .7;"></i>
              </div>
              <button name="login" class="btn btn-primary w-100 py-2" style="background-color: forestgreen; border: none;"type="submit">Sign in</button>
              <?php if(isset($error)) { ?>
                              <div class="error" id="error"><?php echo $error; ?></div>
                          <?php } ?>
                          <di style="color: #333;">
                            <p class="mt-5 mb-2"> Don't have account yet, <span><a href="register.php" style="text-decoration: none;">click here</a></span> to sign up</p>
                            <p class="mt-8 mb-3">     Forgot Password? <a href="forgot-password.php" style="text-decoration: none;">click here</a> to reset your password.</p>
                            <p class="mt-5 mb">&copy; 2023–2024</p>
              
            </form>
        </div>
      </div>
    </main>

<div class="img-container">
<img src="img/index.png" alt="">
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
function hideError() {
  const errorElement = document.getElementById("error");
  if (errorElement) {
    errorElement.classList.add("hide");
  }
}
});
</script>
<?php 
  include('includes\footer.php');
?>