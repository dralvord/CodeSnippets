import json
import requests

##Make sure you make your app public Window->Share

#urlPage = 'https://se-testbed-mclacs.c9users.io/CSCI452-FA18-Public' 
urlPage = "https://software-engineer-fluffy2.c9users.io/CSCI452-FA18-Public"

ssnOne = requests.Session()
sampleFunction = "cmd=createSnippet"
#====================== Dillon SM1 - Create user account ======================
print '\n----------------------------------------------------------'    
print '***              CREATE USER ACCOUNT Tyler             ***'
print '----------------------------------------------------------'
cmd = "cmd=create"
parameter = "&userName=Tyler&userPassword=password&userQUE1=Test?&userQUE1ANS=Test&userQUE2=Test&userQUE2ANS=Test";
url = urlPage + "/Server/snippet.php?" + cmd + parameter

req = ssnOne.get(url)
j = req.json()
print j

if j["status"]== "OK":
    print "\t\t============"
    print "\t\t| Success! |"
    print "\t\t============"
else:
    print "\t\t============"
    print "\t\t|   Fail!  |"
    print "\t\t============"   
# ------------------------------------------------------ #
cmd = "cmd=login"
parameter = "&userNameLogin=Tyler&userPasswordLogin=password";
url = urlPage + "/Server/snippet.php?" + cmd + parameter

req = ssnOne.get(url)
j = req.json()
print j
# ------------------------------------------------------ #
cd = ("for letter in \"Python\":\n"
    "  print letter\n"
    "  %23 will print each letter in the word \"Python\"\n"
)

parameter = "&t2=3&description=Foreach Loop&code=" + cd;

url = urlPage + '/Server/snippet.php?' + sampleFunction + parameter
req = ssnOne.get(url)
j = req.json()
# print j

if j[0]["status"]== "OK":
    print "\tTyler - Python - Foreach Loop: Success!"
else:
    print "\tTyler - Python - Foreach Loop: Fail!"
# ------------------------------------------------------ #
cd = ("$(document).ready(function()\n"
"{\n"
	"  $(\"%23showHideQ1\").click(function()\n"
		"  {\n"
			"    var passwordField = $(\"%23userQ1ANSReset\");\n"
			"    var passwordFieldType = passwordField.attr(\"type\");\n"
			"    if(passwordFieldType == \"password\")\n"
			"    {\n"
				"      passwordField.attr(\"type\", \"text\");\n"
				"      $(this).text(\"Hide\");\n"
			"    }\n"
			"    else\n"
			"    {\n"
				"    passwordField.attr(\"type\", \"password\"); \n"
				"    $(this).text(\"Show\");\n"
			"   }\n"
		"  });\n"
"});\n"
)

parameter = "&t2=10&description=Hide/Show Password&code=" + cd;

url = urlPage + '/Server/snippet.php?' + sampleFunction + parameter
req = ssnOne.get(url)
j = req.json()
# print j

if j[0]["status"]== "OK":
    print "\tTyler - JQuery - Hide/Show Password: Success!"
else:
    print "\tTyler - JQuery - Hide/Show Password: Fail!"    
    
print '\n----------------------------------------------------------'    
print '***              CREATE USER ACCOUNT Lindsey             ***'
print '----------------------------------------------------------'
cmd = "cmd=create"
parameter = "&userName=Lindsey&userPassword=password&userQUE1=Test?&userQUE1ANS=Test&userQUE2=Test&userQUE2ANS=Test";
url = urlPage + '/Server/snippet.php?' + cmd + parameter

req = ssnOne.get(url)
j = req.json()
print j

if j["status"]== "OK":
    print "\t\t============"
    print "\t\t| Success! |"
    print "\t\t============"
else:
    print "\t\t============"
    print "\t\t|   Fail!  |"
    print "\t\t============"   
# ------------------------------------------------------ #
cmd = "cmd=login"
parameter = "&userNameLogin=Lindsey&userPasswordLogin=password";
url = urlPage + "/Server/snippet.php?" + cmd + parameter

req = ssnOne.get(url)
j = req.json()
print j
# ------------------------------------------------------ #
cd = ("th {\n"
    "color: white;\n"
    "text-shadow: 1px 1px 2px black, 0 0 5px %2351bcc8, 0 0 5px darkblue;\n"
    "text-align: center;\n"
    "font-size: 1.7rem;\n"
    "background-color: %235bc0de;\n"
"}\n"
)

parameter = "&t2=11&description=Format table Header&code=" + cd;

