<?php 
    session_start();
    require_once 'header.php';
    require_once 'helpers2.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = CleanInputs($_POST['name']);
        $email = CleanInputs($_POST['email']);
        $password = CleanInputs($_POST['password']);
        $address = CleanInputs($_POST['address']);
        $gender = $_POST['gender'] ?? NULL;
        $url = CleanInputs($_POST['url']);

        $temFile = $_FILES['img']['tmp_name'];
        $img = $_FILES['img']['name'];
        $typeFile = $_FILES['img']['type'];
        $errors = [];
        //validate name ...
        if (!validate($name, 'emptyVal')) {
            $errors['name'] = 'name is required !';
        }
        elseif (!validate($name, 'nameVal')) {
            $errors['name'] = 'name: You have to enter only alphabets and spaces';
        }
        //validate email ...
        if (!validate($email, 'emptyVal')) {
            $errors['email'] = 'email is required !';
        }
        elseif (!validate($email, 'emailVal')) {
            $errors['email'] = 'Invalid email';
        }
        //validate password ...
        if (!validate($password, 'emptyVal')) {
            $errors['password'] = 'password is required !';
        }
        elseif (!validate($password, 'passVal')) {
            $errors['password'] = 'password is at least 6 charaters !';
        }
        //validate address ...
        if (!validate($address, 'emptyVal')) {
            $errors['address'] = 'address is required !';
        }
        elseif (!validate($address, 'addressVal')) {
            $errors['address'] = 'address is at least 10 charaters !';
        }
        //validate gender ...
        if (!validate($gender, 'genderVal')) {
            $errors['gender'] = 'gender is required !';
        }
        //validate address ...
        if (!validate($url, 'emptyVal')) {
            $errors['url'] = 'url is required !';
        }
        elseif (!validate($url, 'urlVal')) {
            $errors['url'] = 'invalid url';
        }
        elseif (substr($url, 0, 23) !== 'http://www.linkedin.com') {
            $errors['url'] = 'Enter linkedin url !';
        }
        //validate file ...
        if (!validate($img, 'emptyVal')) {
            $errors['file'] = 'file is required';
        }
        elseif (!validate($typeFile, 'fileVal')) {
            $errors['file'] = 'only images are allowed !';
        }

        if (count($errors) == 0) {
            $extArray = explode('/', $typeFile);

            $finalName = rand().time().'.'.$extArray[1];
            $desPath = './images/'.$finalName;
            
            if (move_uploaded_file($temFile, $desPath)) {
                $_SESSION['user'] = [
                                    'name' => $name,
                                    'email'=> $email,
                                    'password'=> $password,
                                    'address'=> $address,
                                    'gender'=> $gender,
                                    'url'=> $url,
                                    'file'=> $finalName
                ];
                header("Location: index.php");
            }
            else {
                $errors['file'] = 'Uploading error, try again !';
            }
        }

    }
?>


    <div class="container">
        <h1 class="text-center text-primary">Register</h1>
        <span class="text-danger">* required</span>
        <form method="POST" action=<?php echo $_SERVER['PHP_SELF']?> enctype ="multipart/form-data">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label"><span class="text-danger">*</span> Name</label>
                <input type="text" class="form-control" name="name" id="exampleInputEmail1" aria-describedby="emailHelp">
                <?php
                    if (isset($errors['name'])) {
                        echo '<span>'.$errors['name'].'</span>';
                    }
                ?>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label"><span class="text-danger">*</span> Email address</label>
                <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp">
                <?php
                    if (isset($errors['email'])) {
                        echo '<span>'.$errors['email'].'</span>';
                    }
                ?>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label"><span class="text-danger">*</span> Password</label>
                <input type="password" class="form-control" name="password" id="exampleInputPassword1">
                <?php
                    if (isset($errors['password'])) {
                        echo '<span>'.$errors['password'].'</span>';
                    }
                ?>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label"><span class="text-danger">*</span> Address</label>
                <input type="text" class="form-control" name="address" id="exampleInputEmail1" aria-describedby="emailHelp">
                <?php
                    if (isset($errors['address'])) {
                        echo '<span>'.$errors['address'].'</span>';
                    }
                ?>
            </div>
            <div>
            <span class="text-danger">*</span> Gender
                <div class="container">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" value="male" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1">Male</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" value="female" id="flexRadioDefault2">
                        <label class="form-check-label" for="flexRadioDefault2">Female</label>
                    </div>
                </div>
                <?php
                    if (isset($errors['gender'])) {
                        echo '<span>'.$errors['gender'].'</span>';
                    }
                ?>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label"><span class="text-danger">*</span> linkedin url</label>
                <input type="text" class="form-control" name="url" id="exampleInputEmail1" aria-describedby="emailHelp">
                <?php
                    if (isset($errors['url'])) {
                        echo '<span>'.$errors['url'].'</span>';
                    }
                ?>
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">
                    <span class="text-danger">*</span>Upload File
                </label>
                <input class="form-control" type="file" name="img" id="formFile">
                <?php
                    if (isset($errors['file'])) {
                        echo '<span>'.$errors['file'].'</span>';
                    }
                ?>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
<?php require_once 'footer.php';?>