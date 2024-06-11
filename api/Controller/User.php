<?php
namespace Controller\User;

use Hashids\Hashids;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


/**
 * 
 */
class User
{
	
	private $hash;
	private $db;
	private $auth;
    private $mail;
    private $spreadsheet;
    private $writer;
    private $mkdb;
    // private $generator;

	function __construct()
	{
        $this->mail = new PHPMailer(true);
		$this->hash = new Hashids('', 10);
		$this->db = new \MeekroDB();
        $this->spreadsheet = new Spreadsheet();
        $this->writer = new Xlsx($this->spreadsheet);
        $this->mkdb = new \PDO('mysql:dbname=inv_db;host=localhost;charset=utf8mb4', 'root', '');
        $this->auth = new \Delight\Auth\Auth($this->mkdb);
        // $this->generator = new Picqer\Barcode\BarcodeGeneratorJPG();
	}

    public function insert_image()
    {

        $files = $_FILES['image233'];
        $file_path = $files['tmp_name'];
        $file_name = $files['name'];
        $file_size = $files['size'];
        $file_type = $files['type'];
        $directory = "./../products";
        $path = $directory."/".$file_name;

        $newdir = "products/".$file_name;

        if (!is_dir($directory)) {
        //Create our fam_monitor_directory(fam, dirname).
        mkdir($directory, 755, true);
        move_uploaded_file($file_path, $path);

        } else {

        move_uploaded_file($file_path, $path);

        }

        echo json_encode(["dir" => $newdir]);

    }

    public function lists_locations()
    {

        $locations = $this->db->query("SELECT * FROM tbl_locations");

        echo json_encode(["locations" => $locations]);

    }

    public function delete_product_location()
    {

        extract($_POST);

        $this->db->query("DELETE FROM tbl_transfered WHERE id=%i", $id);

        echo json_encode(["response" => 1]);

    }

    public function update_product_location()
    {

        extract($_POST);

        $this->db->query("UPDATE tbl_transfered SET quantity=%i, status=%s WHERE id=%i", 
                       $quantity, $status, $id);

        echo json_encode(["response" => 1]);

    }

    public function insert_to_location()
    {

        $this->db->insert('tbl_transfered', $_POST); 

        echo json_encode(["response" => 1]);

    }

    public function update_password()
    {
            $this->auth->admin()->changePasswordForUserById($_POST['userid'], $_POST['newpassword']);

            echo json_encode(["response" => 1]);
    }

    public function update_user()
    {

      extract($_POST);

      $this->db->query("UPDATE users SET email=%s, username=%s WHERE id=%i", 
                       $email, $username, $userid);

      $_SESSION['system'][0]['username'] = $username;
      $_SESSION['system'][0]['email'] = $email;

      echo json_encode(["response" => 1]);
    }

