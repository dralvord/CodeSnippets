import json
import requests

##Make sure you make your app public Window->Share

urlPage = 'https://se-testbed-mclacs.c9users.io/CSCI452-FA18-Public' 
#urlPage = 'https://software-engineer-fluffy2.c9users.io/CSCI452-FA18-Public'

#====================== Dillon SM1 - Create user account ======================
print '\n----------------------------------------------------------'    
print '***              CREATE USER ACCOUNT Tyler             ***'
print '----------------------------------------------------------'
cmd = "cmd=create"
parameter = "&userName=Tyler&userPassword=password&userQUE1=Test?&userQUE1ANS=Test&userQUE2=Test&userQUE2ANS=Test";
url = urlPage + '/Server/snippet.php?' + cmd + parameter

# start the sesssion...
ssnOne = requests.Session()

# make an HTTP request using the session...
req = ssnOne.get(url)
j = req.json() 
print j

# make another HTTP request using the same session...
req = ssnOne.get(url)
j = req.json() 
print j