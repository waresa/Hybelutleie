<?php
//USER FUNCTIONS
// Check for empty input signup
function emptyInputSignup($name, $email, $pwd, $pwdRepeat)
{
	$result = false;
	if (empty($name) || empty($email) || empty($pwd) || empty($pwdRepeat)) {
		$result = true;
	} else {
		$result = false;
	}
	return $result;
}

// Check invalid email
function invalidEmail($email)
{
	$result = false;
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$result = true;
	} else {
		$result = false;
	}
	return $result;
}

// Check if passwords matches
function pwdMatch($pwd, $pwdrepeat)
{
	$result = false;
	if ($pwd !== $pwdrepeat) {
		$result = true;
	} else {
		$result = false;
	}
	return $result;
}

// Check if old password matches
function oldPwdMatch($conn, $oldpwd, $user_id)
{
	$sql = "SELECT * FROM users WHERE usersId = ?;";
	$stmt = mysqli_stmt_init($conn);
	mysqli_stmt_prepare($stmt, $sql);
	mysqli_stmt_bind_param($stmt, "s", $user_id);
	mysqli_stmt_execute($stmt);

	$resultData = mysqli_stmt_get_result($stmt);

	if ($row = mysqli_fetch_assoc($resultData)) {
		$pwdCheck = password_verify($oldpwd, $row["usersPwd"]);
		if ($pwdCheck === false) {
			return true;
		} else if ($pwdCheck === true) {
			return false;
		}
	}
}

// Check if email is in database, if so then return data
function emailExists($conn, $email)
{
	$sql = "SELECT * FROM users WHERE usersEmail = ?;";
	$stmt = mysqli_stmt_init($conn);
	mysqli_stmt_prepare($stmt, $sql);
	mysqli_stmt_bind_param($stmt, "s", $email);
	mysqli_stmt_execute($stmt);

	$resultData = mysqli_stmt_get_result($stmt);

	if ($row = mysqli_fetch_assoc($resultData)) {
		return $row;
	} else {
		$result = false;
		return $result;
	}
}

// Insert new user into database
function createUser($conn, $name, $email, $pwd, $notif)
{
	$sql = "INSERT INTO users (usersName, usersEmail, usersPwd, notif) VALUES (?, ?, ?, ?);";

	$stmt = mysqli_stmt_init($conn);
	mysqli_stmt_prepare($stmt, $sql);

	$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

	mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $hashedPwd, $notif);
	mysqli_stmt_execute($stmt);
	// header("location: ../login.php?error=none");
}

//function to get the userId of a user from the users table using the username
function getUserID($conn, $username)
{
	$sql = "SELECT usersid FROM users WHERE usersname = ?;";
	$stmt = mysqli_stmt_init($conn);
	mysqli_stmt_prepare($stmt, $sql);

	mysqli_stmt_bind_param($stmt, "s", $username);
	mysqli_stmt_execute($stmt);


	$resultData = mysqli_stmt_get_result($stmt);

	if ($row = mysqli_fetch_assoc($resultData)) {
		return $row;
	} else {
		$result = false;
		return $result;
	}
}

//edit user 
function editUser($conn, $name, $email, $pwd, $notif, $user_id)
{
	$sql = "UPDATE users SET usersName = ?, usersEmail = ?, usersPwd = ?, notif = ? WHERE usersId = ?;";
	$stmt = mysqli_stmt_init($conn);
	mysqli_stmt_prepare($stmt, $sql);
	$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
	mysqli_stmt_bind_param($stmt, "sssss", $name, $email, $hashedPwd, $notif, $user_id);
	mysqli_stmt_execute($stmt);
}

// change user email
function deleteEmail($conn, $user_id)
{
	$sql = "UPDATE users SET usersEmail = '' WHERE usersId = ?;";
	$stmt = mysqli_stmt_init($conn);
	mysqli_stmt_prepare($stmt, $sql);
	mysqli_stmt_bind_param($stmt, "s", $user_id);
	mysqli_stmt_execute($stmt);
}


function changeEmail($conn, $email, $user_id)
{
	$sql = "UPDATE users SET usersEmail = ? WHERE usersId = ?;";
	$stmt = mysqli_stmt_init($conn);
	mysqli_stmt_prepare($stmt, $sql);
	mysqli_stmt_bind_param($stmt, "ss", $email, $user_id);
	mysqli_stmt_execute($stmt);
}