url = urlPage + '/Server/snippet.php?' + sampleFunction + parameter
req = ssnOne.get(url)
j = req.json()
# print j

if j[0]["status"]== "OK":
    print "\tLindsey - CSS - Format table Header: Success!"
else:
    print "\tLindsey - CSS - Format table Header: Fail!"
# ------------------------------------------------------ #
cd = ("function displayLanguages($conn)\n"
"{\n"
    "  $s = \"SELECT LANGUAGES.LN_ID,LANGUAGES.LN_NAME \n"
    "        FROM LANGUAGES \n"
    "        ORDER BY LANGUAGES.LN_NAME\";  \n"
    "  $stmt = $conn->prepare($s);\n"
    "  $stmt->execute();\n"
    "  $stmt->bind_result($langID,$lang);\n"
    
    "  $rows = array();\n"
    "  while($stmt->fetch())\n"
    "  {\n"
        "    $row = array(\"LanguageID\"=>$langID, \"Language\"=>$lang);\n"
        "    $rows[] = $row;\n"
    "  }\n"
    "  return $rows;\n"
"}\n"
)

parameter = "&t2=5&description=Return Data From MySQL Database&code=" + cd;

url = urlPage + '/Server/snippet.php?' + sampleFunction + parameter
req = ssnOne.get(url)
j = req.json()
# print j

if j[0]["status"]== "OK":
    print "\tLindsey - PHP - Return Data From MySQL Database: Success!"
else:
    print "\tLindsey - PHP - Return Data From MySQL Database: Fail!"

print '\n----------------------------------------------------------'    
print '***              CREATE USER ACCOUNT Somwang             ***'
print '----------------------------------------------------------'
cmd = "cmd=create"
parameter = "&userName=Somwang&userPassword=password&userQUE1=Test?&userQUE1ANS=Test&userQUE2=Test&userQUE2ANS=Test";
url = urlPage + '/Server/snippet.php?' + cmd + parameter

req = ssnOne.get(url)
j = req.json()
print j

if j["status"]== "OK":
    print "\t\t============"
    print "\t\t| Success! |"
    print "\t\t============"
else:
    print "\t\t============"
    print "\t\t|   Fail!  |"
    print "\t\t============"   
# ------------------------------------------------------ #
cmd = "cmd=login"
parameter = "&userNameLogin=Somwang&userPasswordLogin=password";
url = urlPage + "/Server/snippet.php?" + cmd + parameter

req = ssnOne.get(url)
j = req.json()
print j
# ------------------------------------------------------ #
cd = ("import java.util.*\n"
"public class List\n"
"{\n"  
  "  public static void main(String args[])\n"
  "  {  \n"
    "    ArrayList<String> list = new ArrayList<String>();  \n"
    "    list.add(\"Item 1\");  \n"
    "    list.add(\"Item 2\");  \n"
    "    list.add(\"Item 3\");\n"
  "  }\n"
");")
parameter = "&t2=2&description=Adding Items to a List&code=" + cd;

url = urlPage + '/Server/snippet.php?' + sampleFunction + parameter
req = ssnOne.get(url)
j = req.json()
# print j

if j[0]["status"]== "OK":
    print "\tSomwang - Java - Adding Items to a List: Success!"
else:
    print "\tSomwang - Java - Adding Items to a List: Fail!"
# ------------------------------------------------------ #
cd = ("public static void main (String[] args)\n"
"{\n"
    "  int a = 10;\n"
    "  int b = 5;\n"
    "  int c = 0;\n"
    
    "  c = add(a,b);\n"
    
   "  System.out.println(c); // will print 15\n"
"}\n"
"public static int add(int a, int b)\n"
"{\n"
    "  int total = a + b;\n"
    
    "  return total;\n"
"}\n"
)

parameter = "&t2=2&description=Writing and Calling a Function&code=" + cd;

url = urlPage + '/Server/snippet.php?' + sampleFunction + parameter
req = ssnOne.get(url)
j = req.json()
# print j

if j[0]["status"]== "OK":
    print "\tSomwang - Java - Writing and Calling a Function: Success!"
else:
    print "\tSomwang - Java - Writing and Calling a Function: Fail!"
# ------------------------------------------------------ #
cd = ("function sendCommand(cmd)\n"
"{\n"
    "  var url = \"../Server/snippet.php?cmd=\"+cmd;\n"
    "  var request = $.post(url,model.filter);\n"
    "  request.done(function(json)\n"
    "  {\n"
        "    console.log(json);\n"
        "    model.data = json;\n"
        "    updateView();\n"
    "  });\n"
    "  request.fail(function(jqXHR, textStatus, errorThrown)\n"
    "  {\n"
        "    $(\"%23message\").text(textStatus);\n"
        "    console.log(\"fail object\", jqXHR);\n"
        "    console.log(\"error thrown\", errorThrown);\n"
        "    updateView();\n"
    "  });\n"
"}\n"
)

