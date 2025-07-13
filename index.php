<?php
session_start();

if (isset($_SESSION['login_email']) || isset($_COOKIE['login_email'])) {
    header('Location: chatrix.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatrix - Login</title>
    <link rel="stylesheet" href="index.css">

    <script>
  // Check if cookie 'login_email' exists; if yes, redirect to chatrix.php
  function getCookie(name) {
    let matches = document.cookie.match(new RegExp(
      "(?:^|; )" + name.replace(/([$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
    return matches ? decodeURIComponent(matches[1]) : undefined;
  }

  if(getCookie('login_email')) {
    window.location.href = 'chatrix.php';
  }
    </script>
</head>
<body>

    <nav>
        <h2>Chatrix</h2>
    </nav>

    <!-- -------------------Login Section------------------- -->

    <section id="login-section">
        <div class="back_ani">
            <div class="back_ani1" style="background-color: #252525;"></div>
            <div class="back_ani2" style="background-color: #252525;"></div>
            <div class="back_ani3" style="background-color: #252525;"></div>
            <div class="back_ani4" style="background-color: #252525;"></div>
            <div class="back_ani5" style="background-color: #252525;"></div>
            <div class="back_ani6" style="background-color: #252525;"></div>
            <div class="back_ani7" style="background-color: #252525;"></div>
            <div class="back_ani8" style="background-color: #252525;"></div>
            <div class="back_ani9" style="background-color: #252525;"></div>
            <div class="back_ani10" style="background-color: #252525;"></div>
            <div class="back_ani11" style="background-color: #252525;"></div>
            <div class="back_ani12" style="background-color: #252525;"></div>
            <div class="back_ani13" style="background-color: #252525;"></div>
            <div class="back_ani14" style="background-color: #252525;"></div>
            <div class="back_ani15" style="background-color: #252525;"></div>
            <div class="back_ani16" style="background-color: #252525;"></div>
            <div class="back_ani17" style="background-color: #252525;"></div>
            <div class="back_ani18" style="background-color: #252525;"></div>
            <div class="back_ani19" style="background-color: #252525;"></div>
            <div class="back_ani20" style="background-color: #252525;"></div>
            <div class="back_ani21" style="background-color: #252525;"></div>
            <div class="back_ani22" style="background-color: #252525;"></div>
            <div class="back_ani23" style="background-color: #252525;"></div>
            <div class="back_ani24" style="background-color: #252525;"></div>
            <div class="back_ani25" style="background-color: #252525;"></div>
            <div class="back_ani26" style="background-color: #252525;"></div>
            <div class="back_ani27" style="background-color: #252525;"></div>
            <div class="back_ani28" style="background-color: #252525;"></div>
            <div class="back_ani29" style="background-color: #252525;"></div>
            <div class="back_ani30" style="background-color: #252525;"></div>
            <div class="back_ani31" style="background-color: #252525;"></div>
            <div class="back_ani32" style="background-color: #252525;"></div>
            <div class="back_ani33" style="background-color: #252525;"></div>
            <div class="back_ani34" style="background-color: #252525;"></div>
            <div class="back_ani35" style="background-color: #252525;"></div>
            <div class="back_ani36" style="background-color: #252525;"></div>
            <div class="back_ani37" style="background-color: #252525;"></div>
            <div class="back_ani38" style="background-color: #252525;"></div>
            <div class="back_ani39" style="background-color: #252525;"></div>
            <div class="back_ani40" style="background-color: #252525;"></div>
            <div class="back_ani41" style="background-color: #252525;"></div>
            <div class="back_ani42" style="background-color: #252525;"></div>
            <div class="back_ani43" style="background-color: #252525;"></div>
            <div class="back_ani44" style="background-color: #252525;"></div>
            <div class="back_ani45" style="background-color: #252525;"></div>
            <div class="back_ani46" style="background-color: #252525;"></div>
            <div class="back_ani47" style="background-color: #252525;"></div>
            <div class="back_ani48" style="background-color: #252525;"></div>
            <div class="back_ani49" style="background-color: #252525;"></div>
            <div class="back_ani50" style="background-color: #252525;"></div>
            <div class="back_ani51" style="background-color: #252525;"></div>
            <div class="back_ani52" style="background-color: #252525;"></div>
            <div class="back_ani53" style="background-color: #252525;"></div>
            <div class="back_ani54" style="background-color: #252525;"></div>
            <div class="back_ani55" style="background-color: #252525;"></div>
            <div class="back_ani56" style="background-color: #252525;"></div>
            <div class="back_ani57" style="background-color: #252525;"></div>
            <div class="back_ani58" style="background-color: #252525;"></div>
            <div class="back_ani59" style="background-color: #252525;"></div>
            <div class="back_ani60" style="background-color: #252525;"></div>
            <div class="back_ani61" style="background-color: #252525;"></div>
            <div class="back_ani62" style="background-color: #252525;"></div>
            <div class="back_ani63" style="background-color: #252525;"></div>
            <div class="back_ani64" style="background-color: #252525;"></div>
            <div class="back_ani65" style="background-color: #252525;"></div>
            <div class="back_ani66" style="background-color: #252525;"></div>
            <div class="back_ani67" style="background-color: #252525;"></div>
            <div class="back_ani68" style="background-color: #252525;"></div>
            <div class="back_ani69" style="background-color: #252525;"></div>
            <div class="back_ani70" style="background-color: #252525;"></div>
        </div>
        <div class="login-container">
            <h1>Welcome to Chatrix</h1>
            <p>Connect with anyone, anytime.</p>
            <hr><br>

            <center>
                <form id="otp_form" action="send_otp.php" method="POST">
                    <input type="email" placeholder="Enter Your Email" class="input1" name="email" required>
                    <p id="otp_msg"></p>
                    <button type="submit" class="g_btn" id="generate_btn">Generate OTP</button>
                </form>

                <form action="verify_otp.php" method="POST" id="otp_verify_form">
                    <input type="hidden" name="email" id="email_hidden">
                    <input type="text" placeholder="Enter OTP" class="otp_v" name="otp_v" required>
                    <button type="submit" class="verify_btn" id="verify_btn">Verify</button>
                </form>

            </center>

            <h4>No account? No worries <a href="#signup-section">Sign Up</a> here.</h4>
        </div>

    </section>

        <!-- -------------------Signup Section------------------- -->
    <section id="signup-section">
        <div class="back_ani">
            <div class="back_ani1" style="background-color: #252525;"></div>
            <div class="back_ani2" style="background-color: #252525;"></div>
            <div class="back_ani3" style="background-color: #252525;"></div>
            <div class="back_ani4" style="background-color: #252525;"></div>
            <div class="back_ani5" style="background-color: #252525;"></div>
            <div class="back_ani6" style="background-color: #252525;"></div>
            <div class="back_ani7" style="background-color: #252525;"></div>
            <div class="back_ani8" style="background-color: #252525;"></div>
            <div class="back_ani9" style="background-color: #252525;"></div>
            <div class="back_ani10" style="background-color: #252525;"></div>
            <div class="back_ani11" style="background-color: #252525;"></div>
            <div class="back_ani12" style="background-color: #252525;"></div>
            <div class="back_ani13" style="background-color: #252525;"></div>
            <div class="back_ani14" style="background-color: #252525;"></div>
            <div class="back_ani15" style="background-color: #252525;"></div>
            <div class="back_ani16" style="background-color: #252525;"></div>
            <div class="back_ani17" style="background-color: #252525;"></div>
            <div class="back_ani18" style="background-color: #252525;"></div>
            <div class="back_ani19" style="background-color: #252525;"></div>
            <div class="back_ani20" style="background-color: #252525;"></div>
            <div class="back_ani21" style="background-color: #252525;"></div>
            <div class="back_ani22" style="background-color: #252525;"></div>
            <div class="back_ani23" style="background-color: #252525;"></div>
            <div class="back_ani24" style="background-color: #252525;"></div>
            <div class="back_ani25" style="background-color: #252525;"></div>
            <div class="back_ani26" style="background-color: #252525;"></div>
            <div class="back_ani27" style="background-color: #252525;"></div>
            <div class="back_ani28" style="background-color: #252525;"></div>
            <div class="back_ani29" style="background-color: #252525;"></div>
            <div class="back_ani30" style="background-color: #252525;"></div>
            <div class="back_ani31" style="background-color: #252525;"></div>
            <div class="back_ani32" style="background-color: #252525;"></div>
            <div class="back_ani33" style="background-color: #252525;"></div>
            <div class="back_ani34" style="background-color: #252525;"></div>
            <div class="back_ani35" style="background-color: #252525;"></div>
            <div class="back_ani36" style="background-color: #252525;"></div>
            <div class="back_ani37" style="background-color: #252525;"></div>
            <div class="back_ani38" style="background-color: #252525;"></div>
            <div class="back_ani39" style="background-color: #252525;"></div>
            <div class="back_ani40" style="background-color: #252525;"></div>
            <div class="back_ani41" style="background-color: #252525;"></div>
            <div class="back_ani42" style="background-color: #252525;"></div>
            <div class="back_ani43" style="background-color: #252525;"></div>
            <div class="back_ani44" style="background-color: #252525;"></div>
            <div class="back_ani45" style="background-color: #252525;"></div>
            <div class="back_ani46" style="background-color: #252525;"></div>
            <div class="back_ani47" style="background-color: #252525;"></div>
            <div class="back_ani48" style="background-color: #252525;"></div>
            <div class="back_ani49" style="background-color: #252525;"></div>
            <div class="back_ani50" style="background-color: #252525;"></div>
            <div class="back_ani51" style="background-color: #252525;"></div>
            <div class="back_ani52" style="background-color: #252525;"></div>
            <div class="back_ani53" style="background-color: #252525;"></div>
            <div class="back_ani54" style="background-color: #252525;"></div>
            <div class="back_ani55" style="background-color: #252525;"></div>
            <div class="back_ani56" style="background-color: #252525;"></div>
            <div class="back_ani57" style="background-color: #252525;"></div>
            <div class="back_ani58" style="background-color: #252525;"></div>
            <div class="back_ani59" style="background-color: #252525;"></div>
            <div class="back_ani60" style="background-color: #252525;"></div>
            <div class="back_ani61" style="background-color: #252525;"></div>
            <div class="back_ani62" style="background-color: #252525;"></div>
            <div class="back_ani63" style="background-color: #252525;"></div>
            <div class="back_ani64" style="background-color: #252525;"></div>
            <div class="back_ani65" style="background-color: #252525;"></div>
            <div class="back_ani66" style="background-color: #252525;"></div>
            <div class="back_ani67" style="background-color: #252525;"></div>
            <div class="back_ani68" style="background-color: #252525;"></div>
            <div class="back_ani69" style="background-color: #252525;"></div>
            <div class="back_ani70" style="background-color: #252525;"></div>
        </div>
        <div class="signup-container">
            <h1>Sign Up now</h1>
            <hr><br>

            <center>
                <form id="signup_otp_form" method="POST">
                    <input type="text" name="name" placeholder="Enter Your Name" class="input2" required><br>
                    <input type="email" name="email" placeholder="Enter Your Email" class="input2" required><br>
                    <input type="password" name="password" placeholder="Enter Your Password" class="input2" required><br>
                    <label class='check_pass'><input type="checkbox" id="show_password_signup"> Show Password</label><br>

                    <button type="button" id="generate_signup_otp" class="gn_btn">Generate OTP</button>
                    <p id="signup_otp_msg"></p>

                    <input type="text" name="otp" placeholder="Enter OTP" class="otp_va" id="signup_otp_input" required><br>
                    <button type="button" id="verify_signup_otp" class="ve_btn">Verify OTP & Sign Up</button>
                    <p id="signup_verify_msg"></p>
                </form>

            </center>
            <h4>Already have account? please <a href="#login-section">login</a></h4>
        </div>
    </section>
    

    <script src="index.js"></script>
</body>
</html>