    public function analytics()
    {

        $css1 = $this->db->query("SELECT count(*) as count FROM tbl_transfered WHERE location='CSS 1'");
        $css2 = $this->db->query("SELECT count(*) as count FROM tbl_transfered WHERE location='CSS 2'");
        $tvet = $this->db->query("SELECT count(*) as count FROM tbl_transfered WHERE location='TVET Office'");
        $animation = $this->db->query("SELECT count(*) as count FROM tbl_transfered WHERE location='2D Animation Lab'");
        $vgd = $this->db->query("SELECT count(*) as count FROM tbl_transfered WHERE location='VGD'");

        $all = $this->db->query("SELECT count(*) as count FROM tbl_purchased ");

        $css1_status = $this->db->query("SELECT count(*) as count FROM tbl_transfered 
                                         WHERE location='CSS 1' AND status='Functional'");
        $css2_status = $this->db->query("SELECT count(*) as count FROM tbl_transfered 
                                         WHERE location='CSS 2' AND status='Functional'");
        $tvet_status = $this->db->query("SELECT count(*) as count FROM tbl_transfered 
                                         WHERE location='TVET Office' AND status='Functional'");
        $animation_status = $this->db->query("SELECT count(*) as count FROM tbl_transfered 
                                        WHERE location='2D Animation Lab'  AND status='Functional'");
        $vgd_status = $this->db->query("SELECT count(*) as count FROM tbl_transfered 
                                        WHERE location='VGD' AND status='Functional'");

        if ($css1_status[0]['count'] != 0) {
            $css1_percent = $css1_status[0]['count']/$css1[0]['count']*100; 
        }else{
            $css1_percent = 0; 
        }

        if ($css2_status[0]['count'] != 0) {
            $css2_percent = $css2_status[0]['count']/$css2[0]['count']*100;
        }else{
            $css2_percent = 0; 
        }

        if ($tvet_status[0]['count'] != 0) {
            $tvet_percent = $tvet_status[0]['count']/$tvet[0]['count']*100;
        }else{
            $tvet_percent = 0; 
        }

        if ($animation_status[0]['count'] != 0) {
            $animation_percent = $animation_status[0]['count']/$animation[0]['count']*100;
        }else{
            $animation_percent = 0; 
        }
        
        if ($vgd_status[0]['count'] != 0) {
            $vgd_percent = $vgd_status[0]['count']/$vgd[0]['count']*100;
        }else{
            $vgd_percent = 0; 
        }

        

        echo json_encode(["css1" => $css1[0]['count'],
                          "css2" => $css2[0]['count'],
                          "tvet" => $tvet[0]['count'],
                          "animation" => $animation[0]['count'],
                          "vgd" => $vgd[0]['count'],
                          "css1percent" => $css1_percent,
                          "css2percent" => $css2_percent,
                          "tvetpercent" => $tvet_percent,
                          "animationpercent" => $animation_percent,
                          "vgdpercent" => $vgd_percent,
                          "all" => $all[0]['count']

                      ]);

    }

    public function lists_of_logs()
    {

        $logs = $this->db->query("SELECT a.qty, b.* FROM inventorylogs_db as a inner join product_db as b on(a.barcode_id = b.barcode_id)");

        echo json_encode(["logs" => $logs]);

    }

    public function return_product()
    {

        extract($_POST);

        $this->db->query("UPDATE transaction_db SET date_returned=%t WHERE id=%i", date("Y-m-d H:i:s"), $id);

        echo json_encode(["response" => 1]);
    }

    public function lists_of_transactions()
    {

        $scanned = $this->db->query("SELECT a.*, b.fname, b.lname, b.mname, c.product_name, c.product_brand, 
                                           b.course, b.year FROM transaction_db as a 
                                           inner join student_db as b on(a.student_id = b.id)  
                                           inner join product_db as c on(a.barcode_id = c.barcode_id)
                                           ");

        echo json_encode(["trans" => $scanned]);

    }

    public function add_product_qty()
    {

        extract($_POST);

        $products = $this->db->query("SELECT * FROM product_db WHERE barcode_id='$id'");

        $newqty = $products[0]['product_qty']+$qty;

        $this->db->query("UPDATE product_db SET product_qty=%i WHERE barcode_id=%s", $newqty, $id);

        $this->db->insert('inventorylogs_db', [
            "barcode_id" => $id,
            "qty" => $qty
        ]); 

        echo json_encode(["response" => 1]);

    }

    public function add_trans()
    {

        extract($_POST);

        $products = $this->db->query("SELECT * FROM product_db WHERE barcode_id='$barcode_id'");

        if ($products[0]['product_qty'] >= $qty_borrowed) {

            $this->db->insert('transaction_db', $_POST);

            $newqty = $products[0]['product_qty']-$qty_borrowed;

            $this->db->query("UPDATE product_db SET product_qty=%i WHERE barcode_id=%s", $newqty, $barcode_id);

            echo json_encode(["response" => 1]);

        }else{

            echo json_encode(["response" => 0, "qty" => $products[0]['product_qty'] ]);

        }

    }

    public function get_product()
    {   
        extract($_POST);

        $products = $this->db->query("SELECT * FROM product_db WHERE barcode_id='$id'");

        echo json_encode(["products" => $products]);

    }

    public function lists_trans()
    {

        $students = $this->db->query("SELECT * FROM student_db");

        $today = date("Y-m-d");

        $scanned_today = $this->db->query("SELECT a.*, b.fname, b.lname, b.mname, c.product_name, c.product_brand 
                                           FROM transaction_db as a 
                                           inner join student_db as b on(a.student_id = b.id)  
                                           inner join product_db as c on(a.barcode_id = c.barcode_id)
                                           WHERE a.date_created='$today'");

        $data = [];

        foreach ($scanned_today as $row) {
            $data[] = ["student" => $row['fname']." ".$row['mname']." ".$row['lname'],
                        "product_name" => $row['product_name'],
                        "product_brand" => $row['product_brand'],
                        "barcode" => $row['barcode_id'],
                        "qty" => $row['qty_borrowed'],
                        "borrowed" => date("F j, Y, g:i a", strtotime($row['date_borrowed'])) ];
        }

        echo json_encode(["students" => $students, "trans" => $data]);

    }

    public function delete_product()
    {

        extract($_POST);

        $this->db->query("DELETE FROM tbl_purchased WHERE id=%id", $id);

        echo json_encode(["response" => 1]);

    }

    public function update_product()
    {

        extract($_POST);

        $this->db->query("UPDATE tbl_purchased SET product=%s, description=%s, serial_no=%s, amount=%i, quantity=%i, category=%s WHERE id=%i", $product, $description, $serial_no, $amount, $quantity, $category, $id);


        echo json_encode(["response" => 1]);

    }

    public function lists_transfered_products()
    {

        extract($_GET);

        $products = $this->db->query("SELECT * FROM tbl_purchased");

        $transfered = $this->db->query("SELECT a.*, b.product, b.description, b.serial_no, b.description,
                                        b.amount, b.img 
                                        FROM tbl_transfered as a 
                                        INNER JOIN tbl_purchased as b on(a.product_id = b.id)
                                        WHERE a.location='$location'");

        echo json_encode(["products" => $products, "transfered" => $transfered]);        

    }

    public function lists_products()
    {

        $products = $this->db->query("SELECT * FROM tbl_purchased");

        echo json_encode(["products" => $products]);

    }

    public function insert_product()
    {

        $this->db->insert('tbl_purchased', $_POST);

        echo json_encode(["response" => 1]);

    }

    public function delete_student()
    {

        extract($_POST);

        $this->db->query("DELETE FROM student_db WHERE id=%id", $id);

        echo json_encode(["response" => 1]);

    }

    public function update_student()
    {

        extract($_POST);

        $this->db->query("UPDATE student_db SET student_id=%s, fname=%s, mname=%s, lname=%s, address=%s, course=%s, year=%s, gender=%s,
                          age=%i, email=%s, contact_no=%s WHERE id=%i", $student_id, $fname, $mname, $lname, $address, $course, $year, $gender, $age, $email, $contact_no, $id);


        echo json_encode(["response" => 1]);

    }

    public function get_student()
    {

        extract($_POST);

        $student = $this->db->query("SELECT * FROM student_db WHERE id='$id'");

        echo json_encode(["student" => $student]);

    }

    public function lists_student()
    {

        $students = $this->db->query("SELECT * FROM student_db");

        echo json_encode(["students" => $students]);

    }

    public function insert_student()
    {

        $this->db->insert('student_db', $_POST);

        echo json_encode(["response" => 1]);

    }


    public function upload_compliance_image()
    {

        extract($_POST);

        $files = $_FILES['images'];
        $file_path = $files['tmp_name'];
        $file_name = $files['name'];
        $file_size = $files['size'];
        $file_type = $files['type'];
        $directory = "./../compliance_images";
        $path = $directory."/".$file_name;

        $newdir = "./compliance_images/".$file_name;

        if (!is_dir($directory)) {
        //Create our fam_monitor_directory(fam, dirname).
        mkdir($directory, 755, true);
        move_uploaded_file($file_path, $path);
        } else {

        move_uploaded_file($file_path, $path);

        }

        $this->db->insert('compliance', [ 
            "student_id" => $this->get_user_id(),
            "violation_id" => $violation_id,
            "compliance" => $newdir 
        ]);


        echo json_encode(["response" => 1]);


    }

    public function login_user()
    {   

        extract($_POST);

        try {

            $this->auth->login($email, $password);

            $id = $this->get_user_id();

            $info = $this->db->query("SELECT * FROM users WHERE id='$id'");    

            $_SESSION["system"] = $info;

            echo json_encode(["response"=>'Successfuly login', "status"=>1]);
        }
        catch (\Delight\Auth\InvalidEmailException $e) {
            echo json_encode(["response"=>'Wrong email address', "status"=>0]);
        }
        catch (\Delight\Auth\InvalidPasswordException $e) {
            echo json_encode(["response"=>'Wrong password', "status"=>0]);
        }
        catch (\Delight\Auth\EmailNotVerifiedException $e) {
            echo json_encode(["response"=>'Email not verified', "status"=>0]);
        }
        catch (\Delight\Auth\TooManyRequestsException $e) {
            echo json_encode(["response"=>'Too many requests', "status"=>0]);
        }

    }

    public function register_user()
    {

        extract($_POST);
        try {

            $userId = $this->auth->register($email, $password, $username, function ($selector, $token) {

            });

            $this->verification($email, $this->hash->encode($userId));

            echo json_encode(["response"=>'Verification email has been sent!', "status"=>1]);
        }
        catch (\Delight\Auth\InvalidEmailException $e) {
            echo json_encode(["response"=>'Invalid email address', "status"=>0]);
        }
        catch (\Delight\Auth\InvalidPasswordException $e) {
            echo json_encode(["response"=>'Invalid password', "status"=>0]);
        }
        catch (\Delight\Auth\UserAlreadyExistsException $e) {
            echo json_encode(["response"=>'User already exists', "status"=>0]);
        }
        catch (\Delight\Auth\TooManyRequestsException $e) {
            echo json_encode(["response"=>'Too many requests', "status"=>0]);
        }

    }

    public function verify_user($userid)
    {

        $this->db->query("UPDATE users SET verified=%i WHERE id=%i", 1, $this->hash->decode($userid)[0]);

        header("location: http://localhost/lms/index.php");

    }



    public function verification($email, $userid)
    {

        try {
            //Server settings
            // $this->mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $this->mail->SMTPDebug = false; //Enable verbose debug output
            $this->mail->isSMTP(); //Send using SMTP
            $this->mail->Host = 'smtp.gmail.com'; //Set the SMTP server to send through
            $this->mail->SMTPAuth = true; //Enable SMTP authentication
            $this->mail->Username = 'conniebenetez@gmail.com'; //SMTP username
            $this->mail->Password = 'wdwfpioudaqphwiw'; //SMTP password
            $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $this->mail->Port = 587; //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above            
            //Recipients
            $this->mail->setFrom('conniebenetez@gmail.com', 'verification');
            $this->mail->addAddress($email); //Add a recipient

            //Content
            $this->mail->isHTML(true); //Set email format to HTML
            $this->mail->Subject = 'Verification Email';
            // $this->mail->Body = "<span style="width:50%; height:50%;"> <img src="img/logo2.png" style="width:50%; height:50%;"> </span> <h1>Click the link to verify account: <a href='http://localhost/batangas/api/user-verify/".$userid."' >Verify account</a></h1>";
            $this->mail->Body = "<h2> Greetings User! <h2> <br> <h3>Click the link to verify account: <a href='http://localhost/lms/studentapi/user-verify/".$userid."' >Verify account</a></h3>";

            $this->mail->send();
            // echo 'Message has been sent';
         
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
      


    }

    public function logout()
    {
        $this->auth->logOut();   
        unset($_SESSION['system']);
        echo json_encode(["response" => "logout"]);
    }

    public function checking_auth()
    {

        $LoggedIn = false;

        if ($this->auth->isLoggedIn()) {
            $LoggedIn = true;
        }

        return $LoggedIn;
    }

    public function get_user_id()
    {
    $id = $this->auth->getUserId();
    return $id;
    }

}


?>