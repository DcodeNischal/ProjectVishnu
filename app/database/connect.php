<?php 

class Connection {
    public $pdo = null;

    public function __construct(){
        try {
            $this->pdo = new PDO("mysql:host=localhost;dbname=vuln_db;charset=utf8mb4", "root", "");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connected successfully";
        } catch(PDOException $e){
            die("ERROR: Could not connect. " . $e->getMessage());
        }
    }

    public function company(){
        $statement = $this->pdo->prepare("CREATE TABLE IF NOT EXISTS company(
            id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            cname VARCHAR(255) NOT NULL,
            cusername VARCHAR(50) NOT NULL,
            cpassword VARCHAR(50) NOT NULL,
            cemail VARCHAR(50) NOT NULL,
            ccontact VARCHAR(50) NOT NULL,
            caddress VARCHAR(255) NOT NULL,
            cregistrationpdf VARCHAR(255) NOT NULL,
            cwebsite VARCHAR(255) NOT NULL,
            cindustry VARCHAR(255) NOT NULL,
            cdescription TEXT NOT NULL,
            clogo VARCHAR(255) NOT NULL,
            crangeofreward VARCHAR(50) NOT NULL,
            capilinks TEXT NOT NULL,
            celigibility TEXT NOT NULL,
            coutofscope TEXT NOT NULL,
            ctandc TEXT NOT NULL,
            ctimestamp DATETIME DEFAULT CURRENT_TIMESTAMP
        )");

        return $statement->execute(); // Execute the query directly instead of fetching results
    }