parameter = "&t2=12&description=Calling PHP function&code=" + cd;

url = urlPage + '/Server/snippet.php?' + sampleFunction + parameter
req = ssnOne.get(url)
j = req.json()
# print j

if j[0]["status"]== "OK":
    print "\tSomwang - AJAX - Calling PHP function: Success!"
else:
    print "\tSomwang - AJAX - Calling PHP function: Fail!"
    
print '\n----------------------------------------------------------'    
print '***              CREATE USER ACCOUNT Dillon            ***'
print '----------------------------------------------------------'
cmd = "cmd=create"
parameter = "&userName=Dillon&userPassword=password&userQUE1=Test?&userQUE1ANS=Test&userQUE2=Test&userQUE2ANS=Test";
url = urlPage + '/Server/snippet.php?' + cmd + parameter

req = ssnOne.get(url)
j = req.json()
print j

if j["status"]== "OK":
    print "\t\t============"
    print "\t\t| Success! |"
    print "\t\t============"
else:
    print "\t\t============"
    print "\t\t|   Fail!  |"
    print "\t\t============"       
# ------------------------------------------------------ #
cmd = "cmd=login"
parameter = "&userNameLogin=Dillon&userPasswordLogin=password";
url = urlPage + "/Server/snippet.php?" + cmd + parameter

req = ssnOne.get(url)
j = req.json()
print j    
# ------------------------------------------------------ #
cd = ("cout \"Hello World\";")
parameter = "&t2=4&description=Hello World&code=" + cd;

url = urlPage + '/Server/snippet.php?' + sampleFunction + parameter
req = ssnOne.get(url)
j = req.json()
# print j

if j[0]["status"]== "OK":
    print "\tDillon - C++ - Hello World: Success!"
else:
    print "\tDillon - C++ - Hello World: Fail!"

cd = ("for(String s : list)\n"
  "{ \n"
    "     //for each string in list, string will print\n"
    "     System.out.println(s);  \n"
  "}\n"
)
# ------------------------------------------------------ #
parameter = "&t2=2&description=Foreach Loop&code=" + cd;

url = urlPage + '/Server/snippet.php?' + sampleFunction + parameter
req = ssnOne.get(url)
j = req.json()
# print j

if j[0]["status"]== "OK":
    print "\tDillon - Java - Foreach Loop: Success!"
else:
    print "\tDillon - Java - Foreach Loop: Fail!"
# ------------------------------------------------------ #
cd = ("import json\n"
"import requests\n"
"\n"
"urlPage = \"https://software-engineer.c9users.io/CSCI452-FA18\"\n"
"ssnOne = requests.Session()\n"
"\n"
"cmd = \"cmd=create\"\n"
"parameter = \"%26userName=Tyler%26userPassword=password\";\n"
"url = urlPage %2B \"/Server/snippet.php?\" %2B cmd %2B parameter\n"
"\n"
"req = ssnOne.get(url)\n"
"j = req.json()\n"
"\n"
"if j[\"status\"]== \"OK\":\n"
    "  print \"Success!\"\n"
"else:\n"
    "  print \"Fail!\"\n"
)

parameter = "&t2=3&description=Create User Accounts&code=" + cd;

url = urlPage + '/Server/snippet.php?' + sampleFunction + parameter
req = ssnOne.get(url)
j = req.json()
# print j

if j[0]["status"]== "OK":
    print "\tDillon - Python - Create User Accounts: Success!"
else:
    print "\tDillon - Python - Create User Accounts: Fail!"    
# ------------------------------------------------------ #
cd = ("Delete Me!")

parameter = "&t2=3&description=For testing Delete Script&code=" + cd;

url = urlPage + '/Server/snippet.php?' + sampleFunction + parameter
req = ssnOne.get(url)
j = req.json()

if j[0]["status"]== "OK":
    print "\tDillon - Python - For testing Delete Script: Success!"
else:
    print "\tDillon - Python - For testing Delete Script: Fail!"
# ==========================================================================
#                   Stat the tests
# ==========================================================================
#====================== Somwang SM3 - Delete Snippet ======================
print '\n----------------------------------------------------------'    
print '***           Starting test #1 - deleteSnippet         ***'
print '----------------------------------------------------------'

