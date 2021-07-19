<?php
    session_start();
    //echo $_SESSION["user_email"];

    // Connect to AZUL Database base in phpmyadmin
    $conn = mysqli_connect("localhost","root","","azul_mini_project");

    //Check connection succesful or not
    if(!$conn)
    {
        echo "Database Connection Error: " . mysqli_connect_error();
    }

    if(isset($_POST['details_submit'])) //collect data from database (SUBMIT BUTTON after UPDATE BUTTON)
    {   
        $profilepic= mysqli_real_escape_string($conn, $_POST['img']);
        $fullname = mysqli_real_escape_string($conn, $_POST['full_name']);
        $collegeusn = mysqli_real_escape_string($conn, $_POST['usn']);
        $email = $_SESSION['user_email'];
        $phonenumber = mysqli_real_escape_string($conn, $_POST['phno']);
        $gender = mysqli_real_escape_string($conn, $_POST['gender']);
        $peraddr = mysqli_real_escape_string($conn, $_POST['paddr']);
        $dob = mysqli_real_escape_string($conn, $_POST['dob']);
        $semsec = mysqli_real_escape_string($conn, $_POST['sem_sec']);
        $degbra = mysqli_real_escape_string($conn, $_POST['degree_branch']);
        $aadharno = mysqli_real_escape_string($conn, $_POST['aadhar_no']);
        $aadhardoc = mysqli_real_escape_string($conn, $_POST['aadhar_doc']);
        $panno = mysqli_real_escape_string($conn, $_POST['pan_no']);
        $pandoc = mysqli_real_escape_string($conn, $_POST['pan_doc']);
        $marks10 = mysqli_real_escape_string($conn, $_POST['10marks']);
        $value10 = mysqli_real_escape_string($conn, $_POST['10valuation']);
        $school10 = mysqli_real_escape_string($conn, $_POST['10school']);
        $board10 = mysqli_real_escape_string($conn, $_POST['10board']);
        $doc10 = mysqli_real_escape_string($conn, $_POST['10doc']);
        $marks12 = mysqli_real_escape_string($conn, $_POST['12marks']);
        $value12 = mysqli_real_escape_string($conn, $_POST['12valuation']);
        $college12 = mysqli_real_escape_string($conn, $_POST['12college']);
        $board12 = mysqli_real_escape_string($conn, $_POST['12board']);
        $doc12 = mysqli_real_escape_string($conn, $_POST['12doc']);


        // Checking if user already exists in the database
        $check="SELECT * FROM student_details WHERE email_id = '$_SESSION[user_email]' ";
        $res = mysqli_query($conn,$check);
        $data = mysqli_fetch_array($res, MYSQLI_NUM);

        if($data != null) 
        {   //echo '<script>alert("same user found") </script>';
            //delete from database and insert
            $del = mysqli_query($conn,"DELETE FROM student_details WHERE email_id = '$_SESSION[user_email]'");

            $updatequery = "INSERT INTO student_details(profile_picture_dir,full_name,college_usn,email_id,phone_number,permanent_address,gender,date_of_birth,degree_branch,semester_section,aadhar_number,aadhar_document,pan_number,pan_document,
                10_marks,10_valuation,10_school,10_board,10_document,12_marks,12_valuation,12_college,12_board,12_document) VALUES('$profilepic','$fullname','$collegeusn','$email','$phonenumber','$peraddr',
                '$gender','$dob','$degbra','$semsec','$aadharno','$aadhardoc','$panno','$pandoc','$marks10','$value10','$school10','$board10','$doc10','$marks12','$value12','$college12','$board12','$doc12')";
                
            $update = mysqli_query($conn,$updatequery);
                echo '<script> alert("Details have been successfully updated!") </script>';

        }
        else //user details not present in database
        {
            $addquery = "INSERT INTO student_details(profile_picture_dir,full_name,college_usn,email_id,phone_number,permanent_address,gender,date_of_birth,degree_branch,semester_section,aadhar_number,aadhar_document,pan_number,pan_document,
                10_marks,10_valuation,10_school,10_board,10_document,12_marks,12_valuation,12_college,12_board,12_document) VALUES('$profilepic','$fullname','$collegeusn','$email','$phonenumber','$peraddr',
                '$gender','$dob','$degbra','$semsec','$aadharno','$aadhardoc','$panno','$pandoc','$marks10','$value10','$school10','$board10','$doc10','$marks12','$value12','$college12','$board12','$doc12')";
                
            $add = mysqli_query($conn,$addquery);

            if (mysqli_query($conn,$add))
            {   
                echo '<script> alert("Details have been successfully updated!") </script>';
            }
            else
            { 
                echo '<script> alert("Error adding user details in the database!") </script>';
                // echo "Error adding user in database: " . mysqli_error($conn);
            }
        }
    }
    elseif(isset($_POST['view_button'])) //display data from database (VIEW UPDATE BUTTON)
    {
        $e = $_SESSION["user_email"];
        $getquery = "SELECT * FROM student_details WHERE email_id = '$e'";
        $data= mysqli_query($conn,$getquery);
        $num = mysqli_num_rows($data);
            
        if($num >0 )
        {
            //echo 'Data present';
            while($formdata = mysqli_fetch_assoc($data)) 
            {
                $prof=$formdata["profile_picture_dir"];
                $fname=$formdata["full_name"];
                $usn=$formdata["college_usn"];
                $femail=$_SESSION['user_email'];
                $phone=$formdata["phone_number"];
                $per=$formdata["permanent_address"];
                $gen=$formdata["gender"];
                $fdob=$formdata["date_of_birth"];
                $deg=$formdata["degree_branch"];
                $sem=$formdata["semester_section"];
                $aad=$formdata["aadhar_number"];
                $aadoc=$formdata["aadhar_document"];
                $pan=$formdata["pan_number"];
                $pandoc=$formdata["pan_document"];
                $m_10=$formdata["10_marks"];
                $v_10=$formdata["10_valuation"];
                $s_10=$formdata["10_school"];
                $b_10=$formdata["10_board"]; 
                $d_10=$formdata["10_document"];
                $m_12=$formdata["12_marks"];
                $v_12=$formdata["12_valuation"];
                $s_12=$formdata["12_college"];
                $b_12=$formdata["12_board"]; 
                $d_12=$formdata["12_document"];  

            }
        }
        else
        {
            echo '<script> alert("No data is available in the database. Are you sure you saved it?") </script>';
        }
    }
    mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>AZUL Details</title>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
        <link rel="stylesheet" href="./dets.css">
        <link rel="icon" type="image/png" href="./elements/asmallest.png"/>
    </head>
    <body>
        <script type="text/javascript">
                function update()
                {
                    var input1 = document.getElementsByTagName("input");
                    
                    for(let i = 0;i < input1.length; i++)
                    {
                        
                        input1[i].disabled=false;
                    }
                    var input2 = document.getElementsByTagName("textarea");
                    for(let j = 0;j < input2.length; j++)
                    {
                        input2[j].disabled=false;
                    }

                    var input3 = document.getElementsByName("emailid")[0].disabled=true;
                }
        </script>
        <div class="student-profile py-4">
            <h2 id="he">Save all your documents and details in one place and never lose them!</h2>
            <form action="details.php" method="POST">
                
                <button style="width: 150px;background-color: #77acf1;border: none;outline: none;height: 49px;border-radius: 20px;color: #fff;text-transform: uppercase;
                font-weight: 400;cursor: pointer;transition: 0.5s;margin: 10pt;" name="update_button" onClick="update(); return false;">UPDATE DATA</button>
                
                <button style="width: 150px;background-color: #77acf1;border: none;outline: none;height: 49px;border-radius: 20px;color: #fff;text-transform: uppercase;
                font-weight: 400;cursor: pointer;transition: 0.5s;margin: 10pt;" name="view_button">VIEW DATA</button>
            </form>
            <form class="detailsform" method="POST" action="./details.php">
                <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                    <div class="card shadow-sm" id="tab">
                        <div class="card-header bg-transparent text-center">
                            <img src="<?php echo(isset($prof))?'./elements/'. $prof:'./elements/dp.jpg';?>" alt="Student Profile Picture" class="profile_img" />
                            <h3><input type="text" name="full_name" placeholder="ENTER FULL NAME" class="inp" value="<?php echo (isset($fname))?$fname:''; ?>" required disabled></h3>
                            <input type="file" name="img" accept="image/*" required disabled>
                        </div>
                        <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                            <th width="30%">COLLEGE USN</th>
                            <td width="2%">:</td>
                            <td><input type="text" name="usn" maxlength = "10" class="inp" value="<?php echo (isset($usn))?$usn:''; ?>" required disabled></td>
                            </tr>
                            <tr>
                            <th width="30%">DEGREE-BRANCH</th>
                            <td width="2%">:</td>
                            <td><input type="text" name="degree_branch" maxlength = "50" class="inp" value="<?php echo (isset($deg))?$deg:''; ?>" required disabled></td>
                            </tr>
                            <tr>
                            <th width="30%">SEMESTER-SECTION</th>
                            <td width="2%">:</td>
                            <td><input type="text" name="sem_sec" maxlength = "10" class="inp" value="<?php echo (isset($sem))?$sem:''; ?>" required disabled></td>
                            </tr>
                            <tr>
                            <th width="30%">EMAIL ID</th>
                            <td width="2%">:</td>
                            <td><input type="email" name="emailid" class="inp" value="<?php echo (isset($femail))?$femail:''; ?>" required disabled></td>
                            </tr>
                            <tr>
                            <th width="30%">PHONE NUMBER</th>
                            <td width="2%">:</td>
                            <td><input type="tel" name="phno" pattern="[1-9]{1}[0-9]{9}" class="inp" value="<?php echo(isset($phone))?$phone:''; ?>" required disabled></td>
                            </tr>
                            <tr>
                            <th width="30%">DATE OF BIRTH</th>
                            <td width="2%">:</td>
                            <td><input type="date" name="dob" min="1990-01-01" max="2026-12-31" value="<?php echo(isset($fdob))?$fdob:''; ?>" required disabled></td>
                            </tr>
                            <tr>
                            <th width="30%">GENDER</th>
                            <td width="2%">:</td>
                            <td><input type="radio" id="male" name="gender" value="male" disabled>
                                <label for="male">MALE</label>
                                <input type="radio" id="female" name="gender" value="female" disabled>
                                <label for="female">FEMALE</label><br>
                                <input type="radio" id="other" name="gender" value="other" disabled>
                                <label for="other">OTHER</label>
                                <p style="text-transform: capitalize; color: #04009a; background-color: #ff9292;"><?php echo(isset($gen))?$gen:''; ?></p>
                            </td>
                            </tr>
                            <tr>
                            <th width="30%">PERMANENT ADDRESS</th>
                            <td width="2%">:</td>
                            <td><textarea name="paddr" rows="5" cols="22" class="inp" disabled required><?php echo(isset($per))?$per:''; ?></textarea></td>
                            </tr>
                        </table>
                        </div>
                    </div>
                    </div>
                    <div class="col-lg-8">
                    <div class="card shadow-sm" id="tab">
                        <div class="card-header bg-transparent border-0">
                            <h3 class="mb-0"><i class="far fa-clone pr-1"></i>ACADEMIC/GENERAL INFORMATION</h3>
                        </div>
                        <div class="card-body pt-0">
                        <table class="table table-bordered">
                            <tr>
                                <th width="30%">AADHAR CARD NUMBER</th>
                                <td width="2%">:</td>
                                <td><input type="number" maxlength="12" class="inp" name="aadhar_no" value="<?php echo(isset($aad))?$aad:''; ?>" required disabled></td>
                            </tr>
                            <tr>
                                <th width="30%">AADHAR CARD DOCUMENT</th>
                                <td width="2%">:</td>
                                <td><input type="file" id="aadhar" name="aadhar_doc" required disabled></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td width="2%">:</td>
                                <td><img src="<?php echo(isset($aadoc))?'./elements/'. $aadoc:''; ?>" style="width: 300px; height: 300px;"></td>
                            </tr>
                            <tr>
                                <th width="30%">PAN CARD NUMBER</th>
                                <td width="2%">:</td>
                                <td><input type="text" maxlength="10" class="inp" name="pan_no" value="<?php echo(isset($pan))?$pan:''; ?>" required disabled></td>
                            </tr>
                            <tr>
                                <th width="30%">PAN CARD DOCUMENT</th>
                                <td width="2%">:</td>
                                <td><input type="file" id="pan" name="pan_doc" required disabled></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td width="2%">:</td>
                                <td><img src="<?php echo(isset($pandoc))?'./elements/'. $pandoc:''; ?>" style="width: 300px; height: 300px;"></td>
                            </tr>
                            <tr>
                                <th rowspan="6">10TH DETAILS</th>
                            <tr>
                                <td>10TH MARKS</td>
                                <td><input type="number" step="any" class="inp" name="10marks" value="<?php echo(isset($m_10))?$m_10:''; ?>" required disabled></td>
                            </tr>
                            <tr>
                                <td>10TH VALUATION</td>
                                <td><input type="radio" id="cgpa" name="10valuation" value="cgpa" disabled>
                                    <label for="cgpa">CGPA</label><br>
                                    <input type="radio" id="percentage" name="10valuation" value="percentage" disabled>
                                    <label for="percentage">PERCENTAGE</label>
                                    <p style="text-transform: capitalize; color: #04009a; background-color: #ff9292;"><?php echo(isset($v_10))?$v_10:''; ?></p>
                                </td>
                            </tr>
                            <tr>
                                <td>10TH SCHOOL NAME</td>
                                <td><input type="text" name="10school" class="inp" value="<?php echo(isset($s_10))?$s_10:''; ?>" required disabled></td>
                            </tr>
                            <tr>
                                <td>10TH BOARD</td>
                                <td><input type="text" name="10board" class="inp" value="<?php echo(isset($b_10))?$b_10:''; ?>" required disabled></td>
                            </tr>
                            <tr>
                                <td>10TH MARKSCARD DOCUMENT</td>
                                <td><input type="file" id="10markscard" class="inp" name="10doc" required disabled></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td width="2%">:</td>
                                <td><img src="<?php echo(isset($d_10))?'./elements/'. $d_10:''; ?>" style="width: 300px; height: 300px;"></td>
                            </tr>
                            </tr>
                            <tr>
                                <th rowspan="6">12TH/2ND PU DETAILS</th>
                            <tr>
                                <td>12TH/2ND PU MARKS</td>
                                <td><input type="number" step="any" class="inp" name="12marks" value="<?php echo(isset($m_12))?$m_12:''; ?>" required disabled></td>
                            </tr>
                            <tr>
                                <td>12TH/2ND PU VALUATION</td>
                                <td><input type="radio" id="cgpa" name="12valuation" value="cgpa" disabled>
                                    <label for="cgpa">CGPA</label><br>
                                    <input type="radio" id="percentage" name="12valuation" value="percentage" disabled>
                                    <label for="percentage">PERCENTAGE</label>
                                    <p style="text-transform: capitalize; color: #04009a; background-color: #ff9292;"><?php echo(isset($v_12))?$v_12:''; ?></p>
                                </td>
                            </tr>
                            <tr>
                                <td>12TH/2ND SCHOOL/COLLEGE NAME</td>
                                <td><input type="text" name="12college" class="inp" value="<?php echo(isset($s_12))?$s_12:''; ?>" required disabled></td>
                            </tr>
                            <tr>
                                <td>12TH/2ND PU BOARD</td>
                                <td><input type="text" name="12board" class="inp" value="<?php echo(isset($b_12))?$b_12:''; ?>" required disabled></td>
                            </tr>
                            <tr>
                                <td>12TH/2ND PU MARKSCARD DOCUMENT</td>
                                <td><input type="file" id="12markscard" class="inp" name="12doc" required disabled></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td width="2%">:</td>
                                <td><img src="<?php echo(isset($d_12))?'./elements/'. $d_12:''; ?>" style="width: 300px; height: 300px;"></td>
                            </tr>
                            </tr>
                            <tr>
                                <td colspan="3"><center><input type="submit" value="SUBMIT" id="btn" name="details_submit"></center></td>
                            </tr>
                        </table>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </form>
        </div>
    </body>
</html>