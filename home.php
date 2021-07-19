<?php
    session_start();
    
    // Connect to AZUL Database base in phpmyadmin
    $conn = mysqli_connect("localhost","root","","azul_mini_project");

    //Check connection succesful or not
    if(!$conn)
    {
        echo "Database Connection Error: " . mysqli_connect_error();
    }
   
    if (isset($_POST['delete'])){

        $done = mysqli_query($conn,"DELETE FROM student_signup WHERE email = '$_SESSION[user_email]'");
        $detailsdone = mysqli_query($conn,"DELETE FROM student_details WHERE email_id = '$_SESSION[user_email]'");
        echo '<script> alert("Account has been successfully deleted. We are sorry to see you go!") </script>';
        unset($_SESSION["user_email"]);
        session_destroy();
        header('refresh: 2; url=index.php');
        exit;
    }
    mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
        <title>AZUL HOME</title>
        <link rel="stylesheet" href="./homestyle.css">
        <link rel="icon" type="image/png" href="./elements/asmallest.png"/>
        <script src="https://kit.fontawesome.com/64d58efce2.js"></script>
    </head>
    <body>
        <div class="side_menu">
            <ul>
                <li>
                    <span onmouseenter="hoverEnter(0)">
                    <i class="fa fa-home"></i>
                    </span>
                </li>
                <li>
                    <span onmouseenter="hoverEnter(1)">
                    <i class="fas fa-user"></i>
                    </span>
                </li>
                <li>
                    <span onmouseenter="hoverEnter(2)">
                    <i class="fa fa-laptop"></i>
                    </span>
                </li>
                <li>
                    <span onmouseenter="hoverEnter(3)">
                    <i class="fas fa-wallet"></i>
                    </span>
                </li>
                <li>
                    <span onmouseenter="hoverEnter(4)">
                        <i class="fa fa-edit"></i>
                    </span>
                </li>
                <span class="goo-index" id="goo-index"></span>
            </ul>
        </div>
        <div class="content-wrapper">
            <div id="screen_0" class="screen visible">
                <p id="wta">WELCOME TO AZUL!</p>
                <h3 id="intro"> Azul is your one stop location to experience a seamless online study environment.<br>
                Check out our functions below and navigate to the respective tabs to explore them.<br>Are you ready to dive into the world of Azul?<br></h3>
                <table class="home_table">
                    <tr>
                        <td><img src="./elements/personal_file.svg" alt="Profile Image" class="home_table_image"></td>
                        <td class="tdtext">Store all your information and important documents in once place and never lose them!</td>
                        <td><img src="./elements/videocall.svg" alt="Video Call Image" class="home_table_image"></td>
                        <td class="tdtext">Have a one-on-one video chat session with your friends and teachers and clear all your doubts on the go!</td>
                    </tr>
                    <tr>
                        <td><img src="./elements/pay.svg" alt="Payment Image" class="home_table_image"></td>
                        <td class="tdtext">Pay you fees and other dues securely at the click of the button using integrated Razor Pay!</td>
                        <td><img src="./elements/todo.svg" alt="To Do Image" class="home_table_image"></td>
                        <td class="tdtext">Write down your daily to-do list and make sure you never miss any important deadlines!</td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" name="signout" value="SIGNOUT" id="cn" onClick="myFunction()"/></td>
                        <td colspan="2"><form action="home.php" method="POST"><input type="submit" name="delete" value="DELETE ACCOUNT" id="cn"/></form></td>
                        
                        <script>
                            function myFunction() {
                            window.location.href="./index.php"; 
                            unset($_SESSION["user_email"]);
                            unset($_SESSION['confres']);
                            session_destroy();
                            exit;
                            }
                        </script>
                    </tr>
                </table>
            </div>
            <div id="screen_1" class="screen">
                <p id="wta">STUDENT DETAILS APPLICATION</p>
                <div class="pbox">
                    <img src="./elements/personal_file.svg" class="payimage" />
                    <form action="./details.php" method="POST">
                        <h3 id="intro">Save all your documents and details in one place and never lose them!<br> Follow the steps below to store your data and documents and retrieve them.</h3>
                        <ul>
                            <li>Click on the below button to redirect to the student details page.</li>
                            <li>Based on whether you want to update the data or retrieve the data, select one among the 'UPDATE DATA' or 'VIEW DATA' buttons.</li>
                            <li>If 'UPDATE DATA' is clicked then input fields are enabled on the form and you can update your information.</li>
                            <li>If 'VIEW DATA' is clicked then input fields are filled with data previously stored by you and appropriate information can be retrieved.</li>
                            <li>Once done, just click on the back button on the browser to return to the home screen.</li>
                        </ul>
                        <h3 id="intro">Ready to have a go?</h3>
                        <input type="submit" name="submit" value="OPEN NOW!" id="cn">
                    </form>
                </div>
            </div>
            <div id="screen_2" class="screen">
                <p id="wta">VIDEO CHAT APPLICATION</p>
                <div class="pbox">
                    <img src="./elements/videocall.svg" class="payimage" />
                    <form action="https://azulmp2021.web.app" method="POST">
                        <h3 id="intro">Connect with your friends and teachers from anywhere around the world.<br> Follow the steps below to start and join a live video chat room!</h3>
                        <ul>
                            <li>Click on the below button to redirect to the video chat page.</li>
                            <li>Click on the button 'Open Camera and Microphone' and allow access to the browser when prompted.</li>
                            <li>Create a new room and copy the meeting ID provided by the browser.</li>
                            <li>Ask your friends/teachers to join the room using the meeting ID provided by you.</li>
                            <li>Hang up once the meeting is done.</li>
                        </ul>
                        <h3 id="intro">Excited to try it out?</h3>
                        <input type="submit" name="submit" value="CONNECT NOW!" id="cn">
                    </form>
                </div>
            </div>
            <div id="screen_3" class="screen">
                <p id="wta">PAYMENT PORTAL APPLICATION</p>
                <div class="pbox">
                    <img src="./elements/pay.svg" class="payimage" />
                    <form>
                        <h3 id="intro">Pay your fees and other dues securely using Razor Pay.<br> Follow the steps below and complete your payment with a method of your choice!</h3>
                        <ul>
                            <li>Click on the below button to redirect to the razorpay payment app.</li>
                            <li>Enter the payment amount you wish to make in Indian Rupees.</li>
                            <li>Enter your details as and when prompted.</li>
                            <li>Select your preferred mode of money transfer and securely make the payement.</li>
                            <li>A confirmation email with the payment receipt will be sent to the entered email upon successful payment.</li>
                        </ul>
                        <h3 id="intro">Ready to have a go?</h3><br/>
                        <form><span id="ptp"><script src="https://checkout.razorpay.com/v1/payment-button.js" data-payment_button_id="pl_HQ8fCVpQblHZ4V" async></script></span></form>
                    </form>
                </div>
            </div>
            <div id="screen_4" class="screen">
                <p id="wta">TODO LIST APPLICATION</p>
                <h3 id="intro">Never miss out on any imporant tasks and deadlines. Save them all here and be on the top of your game!</h3>
                <div class="pbox">
                    <img src="./elements/todo.svg" class="payimage" />
                    <div class="wrapper">
                        <header>To-Do List</header>
                        <div class="inputField">
                            <input type="text" placeholder="Add your new task">
                            <button><i class="fas fa-plus"></i></button>
                        </div>
                        <ul class="todoList">
                        <!-- data comes from local storage -->
                        </ul>
                        <div class="footer">
                            <span>You have <span class="pendingTasks"></span> pending tasks</span>
                            <button>Clear All</button>
                        </div>
                    </div>
                  <script src="todoscript.js"></script>
                </div>
            </div>
        </div>
        
        <script  src="./homescript.js"></script>

    </body>
</html>