// Check for empty input login
function emptyInputLogin($email, $pwd)
{
	$result = false;
	if (empty($email) || empty($pwd)) {
		$result = true;
	} else {
		$result = false;
	}
	return $result;
}

// Log user into website
function loginUser($conn, $email, $pwd)
{
	$emailExists = emailExists($conn, $email);

	if ($emailExists === false) {
		header("location: ../login.php?error=wronglogin");
		exit();
	}

	$pwdHashed = $emailExists["usersPwd"];
	$checkPwd = password_verify($pwd, $pwdHashed);

	if ($checkPwd === false) {
		header("location: ../login.php?error=wronglogin");
		exit();
	} elseif ($checkPwd === true) {
		session_start();
		$_SESSION["userid"] = $emailExists["usersId"];
		$_SESSION["useremail"] = $emailExists["useremail"];
		$_SESSION["username"] = $emailExists["usersName"];
		header("location: ../index.php?error=none");
		exit();
	}
}

// Check if ther is a conversation between two users
function isUserInInbox($conn, $user_id, $uname, $ad_id)
{
	$sql = "SELECT * FROM user_inbox WHERE usersid = ? AND uname = ? AND ad_id = ?;";
	$stmt = mysqli_stmt_init($conn);
	mysqli_stmt_prepare($stmt, $sql);

	mysqli_stmt_bind_param($stmt, "sss", $user_id, $uname, $ad_id);
	mysqli_stmt_execute($stmt);

	$resultData = mysqli_stmt_get_result($stmt);

	if ($row = mysqli_fetch_assoc($resultData)) {
		return $row;
	} else {
		$result = false;
		return $result;
	}
}

// Get a specific user
function getUser($conn, $user_id)
{
	$sql = "SELECT * FROM users WHERE usersId = ?;";
	$stmt = mysqli_stmt_init($conn);
	mysqli_stmt_prepare($stmt, $sql);

	mysqli_stmt_bind_param($stmt, "s", $user_id);
	mysqli_stmt_execute($stmt);


	$resultData = mysqli_stmt_get_result($stmt);

	if ($row = mysqli_fetch_assoc($resultData)) {
		return $row;
	} else {
		$result = false;
		return $result;
	}
}

//change user notification
function changeNotif($conn, $notif, $user_id)
{
	$sql = "UPDATE users SET notif = ? WHERE usersId = ?;";
	$stmt = mysqli_stmt_init($conn);
	mysqli_stmt_prepare($stmt, $sql);
	mysqli_stmt_bind_param($stmt, "ss", $notif, $user_id);
	mysqli_stmt_execute($stmt);
}

// Get all users that want notifications
function getAllUserIDsWithNotifOn($conn)
{
	$sql = "SELECT usersId FROM users WHERE notif = 1;";
	$stmt = mysqli_stmt_init($conn);
	mysqli_stmt_prepare($stmt, $sql);
	mysqli_stmt_execute($stmt);

	$resultData = mysqli_stmt_get_result($stmt);

	$users = array();
	while ($row = mysqli_fetch_assoc($resultData)) {
		$users[] = $row;
	}
	return $users;
}

// Get all a specific users wants
function getUserWants($conn, $user_id)
{
	$sql = "SELECT wants FROM renters WHERE usersid = ?;";
	$stmt = mysqli_stmt_init($conn);
	mysqli_stmt_prepare($stmt, $sql);

	mysqli_stmt_bind_param($stmt, "s", $user_id);
	mysqli_stmt_execute($stmt);

	$resultData = mysqli_stmt_get_result($stmt);

	$wants = array();
	while ($row = mysqli_fetch_assoc($resultData)) {
		$wants[] = $row;
	}
	return $wants;
}

// Get all users and their wants who have notifications on
function getAllUserWants($conn)
{
	$sql = "SELECT usersId, wants FROM renters WHERE usersId IN (SELECT usersId FROM users WHERE notif = 1);";
	$stmt = mysqli_stmt_init($conn);
	mysqli_stmt_prepare($stmt, $sql);
	mysqli_stmt_execute($stmt);

	$resultData = mysqli_stmt_get_result($stmt);

	$users = array();
	while ($row = mysqli_fetch_assoc($resultData)) {
		$users[] = $row;
	}
	return $users;
}


//AD functions

