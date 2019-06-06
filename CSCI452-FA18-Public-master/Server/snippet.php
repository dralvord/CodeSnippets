<?php
require_once "function.php";
require_once 'dblogin.php';

session_start();
header("Access-Control-Allow-Origin: *");

// Create connection
$conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$cmd = getValue("cmd", "");

if($cmd == "filter")
{
    $response = filter($conn, $creator, $lang, $desc);
    header('Content-type: application/json');
    echo json_encode($response);
}

else if($cmd == "create")
{
    $response = create($conn);
    header('Content-type: application/json');
    echo json_encode($response);
}
else if($cmd == "getUserData")
{
    $response = getUserData($conn);
    header('Content-type: application/json');
    echo json_encode($response);
}

else if($cmd == "checkSecurityAnswers")
{
    $response = checkSecurityAnswers($conn);
    header('Content-type: application/json');
    echo json_encode($response);
}

else if($cmd == "login")
{
    $response = login($conn);
    header('Content-type: application/json');
    echo json_encode($response);
}

else if($cmd == "logout")
{
    $response = logout($conn);
    header('Content-type: application/json');
    echo json_encode($response);
}

else if($cmd == "pwResetLogin")
{
    $response = pwResetLogin($conn);
    header('Content-type: application/json');
    echo json_encode($response);
}

else if($cmd == "signUpLogin")
{
    $response = signUpLogin($conn);
    header('Content-type: application/json');
    echo json_encode($response);
}

