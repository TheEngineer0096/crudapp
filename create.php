<?php
require_once "config.php";
 
$name = $address = $salary = $comment = $gender = $degree = $image = "";
$name_err = $address_err = $salary_err = $comment_err = $gender_err = $degree_err = $image_err = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please enter a name.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid name.";
    } else{
        $name = $input_name;
        print_r($name);
        die();
    }
    
    $input_address = trim($_POST["address"]);
    if(empty($input_address)){
        $address_err = "Please enter an address.";     
    } else{
        $address = $input_address;
    }
    $input_salary = trim($_POST["salary"]);
    if(empty($input_salary)){
        $salary_err = "Please enter the salary amount.";     
    } elseif(!ctype_digit($input_salary)){
        $salary_err = "Please enter a positive integer value.";
    } else{
        $salary = $input_salary;
    }

    $input_comment = trim($_POST["comment"]);
    if(empty($input_comment)){
        $comment_err = "Please enter the comment here.";     
    } else {
        $comment = $input_comment;
    }
    
    $input_gender = ($_POST["gender"]);
    if(empty($input_comment)){
        $gender_err = "Please select your gender.";     
    } else {
        $gender = $input_gender;
    }

    $input_degree = ($_POST["degree"]);
    if(empty($input_degree)){
        $degree_err = "Please select your degree.";     
    } else {
        $degree = $input_degree;
    }

    $input_image = ($_FILES["image"]);
    if(empty($input_image)){
        $image_err = "Please add your image.";     
    } else {
        $image = $input_image;
        print_r($image);
        die();
    }
    
    if(empty($name_err) && empty($address_err) && empty($salary_err) && empty($comment_err) && empty($gender_err) && empty($degree_err) && empty($image_err)){
        $sql = "INSERT INTO employees (name, address, salary , comment , gender, degree, image) VALUES (?, ?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "ssisssb", $param_name, $param_address, $param_salary, $param_comment, $param_gender, $param_degree, $param_image);
            $param_name = $name;
            $param_address = $address;
            $param_salary = $salary;
            $param_comment = $comment;
            $param_gender = $gender;
            $param_degree = $degree;
            $param_image = $image;
            if(mysqli_stmt_execute($stmt)){
                header("location: index.php");
                exit();
            } else {
              
              echo "error";
            }
       mysqli_stmt_close($stmt);
       
        }
         
        
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Create Record</h2>
                    </div>
                    <p>Please fill this form and submit to add employee record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                            <span class="help-block"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($address_err)) ? 'has-error' : ''; ?>">
                            <label>Address</label>
                            <textarea name="address" class="form-control"><?php echo $address; ?></textarea>
                            <span class="help-block"><?php echo $address_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($salary_err)) ? 'has-error' : ''; ?>">
                            <label>Salary</label>
                            <input type="text" name="salary" class="form-control" value="<?php echo $salary; ?>">
                            <span class="help-block"><?php echo $salary_err;?></span>
                            <div class="form-group <?php echo (!empty($comment_err)) ? 'has-error' : ''; ?>">
                            <label>Comment</label>
                            <textarea type="text" name="comment" class="form-control" value="<?php echo $comment; ?>"> </textarea>
                            <span class="help-block"><?php echo $comment_err;?></span>
                            
                        </div>
                            <div class="form-group <?php echo (!empty($gender_err)) ? 'has-error' : ''; ?>">
                            <label>Gender</label>
                            <input type="radio" name="gender" value="male">Male
                            <input type="radio" name="gender" value="female">Female<br>
                            <span class="help-block"><?php echo $gender_err;?></span>
                            </div>
                            <div class="form-group <?php echo (!empty($degree_err)) ? 'has-error' : ''; ?>">
                            <label>Degree</label>
                            <input type="checkbox" name="degree" value="ADP"> ADP
                            <input type="checkbox" name="degree" value="BS"> Bachelors
                            <input type="checkbox" name="degree" value="MS"> Masters
                            <span class="help-block"><?php echo $degree_err;?></span>
                            </div>
                            <div class="form-group <?php echo (!empty($image_err)) ? 'has-error' : ''; ?>">
                            <label>Image</label>
                            <input type="file" name="image" required>
                            <span class="help-block"><?php echo $image_err;?></span>
                            </div>
                            

                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>