//Create an ad
function createAd($conn, $tilte, $leie, $boligtype, $antallrom, $areal, $etasje, $adresse, $postnr, $poststed, $leieperiode, $ledigfra, $info, $depositum, $usersId)
{
	$sql = "INSERT INTO ad (title, leie, boligtype, rom, areal, etasje, adresse, postnr, poststed, leieperiode, ledigfra, info, depositum, usersId) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
	$stmt = mysqli_stmt_init($conn);
	mysqli_stmt_prepare($stmt, $sql);
	mysqli_stmt_bind_param($stmt, "ssssssssssssss", $tilte, $leie, $boligtype, $antallrom, $areal, $etasje, $adresse, $postnr, $poststed, $leieperiode, $ledigfra, $info, $depositum, $usersId);
	mysqli_stmt_execute($stmt);
}

//edit an ad
function editAd($conn, $tilte, $leie, $boligtype, $antallrom, $areal, $etasje, $adresse, $postnr, $poststed, $leieperiode, $ledigfra, $info, $depositum, $ad_id)
{
	$sql = "UPDATE ad SET title = ?, leie = ?, boligtype = ?, rom = ?, areal = ?, etasje = ?, adresse = ?, postnr = ?, poststed = ?, leieperiode = ?, ledigfra = ?, info = ?, depositum = ? WHERE ad_id = ?;";
	$stmt = mysqli_stmt_init($conn);
	mysqli_stmt_prepare($stmt, $sql);
	mysqli_stmt_bind_param($stmt, "ssssssssssssss", $tilte, $leie, $boligtype, $antallrom, $areal, $etasje, $adresse, $postnr, $poststed, $leieperiode, $ledigfra, $info, $depositum, $ad_id);
	mysqli_stmt_execute($stmt);
}


//add facilities to ad
function addFacilities($conn, $facilities)
{
	$sql = "INSERT INTO fasiliteter (fasilitet, ad_id) VALUES (?, (SELECT MAX(ad_id) FROM ad));";
	$stmt = mysqli_stmt_init($conn);
	mysqli_stmt_prepare($stmt, $sql);
	mysqli_stmt_bind_param($stmt, "s", $facilities);
	mysqli_stmt_execute($stmt);
}

//create user renter profile
function createRenter($conn, $budget, $wants, $usersId)
{
	$sql = "INSERT IGNORE INTO renters (budget, wants, usersId) VALUES (?, ?, ?);";
	$stmt = mysqli_stmt_init($conn);
	mysqli_stmt_prepare($stmt, $sql);
	mysqli_stmt_bind_param($stmt, "sss", $budget, $wants, $usersId);
	mysqli_stmt_execute($stmt);
}

//edit user renter profile
function editRenter($conn, $budget, $wants, $user_id)
{
	$sql = "UPDATE renters SET budget = ?, wants = ? WHERE usersId = ?;";
	$stmt = mysqli_stmt_init($conn);
	mysqli_stmt_prepare($stmt, $sql);
	mysqli_stmt_bind_param($stmt, "sss", $budget, $wants, $user_id);
	mysqli_stmt_execute($stmt);
}

//get a specific renter
function getRenter($conn, $user_id)
{
	$sql = "SELECT * FROM renters WHERE usersId = ?;";
	$stmt = mysqli_stmt_init($conn);
	mysqli_stmt_prepare($stmt, $sql);

	mysqli_stmt_bind_param($stmt, "s", $user_id);
	mysqli_stmt_execute($stmt);
	$resultData = mysqli_stmt_get_result($stmt);
	if ($row = mysqli_fetch_assoc($resultData)) {
		return $row;
	} else {
		$result = false;
		return $result;
	}
}


// function to get specific ad
function getAd($conn, $ad_id)
{
	$sql = "SELECT * FROM ad WHERE ad_id = ?;";
	$stmt = mysqli_stmt_init($conn);
	mysqli_stmt_prepare($stmt, $sql);
	mysqli_stmt_bind_param($stmt, "s", $ad_id);
	mysqli_stmt_execute($stmt);
	$resultData = mysqli_stmt_get_result($stmt);
	if ($row = mysqli_fetch_assoc($resultData)) {
		return $row;
	} else {
		$result = false;
		return $result;
	}
}

//delete ad by changing isDeleted to 1
function deleteAd($conn, $ad_id)
{
	$sql = "UPDATE ad SET isDeleted = 1 WHERE ad_id = ?;";
	$stmt = mysqli_stmt_init($conn);
	mysqli_stmt_prepare($stmt, $sql);
	mysqli_stmt_bind_param($stmt, "s", $ad_id);
	mysqli_stmt_execute($stmt);
}