    public function Csignup($cname, $cusername, $cpassword, $cemail, $ccontact, $caddress, $cwebsite, $cindustry, $cdescription, $clogo, $crangeofreward, $capilinks,$celigibility,$coutofscope,$ctandc){
        $statement = $this->pdo->prepare("INSERT INTO company(cname, cusername, cpassword, cemail, ccontact, caddress, cwebsite, cindustry, cdescription, clogo, crangeofreward, capilinks,celigibility,coutofscope,ctandc) 
        VALUES(:cname, :cusername, :cpassword, :cemail, :ccontact, :caddress, :cwebsite, :cindustry, :cdescription, :clogo, :crangeofreward, :capilinks, :celigibility, :coutofscope, :ctandc)");

        return $statement->execute([
            ':cname' => $cname,
            ':cusername' => $cusername,
            ':cpassword' => $cpassword,
            ':cemail' => $cemail,
            ':ccontact' => $ccontact,
            ':caddress' => $caddress,
            ':cwebsite' => $cwebsite,
            ':cindustry' => $cindustry,
            ':cdescription' => $cdescription,
            ':clogo' => $clogo,
            ':crangeofreward' => $crangeofreward,
            ':capilinks' => $capilinks,
            ':celigibility' => $celigibility,
            ':coutofscope' => $coutofscope,
            ':ctandc' => $ctandc,
        ]);
    }

    public function users(){
        $statement = $this->pdo->prepare("CREATE TABLE IF NOT EXISTS users(
            uid INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            ufullname VARCHAR(50) NOT NULL,
            uusername VARCHAR(50) NOT NULL,
            upassword VARCHAR(50) NOT NULL,
            uemail VARCHAR(50) NOT NULL,
            ucontact VARCHAR(50) NOT NULL,
            ugender VARCHAR(50) NOT NULL,
            utimestamp DATETIME DEFAULT CURRENT_TIMESTAMP
        )");
        return $statement->execute();
    }

    public function Usignup($ufullname, $uusername, $upassword, $uemail, $ucontact, $ugender){
        $statement = $this->pdo->prepare("INSERT INTO users(ufullname, uusername, upassword, uemail, ucontact, ugender) 
        VALUES(:ufullname, :uusername, :upassword, :uemail, :ucontact, :ugender)");

        return $statement->execute([
            ':ufullname' => $ufullname,
            ':uusername' => $uusername,
            ':upassword' => $upassword,
            ':uemail' => $uemail,
            ':ucontact' => $ucontact,
            ':ugender' => $ugender,
        ]);
    }

    public function admin(){
        $statement = $this->pdo->prepare("CREATE TABLE IF NOT EXISTS admin(
            aid INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            ausername VARCHAR(50) NOT NULL,
            apassword VARCHAR(50) NOT NULL,
            atimestamp DATETIME DEFAULT CURRENT_TIMESTAMP
        )");
        return $statement->execute();
    }

    public function report(){
        $statement = $this->pdo->prepare("CREATE TABLE IF NOT EXISTS report(
            reportid INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            id INT NOT NULL,
            uid INT NOT NULL,
            title VARCHAR(100) NOT NULL,
            target VARCHAR(100) NOT NULL,
            severity VARCHAR(10) NOT NULL,
            type VARCHAR (50) NOT NULL,
            url VARCHAR (50) NOT NULL,
            description TEXT,
            attachmment VARCHAR(100),
            reporttime DATETIME DEFAULT CURRENT_TIMESTAMP
        )");
        return $statement->execute();

    }

    public function Clogin($cusername, $cpassword){
        $statement = $this->pdo->prepare("SELECT * FROM company WHERE cusername = :cusername AND cpassword = :cpassword");
        $statement->execute([
            ':cusername' => $cusername,
            ':cpassword' => $cpassword,
        ]);
        $count = $statement->rowCount();
        if($count > 0){
            return true;
        } else {
            return false;
        }
    }

    public function Ulogin($uusername, $upassword){
        $statement = $this->pdo->prepare("SELECT * FROM users WHERE uusername = :uusername AND upassword = :upassword");
        $statement->execute([
            ':uusername' => $uusername,
            ':upassword' => $upassword,
        ]);
        $count = $statement->rowCount();
        if($count > 0){
            return true;
        } else {
            return false;
        }
    }

    public function Alogin($ausername, $apassword){
        $statement = $this->pdo->prepare("SELECT * FROM admin WHERE ausername = :ausername AND apassword = :apassword");
        $statement->execute([
            ':ausername' => $ausername,
            ':apassword' => $apassword,
        ]);
        $count = $statement->rowCount();
        if($count > 0){
            return true;
        } else {
            return false;
        }
    }

    public function AchangePassword($ausername, $apassword){
        $statement = $this->pdo->prepare("UPDATE admin SET apassword = :apassword WHERE ausername = :ausername");
        return $statement->execute([
            ':ausername' => $ausername,
            ':apassword' => $apassword,
        ]);
    }

    public function checkUsername($username){
        $statement = $this->pdo->prepare("SELECT * FROM company WHERE cusername = :cusername");
        $statement->execute([
            ':cusername' => $username,
        ]);
        $count = $statement->rowCount();
        if($count > 0){
            return true;
        } else {
            return false;
        }
    }

    public function checkEmail($email): bool {
        $statement = $this->pdo->prepare("SELECT * FROM company WHERE cemail = :cemail");
        $statement->execute([
            ':cemail' => $email,
        ]);
        $count = $statement->rowCount();
        if($count > 0){
            return true;
        } else {
            return false;
        }
    }

    public function CchangePassword($cusername, $cpassword){
        $statement = $this->pdo->prepare("UPDATE company SET cpassword = :cpassword WHERE cusername = :cusername");
        return $statement->execute([
            ':cusername' => $cusername,
            ':cpassword' => $cpassword,
        ]);
        $count = $statement->rowCount();
        if($count > 0){
            return true;
        } else {
            return false;
        }
    }

    public function RsubmitReport($uid,$company_id,$title, $target, $severity, $type, $url, $description, $file){

        // if uid is not set, set it to 0
        if(!isset($uid)){
            $uid = 0;
        }

        $statement = $this->pdo->prepare("INSERT INTO report(uid, id, title, target, severity, type, url, description, attachmment)
        VALUES(:uid, :id, :title, :target, :severity, :type, :url, :description, :attachmment)");

        return $statement->execute([
            ':uid' => $uid,
            ':id' => $company_id,
            ':title' => $title,
            ':target' => $target,
            ':severity' => $severity,
            ':type' => $type,
            ':url' => $url,
            ':description' => $description,
            ':attachmment' => $file,
        ]);

    }

    public function getCompanyDetails($id){
        $statement = $this->pdo->prepare("SELECT * FROM company WHERE id = :cid");
        $statement->execute([
            ':cid' => $id,
        ]);

        // if no results send all fetch assoc to 0
        if($statement->rowCount() == 0){
            $statement = $this->pdo->prepare("SELECT * FROM company WHERE id = :cid");
            $statement->execute([
                ':cid' => 1,
            ]);
        }
        
        // return valid resultset
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserDetails($rusername){
        $statement = $this->pdo->prepare("SELECT * FROM users WHERE uusername = :uusername");
        $statement->execute([
            ':uusername' => $rusername,
        ]);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function checkUsernameUser($rusername){
        $statement = $this->pdo->prepare("SELECT * FROM users WHERE uusername = :uusername");
        $statement->execute([
            ':uusername' => $rusername,
        ]);
        $count = $statement->rowCount();
        if($count > 0){
            return true;
        } else {
            return false;
        }
    }

    public function checkEmailUser($remail): bool {
        $statement = $this->pdo->prepare("SELECT * FROM users WHERE uemail = :uemail");
        $statement->execute([
            ':uemail' => $remail,
        ]);
        $count = $statement->rowCount();
        if($count > 0){
            return true;
        } else {
            return false;
        }
    }

    public function getPoints($uid){
        $statement = $this->pdo->prepare("SELECT SUM(reward) FROM report WHERE uid = :uid");
        $statement->execute([
            ':uid' => $uid,
        ]);
        return $statement->fetchColumn();
    }


    public function UchangePassword($uusername, $upassword){
        $statement = $this->pdo->prepare("UPDATE users SET upassword = :upassword WHERE uusername = :uusername");
        return $statement->execute([
            ':uusername' => $uusername,
            ':upassword' => $upassword,
        ]);
    }

    public function getReports($id){
        $statement = $this->pdo->prepare("SELECT * FROM report WHERE uid = :id");
        $statement->execute([
            ':id' => $id,
        ]);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getReport($uid,$reportid){
        // check uid in report
        $statement = $this->pdo->prepare("SELECT * FROM report WHERE uid = :uid AND id = :id");
        $statement->execute([
            ':uid' => $uid,
            ':id' => $reportid,
        ]);
    }

    public function CgetCompany($username){
        $statement = $this->pdo->prepare("SELECT * FROM company WHERE cusername = :cusername");
        $statement->execute([
            ':cusername' => $username,
        ]);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function CgetReports($id){
        $statement = $this->pdo->prepare("SELECT * FROM report WHERE id = :id");
        $statement->execute([
            ':id' => $id,
        ]);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function CgetReport($id){
        $statement = $this->pdo->prepare("SELECT * FROM report WHERE reportid = :id");
        $statement->execute([
            ':id' => $id,
        ]);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function CgetTotalReports($id){
        $statement= $this->pdo->prepare("SELECT COUNT(*) FROM report WHERE id = :id");
        $statement->execute([
            ':id' => $id,
        ]);
        return $statement->fetchColumn();
    }

    public function CgetTotalReportsByStatus($status,$id){
        $statement = $this->pdo->prepare("SELECT COUNT(*) FROM report WHERE status = :status and id = :id");
        $statement->execute([
            ':status' => $status,
            ':id' => $id,
        ]);
        return $statement->fetchColumn();
    }

    public function CgetTotalRewards($id){
        $statement = $this->pdo->prepare("SELECT SUM(reward) FROM report WHERE id = :id");
        $statement->execute([
            ':id' => $id,
        ]);
        return $statement->fetchColumn();
    }

    public function CupdateReport($id, $status, $reward){

        // check reward of report and store it in different variable
        $statement = $this->pdo->prepare("SELECT reward FROM report WHERE reportid = :id");
        $statement->execute([
            ':id' => $id,
        ]);
        $oldreward = $statement->fetchColumn();
        $reward = $reward + $oldreward;

        $statement = $this->pdo->prepare("UPDATE report SET status = :status, reward = :reward WHERE reportid = :id");
        return $statement->execute([
            ':id' => $id,
            ':status' => $status,
            ':reward' => $reward,
        ]);
    }
    public function Hacktivity(){
        $statement = $this->pdo->prepare("SELECT * FROM report WHERE status = 'disclose' ORDER BY reporttime DESC LIMIT 20");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLeaderboard() {
        $statement = $this->pdo->prepare("SELECT users.uusername as user, SUM(report.reward) AS total_reward
                                         FROM report
                                         JOIN users ON report.uid = users.uid
                                         GROUP BY report.uid
                                         ORDER BY total_reward DESC
                                         LIMIT 10");
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
    
        if (empty($results)) {
            return null;
        }
    
        return $results;
    }

    public function getRank($uid){
        // find rank of user from leaderboard
        $statement = $this->pdo->prepare("SELECT users.uid as user, SUM(report.reward) AS total_reward
                                         FROM report
                                         JOIN users ON report.uid = users.uid
                                         GROUP BY report.uid
                                         ORDER BY total_reward DESC");
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        $rank = 1;
        foreach($results as $result){
            if($result['user'] == $uid){
                return $rank;
            }
            $rank++;
        }
    }

    public function getTotalSubmissionUser($uid){
        $statement = $this->pdo->prepare("SELECT COUNT(*) FROM report WHERE uid = :uid");
        $statement->execute([
            ':uid' => $uid,
        ]);
        return $statement->fetchColumn();
    }

    public function getReportStatusUser($uid, $status){
        $statement = $this->pdo->prepare("SELECT COUNT(*) FROM report WHERE uid = :uid AND status = :status");
        $statement->execute([
            ':uid' => $uid,
            ':status' => $status,
        ]);
        return $statement->fetchColumn();
    }
    

    
}
$connection = new Connection();
$connection->company();
$connection->users();
$connection->admin();
$connection->report();