cmd = "cmd=deleteSnippet"

parameter = "&snippetID=11";
url = urlPage + '/Server/snippet.php?' + cmd + parameter

req = ssnOne.get(url)
j = req.json()
# print j

if j[0]["status"] == "Error":
    print "\t\t============"
    print "\t\t|   Fail!  |"
    print "\t\t============"
else:
    print "\t\t============"
    print "\t\t| Success! |"
    print "\t\t============"    
#====================== Somwang VS2 - filter and sort ======================
print '----------------------------------------------------'
print '***  Starting test #2-filter without the filter  ***'
print '----------------------------------------------------'
test = "cmd=filter"
url = urlPage + '/Server/snippet.php?' + test
req = ssnOne.get(url)
j = req.json()
# print j

if      j[0]["SnippetID"] == 8 and j[0]["Creator"] == "Dillon" and j[0]["Language"] == "C++" and j[0]["Description"] == "Hello World"\
    and j[1]["SnippetID"] == 9 and j[1]["Creator"] == "Dillon" and j[1]["Language"] == "Java" and j[1]["Description"] == "Foreach Loop"\
    and j[2]["SnippetID"] == 10 and j[2]["Creator"] == "Dillon" and j[2]["Language"] == "Python" and j[2]["Description"] == "Create User Accounts"\
    and j[3]["SnippetID"] == 3 and j[3]["Creator"] == "Lindsey" and j[3]["Language"] == "CSS" and j[3]["Description"] == "Format table Header"\
    and j[4]["SnippetID"] == 4 and j[4]["Creator"] == "Lindsey" and j[4]["Language"] == "PHP" and j[4]["Description"] == "Return Data From MySQL Database"\
    and j[5]["SnippetID"] == 5 and j[5]["Creator"] == "Somwang" and j[5]["Language"] == "Java" and j[5]["Description"] == "Adding Items to a List"\
    and j[6]["SnippetID"] == 6 and j[6]["Creator"] == "Somwang" and j[6]["Language"] == "Java" and j[6]["Description"] == "Writing and Calling a Function"\
    and j[7]["SnippetID"] == 7 and j[7]["Creator"] == "Somwang" and j[7]["Language"] == "AJAX" and j[7]["Description"] == "Calling PHP function"\
    and j[8]["SnippetID"] == 1 and j[8]["Creator"] == "Tyler" and j[8]["Language"] == "Python" and j[8]["Description"] == "Foreach Loop"\
    and j[9]["SnippetID"] == 2 and j[9]["Creator"] == "Tyler" and j[9]["Language"] == "JQuery" and j[9]["Description"] == "Hide/Show Password"\
    :
    print "\t\t============"
    print "\t\t| Success! |"
    print "\t\t============"
else:
    print "\t\t============"
    print "\t\t|   Fail!  |"
    print "\t\t============"

#====================== Lindsey VS2 - filter and sort ======================
print '\n----------------------------------------------------'
print '*** Starting test #3-filter(Creator and Order By) ***'
print '----------------------------------------------------'
test = "cmd=filter"
parameter1 = "&Creator=Lindsey&OrderBy=USERS.US_USERNAME%20ASC"
url = urlPage + '/Server/snippet.php?' + test + parameter1

req = ssnOne.get(url)
j = req.json()
print j

if j[0]["SnippetID"] == 3 and j[0]["Creator"] == "Lindsey" and j[0]["Language"] == "CSS" and j[0]["Description"] == "Format table Header":
    print "\t\t============"
    print "\t\t| Success! |"
    print "\t\t============"
else:
    print "\t\t============"
    print "\t\t|   Fail!  |"
    print "\t\t============"

#====================== Lindsey VS2 - filter and sort ======================
print '\n----------------------------------------------------------'    
print '*** Starting test #4-filter (Description and Order By) ***'
print '----------------------------------------------------------'
test = "cmd=filter"
parameter2 = "&Description=Foreach Loop&OrderBy=USERS.US_USERNAME%20DESC"
url = urlPage + '/Server/snippet.php?' + test + parameter2

req = ssnOne.get(url)
j = req.json()
print j

if j[0]["SnippetID"] == 1 and j[0]["Creator"] == "Tyler" and j[0]["Language"] == "Python" and j[0]["Description"] == "Foreach Loop":
    print "\t\t============"
    print "\t\t| Success! |"
    print "\t\t============"
else:
    print "\t\t============"
    print "\t\t|   Fail!  |"
    print "\t\t============"