//return ad if ad_id and usersId matches
function isMyAd($conn, $ad_id, $usersId)
{
	$sql = "SELECT * FROM ad WHERE ad_id = ? AND usersId = ?;";
	$stmt = mysqli_stmt_init($conn);
	mysqli_stmt_prepare($stmt, $sql);
	mysqli_stmt_bind_param($stmt, "ss", $ad_id, $usersId);
	mysqli_stmt_execute($stmt);
	$resultData = mysqli_stmt_get_result($stmt);
	if ($row = mysqli_fetch_assoc($resultData)) {
		return $row;
	} else {
		$result = false;
		return $result;
	}
}


//get all ads
function getAllAdIds($conn)
{
	$sql = "SELECT * FROM ad;";
	$stmt = mysqli_stmt_init($conn);
	mysqli_stmt_prepare($stmt, $sql);
	mysqli_stmt_execute($stmt);
	$resultData = mysqli_stmt_get_result($stmt);
	if ($row = mysqli_fetch_all($resultData)) {
		return $row;
	} else {
		$result = false;
		return $result;
	}
}

//get the last ad using max ad_id
function getLastAd($conn)
{
	$sql = "SELECT ad_id FROM ad WHERE ad_id = (SELECT MAX(ad_id) FROM ad);";
	$stmt = mysqli_stmt_init($conn);
	mysqli_stmt_prepare($stmt, $sql);
	mysqli_stmt_execute($stmt);
	$resultData = mysqli_stmt_get_result($stmt);
	if ($row = mysqli_fetch_assoc($resultData)) {
		$rs = implode($row);
		return $rs;
	} else {
		$result = false;
		return $result;
	}
}

//get all ad info from ad table and fasiliteter table
function getAdInfo($conn, $ad_id)
{
	$sql = "SELECT ad.*, fasiliteter.* FROM ad inner JOIN fasiliteter on ad.ad_id = fasiliteter.ad_id WHERE ad.ad_id = ?;";
	$stmt = mysqli_stmt_init($conn);
	mysqli_stmt_prepare($stmt, $sql);

	mysqli_stmt_bind_param($stmt, "s", $ad_id);
	mysqli_stmt_execute($stmt);


	$resultData = mysqli_stmt_get_result($stmt);

	if ($row = mysqli_fetch_assoc($resultData)) {
		return $row;
	} else {
		$result = false;
		return $result;
	}
}

//get all ad images from images table
function getAdImgs($conn, $ad_id)
{
	$sql = "SELECT * from images where ad_id = ?;";
	$stmt = mysqli_stmt_init($conn);
	mysqli_stmt_prepare($stmt, $sql);
	mysqli_stmt_bind_param($stmt, "s", $ad_id);
	mysqli_stmt_execute($stmt);

	$resultData = mysqli_stmt_get_result($stmt);

	if ($row = mysqli_fetch_all($resultData)) {
		return $row;
	} else {
		$result = false;
		return $result;
	}
}

//get all of a users ads
function getUserAd($conn, $user_id)
{
	$sql = "SELECT * FROM ad WHERE usersId = ?;";
	$stmt = mysqli_stmt_init($conn);
	mysqli_stmt_prepare($stmt, $sql);
	mysqli_stmt_bind_param($stmt, "s", $user_id);
	mysqli_stmt_execute($stmt);

	$resultData = mysqli_stmt_get_result($stmt);

	if ($row = mysqli_fetch_all($resultData)) {
		return $row;
	} else {
		$result = false;
		return $result;
	}
}

//function to upload images for an ad and insert them into the img folder and the images table
function uploadAdImgs($conn, $files, $ad_id)
{
	$ins = 0;
	//loop through all files and insert them into the img folder and the images table
	foreach ($files['upload']['name'] as $key => $name) {

		$newFilename = $ad_id . "_" . $name;

		//create img folder if it does not exist
		if (!dir('img'))
			mkdir('img');
		//move file to img folder
		$move = move_uploaded_file($_FILES['upload']['tmp_name'][$key], 'img/' . $newFilename);
		//if file is moved insert it into the images table
		if ($move) {
			$sql = "INSERT INTO images (file_name, ad_id) VALUES (?, ?);";
			$stmt = mysqli_stmt_init($conn);
			mysqli_stmt_prepare($stmt, $sql);
			mysqli_stmt_bind_param($stmt, "ss", $newFilename, $ad_id);
			$insert = mysqli_stmt_execute($stmt);
			if ($insert) {
				$ins++;
			}
		}
		//if all files are inserted redirect to my ads page
		if (count($files['upload']['name']) == $ins) {
			header("location: ../myads.php?error=none");
		} else {
			header("location: ../createad.php?error=uploadfailed");
		}
	}
}