else if($cmd == "createSnippet")
{
    $response = createSnippet($conn);
    header('Content-type: application/json');
    echo json_encode($response);
}
else if($cmd == "displayLanguages")
{
    $response = displayLanguages($conn);
    header('Content-type: application/json');
    echo json_encode($response);
}
else if($cmd == "insertSampleSnippets")
{
    $response = insertSampleSnippets($conn);
    header('Content-type: application/json');
    echo json_encode($response);
}
else if($cmd == "updateSnippet")
{
    $response = updateSnippet($conn);
    header('Content-type: application/json');
    echo json_encode($response);
}
else if($cmd == "deleteSnippet")
{
    $response = deleteSnippet($conn);
    header('Content-type: application/json');
    echo json_encode($response);
}
// -----------------------------------------------//
else // list all supported commands
{
  echo
  "
    <pre>
        Command: filter
      
            Description: Filters and sorts data based on specific parameters
            
            Parameters: Creator, Language, Description, OrderBy

            Example:
                Query string: ?cmd=filter&Creator=Lindsey&OrderBy=USERS.US_USERNAME ASC
                Returns: {SnippetID:2, Creator:Lindsey, Language: c++, Description:'Get User Input and assign to variable', Code: 'cin >> userInput;';}
                         {SnippetID:3, Creator:Lindsey, Language: Python, Description:'Reading in Raw Input', Code: 'name = raw_input(\"What is your name? \");}
    </pre>
    
    <pre>
        Command: create
      
            Description: create a new user account
            
            Parameters: userName, userPassword, userQUE1, userQUE1ANS, userQUE2, userQUE2ANS

            Example:
                Query string: ?cmd=create&userName=sam&userPassword=food&userQUE1=Where you were born?&userQUE1ANS=Thailand&userQUE2=pet name&userQUE2ANS=fluffy
                Returns: {status:OK}
    </pre>  

    <pre>
        Command: getUserData
      
            Description: Return userid and security questions with answers
            
            Parameters: userName

            Example:
                Query string: ?cmd=getUserData&userName=sam5
                Returns: [{status:true,UserID:4,UserPassword:$2y$10$AxTsF0ZmNSdac7k.vRlRb.HNHkAnyf2myElD\/ZhFGMA,Q1:where you live?,Q1Ans:$2y$10$7BWD8t1dAHKEX5QcAoNc3OSU58IK7jwV9v1mkdq8iiPqo8nCkC3u2,Q2:hair color,Q2Ans:$2y$10$fQWyyQGOZXu5HxWaZvCAQelpzbgwY2\/ekjvF9bD3faYtJisdN7LF2}]
                       : {status:false}
    </pre>      
    
    <pre>
        Command: checkSecurityAnswers
            
            Description: Returns true if answers to security questions are correct. Otherwise returns false 
            
            Parameters: userID
            
            Example: ?cmd=checkSecurityAnswers&userID=21&userQ1ANSReset=test&userQ2ANSReset=test&newPassword=sam1234&newPassword2=sam1234
            Returns: {answers:true}
    </pre>
    
    <pre>
        Command: login
            Description: Logs in the user if the password is correct
            
            Parameters: userName and userPassword
            
            Example:?cmd=login&userNameLogin=Dillon&userPasswordLogin=password
            Returns: {'user':{'userID':1,'userName':'Dillon'},'loggedIn':true}
    </pre>
    
    <pre>
        Command: logout
            Description: Logs out the current user
            
            Parameters: none
            
            Example:?cmd=logout
            Returns: {'loggedIn':false}
    </pre>
    
    <pre>
        Command: pwResetLogin
            Description: Logs in the user after changing password
            
            Parameters: userName and userPassword
            
            Example:?cmd=pwResetLogin&userNamePSW=lindsey&newPassword=carter
            Returns: {'user':{'userID':4,'userName':'lindsey'},'loggedIn':true}
    </pre>
    
    <pre>
        Command: signUpLogin
            Description: Logs in the user after signing up
            
            Parameters: userName and userPassword
            
            Example:?cmd=signUpLogin&userNamePSW=lindsey&newPassword=carter
            Returns: {'user':{'userID':4,'userName':'lindsey'},'loggedIn':true}
    </pre>

    <pre>
        Command: updateSnippet
            Description: update Snippet base on the id
            
            Parameters: id,language,description, and code
            
            Example:?cmd=updateSnippet&id=1&language=4&description=update code test&code=Hello there
    </pre>    
  ";
}

// ----------- Lindsey, Tyler, Somwang, Dillon - filter and sort ---------------------------------
function filter($conn)
{
    $creator = getValue("Creator", "NA");
    $lang = getValue("t1", "NA");
    $desc = getValue("Description", "NA");
    
    $creator = "%".$creator."%";
    $lang = "%".$lang."%";
    $desc = "%".$desc."%";
    
    $ord = getValue("OrderBy", "USERS.US_USERNAME ASC");
    
    if ($creator != "%NA%" && $lang != "%NA%" && $desc != "%NA%") //creator, lang, desc,
    {
        $s = "SELECT SNIPPETS.SNP_ID,USERS.US_ID,USERS.US_USERNAME,LANGUAGES.LN_NAME,SNIPPETS.SNP_DESCRIPTION,SNIPPETS.SNP_CODE,SNIPPETS.LN_ID 
              FROM SNIPPETS
              INNER JOIN USERS ON USERS.US_ID = SNIPPETS.US_ID
              INNER JOIN LANGUAGES ON LANGUAGES.LN_ID = SNIPPETS.LN_ID
              WHERE USERS.US_USERNAME LIKE ? AND LANGUAGES.LN_NAME LIKE ? AND SNP_DESCRIPTION LIKE ? 
              ORDER BY ".$ord;  
        $stmt = $conn->prepare($s);
        $stmt->bind_param("sss", $creator, $lang, $desc);
    }
    else if ($creator != "%NA%" && $lang == "%NA%" && $desc == "%NA%") //creator, NA, NA
    {
        $s = "SELECT SNIPPETS.SNP_ID,USERS.US_ID,USERS.US_USERNAME,LANGUAGES.LN_NAME,SNIPPETS.SNP_DESCRIPTION,SNIPPETS.SNP_CODE,SNIPPETS.LN_ID  
              FROM SNIPPETS
              INNER JOIN USERS ON USERS.US_ID = SNIPPETS.US_ID
              INNER JOIN LANGUAGES ON LANGUAGES.LN_ID = SNIPPETS.LN_ID
              WHERE USERS.US_USERNAME LIKE ? 
              ORDER BY ".$ord;        
        $stmt = $conn->prepare($s);
        $stmt->bind_param("s", $creator);
    }
    else if ($creator != "%NA%" && $lang != "%NA%" && $desc == "%NA%") //creator, lang, NA
    {
        $s = "SELECT SNIPPETS.SNP_ID,USERS.US_ID,USERS.US_USERNAME,LANGUAGES.LN_NAME,SNIPPETS.SNP_DESCRIPTION,SNIPPETS.SNP_CODE,SNIPPETS.LN_ID  
              FROM SNIPPETS
              INNER JOIN USERS ON USERS.US_ID = SNIPPETS.US_ID
              INNER JOIN LANGUAGES ON LANGUAGES.LN_ID = SNIPPETS.LN_ID
              WHERE USERS.US_USERNAME LIKE ? AND LANGUAGES.LN_NAME LIKE ? 
              ORDER BY ".$ord;          
        $stmt = $conn->prepare($s);
        $stmt->bind_param("ss", $creator, $lang);
    }
    else if ($creator != "%NA%" && $lang == "%NA%" && $desc != "%NA%") //creator, NA, desc
    {
        $s = "SELECT SNIPPETS.SNP_ID,USERS.US_ID,USERS.US_USERNAME,LANGUAGES.LN_NAME,SNIPPETS.SNP_DESCRIPTION,SNIPPETS.SNP_CODE,SNIPPETS.LN_ID  
              FROM SNIPPETS
              INNER JOIN USERS ON USERS.US_ID = SNIPPETS.US_ID
              INNER JOIN LANGUAGES ON LANGUAGES.LN_ID = SNIPPETS.LN_ID
              WHERE USERS.US_USERNAME LIKE ? AND SNP_DESCRIPTION LIKE ? 
              ORDER BY ".$ord;              
        $stmt = $conn->prepare($s);
        $stmt->bind_param("ss", $creator, $desc);
    }
    else if ($creator == "%NA%" && $lang != "%NA%" && $desc == "%NA%") //NA, lang, NA
    {
        $s = "SELECT SNIPPETS.SNP_ID,USERS.US_ID,USERS.US_USERNAME,LANGUAGES.LN_NAME,SNIPPETS.SNP_DESCRIPTION,SNIPPETS.SNP_CODE,SNIPPETS.LN_ID  
              FROM SNIPPETS
              INNER JOIN USERS ON USERS.US_ID = SNIPPETS.US_ID
              INNER JOIN LANGUAGES ON LANGUAGES.LN_ID = SNIPPETS.LN_ID
              WHERE LANGUAGES.LN_NAME LIKE ? 
              ORDER BY ".$ord;           
        $stmt = $conn->prepare($s);
        $stmt->bind_param("s", $lang);
    }
    else if ($creator == "%NA%" && $lang != "%NA%" && $desc != "%NA%") //NA, lang, desc
    {
        $s = "SELECT SNIPPETS.SNP_ID,USERS.US_ID,USERS.US_USERNAME,LANGUAGES.LN_NAME,SNIPPETS.SNP_DESCRIPTION,SNIPPETS.SNP_CODE,SNIPPETS.LN_ID  
              FROM SNIPPETS
              INNER JOIN USERS ON USERS.US_ID = SNIPPETS.US_ID
              INNER JOIN LANGUAGES ON LANGUAGES.LN_ID = SNIPPETS.LN_ID
              WHERE LANGUAGES.LN_NAME LIKE ? AND SNP_DESCRIPTION LIKE ? 
              ORDER BY ".$ord;            
        $stmt = $conn->prepare($s);
        $stmt->bind_param("ss", $lang, $desc);
    }
    else if ($creator == "%NA%" && $lang == "%NA%" && $desc != "%NA%") //NA, NA, desc
    {
        $s = "SELECT SNIPPETS.SNP_ID,USERS.US_ID,USERS.US_USERNAME,LANGUAGES.LN_NAME,SNIPPETS.SNP_DESCRIPTION,SNIPPETS.SNP_CODE,SNIPPETS.LN_ID  
              FROM SNIPPETS
              INNER JOIN USERS ON USERS.US_ID = SNIPPETS.US_ID
              INNER JOIN LANGUAGES ON LANGUAGES.LN_ID = SNIPPETS.LN_ID
              WHERE SNP_DESCRIPTION LIKE ? 
              ORDER BY ".$ord;                
        $stmt = $conn->prepare($s);
        $stmt->bind_param("s", $desc);
    }
    else //no filter or sort
    {
        $s = "SELECT SNIPPETS.SNP_ID,USERS.US_ID,USERS.US_USERNAME,LANGUAGES.LN_NAME,SNIPPETS.SNP_DESCRIPTION,SNIPPETS.SNP_CODE,SNIPPETS.LN_ID  
              FROM SNIPPETS
              INNER JOIN USERS ON USERS.US_ID = SNIPPETS.US_ID
              INNER JOIN LANGUAGES ON LANGUAGES.LN_ID = SNIPPETS.LN_ID
              ORDER BY ".$ord;                
        $stmt = $conn->prepare($s);
    }
    
    $stmt->execute();
    $stmt->bind_result($id,$creatorID,$creator,$lang,$desc,$code,$langID);
        
    $rows = array();
    while($stmt->fetch())
    {
        $row = array("SnippetID"=>$id, "CreatorID"=>$creatorID, "Creator"=>htmlspecialchars($creator,ENT_QUOTES), "Language"=>htmlspecialchars($lang,ENT_QUOTES), "Description"=>htmlspecialchars($desc,ENT_QUOTES), "Code"=>htmlspecialchars($code,ENT_QUOTES), "LangID"=>$langID, "status"=>"OK");
        $rows[] = $row;
    }
    
    return $rows;
}
// ----------- Somwang UA1 - Create a new user account ---------------------------------
function create($conn)
{
    $userName = getValue("userName", "");
    $userPassword = getValue("userPassword", "");
    $userQUE1 = getValue("userQUE1", "");
    $userQUE1ANS = getValue("userQUE1ANS", "");
    $userQUE2 = getValue("userQUE2", "");
    $userQUE2ANS = getValue("userQUE2ANS", "");
    
    $sPSW = password_hash($userPassword,PASSWORD_DEFAULT);
    $sQue1ANS = password_hash($userQUE1ANS,PASSWORD_DEFAULT);
    $sQue2ANS = password_hash($userQUE2ANS,PASSWORD_DEFAULT);
   
    $len = strlen($userPassword);
    if($len < 6)
    {
        return array("createMsg"=>"Password must be atleast 6 characters...", "status"=>"Error");
    }
    
    if (trim($userName) == "" || trim($userPassword) == "" || 
        trim($userQUE1) == "" || trim($userQUE1ANS) == "" || 
        trim($userQUE2) == "" || trim($userQUE2ANS) == "")
    {
        return array("createMsg"=>"All fields are required!", "status"=>"Error");
    }
    else
    {
        /*-----Tyler UA4 - check for duplicate username -----------*/
        $S2 = ("SELECT US_USERNAME FROM USERS WHERE US_USERNAME = ?");
        $stmt = $conn->prepare($S2);
        $stmt->bind_param("s", $userName);
        if($stmt->execute())
        {
            $stmt->store_result();
        }
        if($stmt->num_rows == 1) 
        {
            return array("createMsg"=>"That username is already being used.","status"=>"Error");
        }
        $stmt->close();
        /*----------------------------------------------------------*/
        
        $S = "INSERT INTO USERS(US_USERNAME, US_PASSWORD,US_QUE1,US_QUE1ANS,US_QUE2,US_QUE2ANS) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($S);
        $stmt->bind_param("ssssss", $userName, $sPSW,$userQUE1,$sQue1ANS,$userQUE2,$sQue2ANS);

        if(!$stmt->execute()) 
        {
            return array("createMsg"=>"An Unknown Error has occured.","status"=>"Error");
        }
        else
        {
            return array("createMsg"=>"Your account has been created successfully and is ready to use.","status"=>"OK");
        }
    }
}

// ----------- Somwang UA2 - Return security question by user name ---------------------
function getUserData($conn)
{
    $isEmpty = true;
    $userName = getValue("userNamePSW", "");
    
    $S = "SELECT US_ID,US_PASSWORD,US_QUE1,US_QUE1ANS,US_QUE2,US_QUE2ANS From USERS WHERE US_USERNAME = ?";
    $stmt = $conn->prepare($S);
    $stmt->bind_param("s", $userName);   
    $stmt->execute();
    $stmt->bind_result($userID,$userPassword,$q1,$q1Ans,$q2,$q2Ans);
    $rows = array();
    
    while($stmt->fetch())
    {
        $isEmpty = false;
        $row = array("status"=>"true","UserMsg"=>"Found it","UserID"=>$userID,"UserPassword"=>$userPassword, "Q1"=>$q1, "Q1Ans"=>$q1Ans, "Q2"=>$q2, "Q2Ans"=>$q2Ans);
        $rows[] = $row;
    }
    if ($isEmpty == true)
    {
        return array(array("status"=>"false","UserMsg"=>"User not found, please try again!"));
    }
    else
    {
        return $rows;
    }
}

//--------- Dillon UA2 - Check if Answers to Security Questions are correct ---------------
function checkSecurityAnswers($conn)
{
    $userID = getValue("userID","");
    $q1AnsInput = getValue("userQ1ANSReset","");
    $q2AnsInput = getValue("userQ2ANSReset","");
    $psw1 = getValue("newPassword","");
    $psw2 = getValue("newPassword2","");
    $userName = getValue("userNamePSW","");
    
    $stmt = $conn->prepare("SELECT US_QUE1ANS, US_QUE2ANS FROM USERS WHERE US_ID = ?");
    $stmt->bind_param("i", $userID);
    $stmt->execute();
    $stmt->bind_result($q1Ans,$q2Ans);
    $stmt->fetch();
    $stmt->close();
    
    if(password_verify($q1AnsInput,$q1Ans) && password_verify($q2AnsInput,$q2Ans))
    {
        if (trim($psw1) != trim($psw2))
        {
            return array("answers"=>"false","Msg"=>"Password do not match");
        }
        else /*-----Tyler UA2 - Password validation and Update -----------*/
        {
            $len = strlen($psw2);
            if($len < 6)
            {
                return array("answers"=>"false","Msg"=>"Password must be atleast 6 characters..");
            }
            else
            {
                $sPSW2 = password_hash($psw2,PASSWORD_DEFAULT);
                $stmt2 = $conn->prepare("UPDATE USERS SET US_PASSWORD = ? WHERE US_ID = ?");
                $stmt2->bind_param("si",$sPSW2,$userID);
               
                if(!$stmt2->execute()) 
                {
                    return array("answers"=>"false","Msg"=>"There is an issue, Please try again");
                }
                else
                {
                    return array("answers"=>"true","Msg"=>"Success!");
                }
            }
        }
    }
    else
    {
        return array("answers"=>"false","Msg"=>"Security answers do not match");
    }
}

//----------------------  Dillon UA3 User Login ------------------------------
function login($conn)
{
    //Logs out current user
    setSessionValue("user", "");

    // Makes sure there is a userName and a password
    $userName = getValue("userNameLogin", "");
    if ($userName == "")
    {
        $response["error"] = "Username is required when logging in user.";
        return $response;
    }
    $userPass = getValue("userPasswordLogin", "");
    if ($userPass == "")
    {
        $response["error"] = "Password is required when logging in user.";
        return $response;
    }

    // Selects user id and password from the database
    $stmt = $conn->prepare("SELECT US_ID, US_PASSWORD FROM USERS WHERE US_USERNAME = ?");
    $stmt->bind_param("s", $userName);
    $stmt->execute();
    $stmt->bind_result($userID, $hashPassword);
    
    $user = array();
    if ($stmt->fetch()) 
    {
        if (password_verify($userPass, $hashPassword))
        {
            $user["userID"] = $userID;
            $user["userName"] = $userName;
            setSessionValue("user", $user);
        }
    }
    
    // if the user is empty, then the username/password is invalid...
    if (count($user) == 0)
    {
        $response["error"] = "Invalid username or password.";
        return $response;
    }

    // login successful, return the user...
    $response["user"] = $user;
    $response["loggedIn"] = getSessionValue("user", "") != "";
    return $response;
}

//--------------------Dillon UA5 User Logout-------------------
function logout()
{
    setSessionValue("user", "");
    $response["loggedIn"] = false;
    return $response;
}

//---------------------Tyler SM1 & SM2 Create Snippet----------------
function createSnippet($conn)
{
    
    $language = getValue("t2","");
    $description = getValue("description","");
    $codeAdd = getValue("code","");
    $creator = $_SESSION["user"]["userID"];
    
    $s = "INSERT INTO SNIPPETS(US_ID, LN_ID, SNP_DESCRIPTION, SNP_CODE) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($s);
    $stmt->bind_param("isss", $creator, $language, $description, $codeAdd);
    
    if(!$stmt->execute()) 
    {
        return array("error"=>"An Unknown Error has occured.","status"=>"Error");
    }
    else
    {
        return filter($conn);
    }    
}

//----------Tyler Delete Snippet SM3------------------------
function deleteSnippet($conn)
{
    $snippetID = getValue("snippetID","");
    
    $s = "DELETE FROM SNIPPETS WHERE SNP_ID = ?";
    $stmt = $conn->prepare($s);
    $stmt->bind_param("i", $snippetID);
    
    if(!$stmt->execute()) 
    {
        return array(array("error"=>"An Unknown Error has occured.","status"=>"Error"));
    }
    else
    {
        return filter($conn);
    }  
}

//-----------Lindsey Refactor AutoLogin after PW Reset---------
function pwResetLogin($conn)
{
    //Logs out current user
    setSessionValue("user", "");

    // Makes sure there is a userName and a password
    $userName = getValue("userNamePSW", "");
    if ($userName == "")
    {
        $response["error"] = "Username is required when logging in user.";
        return $response;
    }

    // Selects user id and password from the database
    $stmt = $conn->prepare("SELECT US_ID FROM USERS WHERE US_USERNAME = ?");
    $stmt->bind_param("s", $userName);
    $stmt->execute();
    $stmt->bind_result($userID);
    
    $user = array();
    if ($stmt->fetch()) 
    {
        $user["userID"] = $userID;
        $user["userName"] = $userName;
        setSessionValue("user", $user);
    }
    
    // if the user is empty, then the username/password is invalid...
    if (count($user) == 0)
    {
        $response["error"] = "Invalid username or password.";
        return $response;
    }

    // login successful, return the user...
    $response["user"] = $user;
    $response["loggedIn"] = getSessionValue("user", "") != "";
    return $response;
}

//-----------Dillon Refactor AutoLogin after signup---------
function signUpLogin($conn)
{
    //Logs out current user
    setSessionValue("user", "");

    // Makes sure there is a userName and a password
    $userName = getValue("userName", "");
    if ($userName == "")
    {
        $response["error"] = "Username is required when logging in user.";
        return $response;
    }
    $userPass = getValue("userPassword", "");
    if ($userPass == "")
    {
        $response["error"] = "Password is required when logging in user.";
        return $response;
    }

    // Selects user id and password from the database
    $stmt = $conn->prepare("SELECT US_ID, US_PASSWORD FROM USERS WHERE US_USERNAME = ?");
    $stmt->bind_param("s", $userName);
    $stmt->execute();
    $stmt->bind_result($userID, $hashPassword);
    
    $user = array();
    if ($stmt->fetch()) 
    {
        if (password_verify($userPass, $hashPassword))
        {
            $user["userID"] = $userID;
            $user["userName"] = $userName;
            setSessionValue("user", $user);
        }
    }
    
    // if the user is empty, then the username/password is invalid...
    if (count($user) == 0)
    {
        $response["error"] = "Invalid username or password.";
        return $response;
    }

    // login successful, return the user...
    $response["user"] = $user;
    $response["loggedIn"] = getSessionValue("user", "") != "";
    return $response;
}

//-----------Lindsey SM2 Display Languages---------
function displayLanguages($conn)
{
    $s = "SELECT LANGUAGES.LN_ID,LANGUAGES.LN_NAME 
          FROM LANGUAGES 
          ORDER BY LANGUAGES.LN_NAME";  
    $stmt = $conn->prepare($s);
    $stmt->execute();
    $stmt->bind_result($langID,$lang);
    
    $rows = array();
    while($stmt->fetch())
    {
        $row = array("LanguageID"=>$langID, "Language"=>$lang,"status"=>"OK");
        $rows[] = $row;
    }
    return $rows;
}
//----------- Somwang SM3 Update Snippet ---------
function updateSnippet($conn)
{
    $id = getValue("id","");
    $language = getValue("t3","");
    $description = getValue("description","");
    $codeAdd = getValue("code","");
    
    $s = "UPDATE SNIPPETS SET LN_ID=?, SNP_DESCRIPTION=?, SNP_CODE=? WHERE SNP_ID=?";
    $stmt = $conn->prepare($s);
    $stmt->bind_param("issi", $language, $description, $codeAdd,$id);
    
    if(!$stmt->execute()) 
    {
        return array(array("error"=>"An Unknown Error has occured.","status"=>"Error"));
    }
    else
    {
        return filter($conn);
    }        
}

?>