#======================Lindey VS2 - filter and sort ======================
print '\n----------------------------------------------------------'    
print '*** Starting test #5-filter (Description and Language) ***'
print '----------------------------------------------------------'
test = "cmd=filter"
parameter3 = "&Description=Foreach&t1=Python"
url = urlPage + '/Server/snippet.php?' + test + parameter3

req = ssnOne.get(url)
j = req.json()
print j

if j[0]["SnippetID"] == 1 and j[0]["Creator"] == "Tyler" and j[0]["Language"] == "Python" and j[0]["Description"] == "Foreach Loop":
    print "\t\t============"
    print "\t\t| Success! |"
    print "\t\t============"
else:
    print "\t\t============"
    print "\t\t|   Fail!  |"
    print "\t\t============"

#====================== Somwang UA1 - create new user account ======================
print '\n----------------------------------------------------------'    
print '*** Starting test #6-create (create a new user account) ***'
print '----------------------------------------------------------'
cmd = "cmd=create"
parameter = "&userName=sam5&userPassword=fooood&userQUE1=Where%20you%20were%20born?&userQUE1ANS=Thailand&userQUE2=pet%20name&userQUE2ANS=fluffy";
url = urlPage + '/Server/snippet.php?' + cmd + parameter

req = ssnOne.get(url)
j = req.json()
print j

if j["status"]== "OK":
    print "\t\t============"
    print "\t\t| Success! |"
    print "\t\t============"
else:
    print "\t\t============"
    print "\t\t|   Fail!  |"
    print "\t\t============"    

#====================== Dillon UA2 - pasword reset ======================
print '\n----------------------------------------------------------'    
print '*** Starting test #7-getUserData (returns user data) ***'
print '----------------------------------------------------------'
cmd = "cmd=getUserData"
parameter = "&userNamePSW=sam5";
url = urlPage + '/Server/snippet.php?' + cmd + parameter

req = ssnOne.get(url)
j = req.json()
print j

if j[0]["status"] == "true" and j[0]["UserMsg"] == "Found it":
    print "\t\t============"
    print "\t\t| Success! |"
    print "\t\t============"
else:
    print "\t\t============"
    print "\t\t|   Fail!  |"
    print "\t\t============"    

#====================== Dillon UA2 - password reset ======================
print '\n----------------------------------------------------------'    
print '*** Starting test #8-CheckSecurityAnswers (checks if security answers are correct) ***'
print '----------------------------------------------------------'
cmd = "cmd=checkSecurityAnswers"
parameter = "&userID=1&userQ1ANSReset=Test&userQ2ANSReset=Test&newPassword=password&newPassword2=password";
url = urlPage + '/Server/snippet.php?' + cmd + parameter

req = ssnOne.get(url)
j = req.json()
print j

if j["answers"] == "true" and j["Msg"] == "Success!":
    print "\t\t============"
    print "\t\t| Success! |"
    print "\t\t============"
else:
    print "\t\t============"
    print "\t\t|   Fail!  |"
    print "\t\t============"    
    
#====================== Somwang SM3 - update Snippet ======================
print '\n----------------------------------------------------------'    
print '***           Starting test #9 - updateSnippet         ***'
print '----------------------------------------------------------'
cmd = "cmd=updateSnippet"

cd = ("function clrSignupFrm()\n"
     "{\n"
     "     $(\"%23userName\").val(\"\");\n"
     "     $(\"%23userPassword\").val(\"\");\n"
     "     $(\"%23userQUE1\").val(\"\");\n"
     "}")    
    
parameter = "&id=8&t3=10&description=Clear text box&code=" + cd;
url = urlPage + '/Server/snippet.php?' + cmd + parameter

req = ssnOne.get(url)
j = req.json()
# print j

if j[0]["status"] == "Error":
    print "\t\t============"
    print "\t\t|   Fail!  |"
    print "\t\t============"
else:
    print "\t\t============"
    print "\t\t| Success! |"
    print "\t\t============"            
    
#---------------------------------Tyler - Display Languages-----------    
print '\n----------------------------------------------------------'    
print '***           Starting test #10 - displayLanguages      ***'
print '----------------------------------------------------------'
cmd = "cmd=displayLanguages"
url = urlPage + '/Server/snippet.php?' + cmd;

req=ssnOne.get(url)
j = req.json()
print j

if j[0]["status"]== "OK":
    print "\t\t============"
    print "\t\t| Success! |"
    print "\t\t============"
else:
    print "\t\t============"
    print "\t\t|   Fail!  |"
    print "\t\t============" 