//function to get information about the user who created the ad
function getAdUserInfo($conn, $ad_id)
{
	$sql = "SELECT users.*, ad.* FROM users INNER JOIN ad ON users.usersid = ad.usersid WHERE ad.ad_id = ?;";
	$stmt = mysqli_stmt_init($conn);
	mysqli_stmt_prepare($stmt, $sql);

	mysqli_stmt_bind_param($stmt, "s", $ad_id);
	mysqli_stmt_execute($stmt);

	$resultData = mysqli_stmt_get_result($stmt);

	if ($row = mysqli_fetch_assoc($resultData)) {
		return $row;
	} else {
		$result = false;
		return $result;
	}
}

//function to get the first image of an ad
function getFirstImgOfAd($conn, $ad_id)
{
	$sql = "SELECT * FROM images WHERE ad_id = ? LIMIT 1;";
	$stmt = mysqli_stmt_init($conn);
	mysqli_stmt_prepare($stmt, $sql);
	mysqli_stmt_bind_param($stmt, "s", $ad_id);
	mysqli_stmt_execute($stmt);


	$resultData = mysqli_stmt_get_result($stmt);

	if ($row = mysqli_fetch_assoc($resultData)) {
		return $row;
	} else {
		$result = false;
		return $result;
	}
}

//function to check if an ad is created by the user who is logged in
function isAdByUser($conn, $ad_id, $user_id)
{
	$sql = "SELECT * FROM ad WHERE ad_id = ? AND usersId = ?;";
	$stmt = mysqli_stmt_init($conn);
	mysqli_stmt_prepare($stmt, $sql);
	mysqli_stmt_bind_param($stmt, "ss", $ad_id, $user_id);
	mysqli_stmt_execute($stmt);

	$resultData = mysqli_stmt_get_result($stmt);

	if ($row = mysqli_fetch_assoc($resultData)) {
		return $row;
	} else {
		$result = false;
		return $result;
	}
}

//MESSAGE FUNCTIONS

//function to send a message or insert a message into the messages table
function sendMessage($conn, $sender, $receiver, $message, $ad_id)
{
	$sql = "INSERT INTO messages (receiver, sender, message, ad_id) VALUES (?, ?, ?, ?);";
	$stmt = mysqli_stmt_init($conn);
	mysqli_stmt_prepare($stmt, $sql);
	mysqli_stmt_bind_param($stmt, "ssss", $message, $receiver, $sender, $ad_id);
	mysqli_stmt_execute($stmt);
}

//function to insert a conversation into the user_inbox table
function insertInbox($conn, $user_id, $uname, $ad_id)
{
	$sql = "INSERT IGNORE INTO user_inbox (usersId, uname, ad_id) VALUES (?, ?, ?);";
	$stmt = mysqli_stmt_init($conn);
	mysqli_stmt_prepare($stmt, $sql);
	mysqli_stmt_bind_param($stmt, "sss", $user_id, $uname, $ad_id);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
}

//function to get all the conversations of a user from the user_inbox table
function getUsersInbox($conn, $user_id)
{
	$sql = "SELECT * FROM user_inbox WHERE usersId = ?;";
	$stmt = mysqli_stmt_init($conn);
	mysqli_stmt_prepare($stmt, $sql);
	mysqli_stmt_bind_param($stmt, "s", $user_id);
	mysqli_stmt_execute($stmt);

	$resultData = mysqli_stmt_get_result($stmt);

	if ($row = mysqli_fetch_all($resultData)) {
		return $row;
	} else {
		$result = false;
		return $result;
	}
}

//function to get the messages between two users from the messages table
function getMessageInfo($conn, $user_id, $sender)
{
	$sql = "SELECT message, created, sender FROM messages where sender = ? and receiver = ? or sender = ? and receiver = ? order by created asc;";
	$stmt = mysqli_stmt_init($conn);
	mysqli_stmt_prepare($stmt, $sql);

	mysqli_stmt_bind_param($stmt, "ssss", $sender, $user_id, $sender, $user_id);
	mysqli_stmt_execute($stmt);


	$resultData = mysqli_stmt_get_result($stmt);

	if ($row = mysqli_fetch_all($resultData)) {
		return $row;
	} else {
		$result = false;
		return $result;
	}
}
