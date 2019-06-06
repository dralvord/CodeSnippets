//==================================================================================//
//							Model                                                   //
//==================================================================================//

var model = [];//Store Snippet list
var modelCre = [];//Store value from create function
var modelUsr = null;//Store value from getSecurityQuestions function
var modelChk = null;//store value from checkSecurityAnswers function
var modelLogin = null;//store value from login, logout, pwResetLogin and signUpLogin function
var modelLanguage = [];//store value from displayLanguages function

var ifLogin = false;
var usrID = 0; //user id if log in
var snip = false;

// ---- for Code Dialog ---- //
var cds = "";
var tit = "";
var dialog = false;
			
//==================================================================================//
//							View                                                    //
//==================================================================================//
function updateView()
{
    $("#message").html("<div style = color:red>" + "");
    $("#TableBody").empty();

    if (model.error != undefined)
    {
        $("#message").html("<div style = color:red>" + model.error);
    }
    else if(model.data.length<1)
    {
        $("#message").html("<div style = color:red>" + "There are currently no Snippets. Please create one!");
    }
    else
    {
        displayData();
    }
    // -----------------------------------------------------------------//
    if(model.filter == "Creator=&Language=&Description=&SortBy=USERS.US_USERNAME&SOpt=ASC&OrderBy=USERS.US_USERNAME+ASC")
    { //Checks to see if the filter settings are clear.
        clearFilterForm(); 
    }
    // -----------------------------------------------------------------//
    if (dialog===true)
    {
        DialogView();
        dialog = false;
    }    
    if (snip===true)
    {
        clrSnippetsFrm();
        snip = false;
    }
    // -----------------------------------------------------------------//
    //                  For signup form                                 //
    // -----------------------------------------------------------------//
    
    if (modelCre.status == "Error" )
    {
        $("#signUpMsg").html("<div style = color:red>" + modelCre.createMsg);
    }
    else if (modelCre.status == "OK" )
    {
        $("#signUpMsg").html("<div style = color:blue>" + modelCre.createMsg);
        clrSignupFrm();
    }
}

/* ----------------------------------------- */
/* ----------------------------------------- */
function updatePasswordResetView()
{
    $("#passwordResetMsg").html("<div style = color:blue>" + "");
    $("#checkUserNameBtn").show();
    
    if (modelUsr && modelUsr[0].status == "false")
    {
        $("#passwordResetMsg").html("<div style = color:red>" + modelUsr[0].UserMsg);
        $("#securityQuestionReset").hide();
    }
    else if (modelUsr && modelUsr[0].status == "true")
    {
        $("#checkUserNameBtn").hide();
        $("#userID").val(modelUsr[0].UserID);
        $("#securityQuestionReset").show(1000);
        $("#userQ1Reset").text(modelUsr[0].Q1);
        $("#userQ2Reset").text(modelUsr[0].Q2);
        $("#passwordResetMsg").html("<div style = color:red>" + "");
    }
    /* --------- checking for security answers ---------*/
    if (modelChk && modelChk.answers == "false")
    {
        $("#passwordResetMsg").html("<div style = color:red>" + modelChk.Msg);
    }
    else if (modelChk && modelChk.answers == "true")
    {
        $("#passwordResetFormModal").hide();
        sendCommandAutoLogin("pwResetLogin");
    }    
}

/* ----------------------------------------- */
/* ----------------------------------------- */
function updateLoginView()
{
    if (modelLogin.error != undefined)
    {
         $("#loginMsg").html("<div style = color:red>" + modelLogin.error);
    }
    else 
    {
        ifLogin = true;
        usrID = modelLogin["user"].userID;
        
        $("#displaySignup").hide();
        $("#displayLogin").hide();
        $("#loginName").text("Hello " + modelLogin["user"].userName);
        $("#loginModal").hide();
        $("#logoutMenu").show();
        $("#loginName").show();
        displayData();
    }
}

/* ----------------------------------------- */
/* ----------------------------------------- */
function updateLogoutView()
{
    if (modelLogin.error != undefined)
    {
         alert(modelLogin.error);
    }
    else 
    {
        ifLogin = false;
        usrID = 0;
        
        $("#displaySignup").show();
        $("#displayLogin").show();
        $("#logoutMenu").hide();
        $("#loginName").hide();
        location.reload(true);
    }
}
//==================================================================================//
//							Controller                                              //
//==================================================================================//
$(document).ready(function ()
{
    sendCommandGetLanguage("displayLanguages");

    $("#OrderBy").val($('input[name=SortBy]:checked', '#filterSortForm').val() + " " +
    	$('input[name=SOpt]:checked', '#filterSortForm').val());
    	
	model.filter=$("#filterSortForm" ).serialize();	//Stores the filter settings in the model
	$("#filterSortForm").hide();
	$("#logoutMenu").hide();
	$("#loginName").hide();
	$("#SnippetForm").hide();
	$("#editSnippetForm").hide();
	$("#deleteSnippetForm").hide();
	sendCommand("filter");
});

$(document).on("click", ".codeBtn", function()
{
	cds = $(this).attr("cd");
	tit = $(this).attr("desc");
    dialog = true;
    sendCommand("filter");
});

$("#clrfilterBtn").click(function ()
{
    model.filter = "Creator=&Language=&Description=&SortBy=USERS.US_USERNAME&SOpt=ASC&OrderBy=USERS.US_USERNAME+ASC"; //Clears the model for the filter

    sendCommand("filter");
     $("#filterDropdown").val(1);
     $("#t1").val("");
});  

$("#displayFilterBtn").click(function()
{
	$("#filterSortForm").toggle(1000);
});

$("#displaySignup").click(function()
{
    $('#signupModal').modal('show');
    $("#signUpMsg").html("<div style = color:red>" + "");
});

$("#displaySignup2").click(function()
{
    $('#signupModal').modal('show');
    $("#signUpMsg").html("<div style = color:red>" + "");
});

$("#displayLogin").click(function()
{
    $('#loginModal').modal('show');
    $("#loginMsg").html("<div style = color:red>" + "");
});

$("#signUpBtn").click(function()
{
    sendCommandUser("create");
});

$("#loginBtn").click(function()
{
    sendCommandLogin("login");
});

$("#logoutMenu").click(function()
{
    sendCommandLogout("logout");
});

$("#displayNewSnippetFormMenu").click(function()
{
    if (ifLogin === true)
    {
        $("#SnippetForm").toggle(1000);
    }
    else
    {
        alert("Please login");
        $('#loginModal').modal('show');
        $("#loginMsg").html("<div style = colors:red>" + "");        
    }
});

$("#newSnippetBtn").click(function()
{
    if($('#newSnippetDropdown').val()==1 || 
        $('#descriptionAdd').val().trim()=="" || 
        $('#codeAdd').val().trim()=="")
    {
        alert("All fields are required");
    }
    else 
    {
        snip = true;
        sendCommandCreateNewSnippet("createSnippet");
        $("#newSnippetDropdown").val(1);        
    }
});

$("#displayPasswordReset").click(function()
{
    clrPasswordResetFrm();
    $("#checkUserNameBtn").show();
    $('#passwordResetFormModal').modal('show');
    $("#passwordResetMsg").html("<div style = color:red>" + "");
    $("#securityQuestionReset").hide();
});

$("#checkUserNameBtn").click(function()
{
    sendCommandUserDetail("getUserData");
});

$("#checkAnsBtn").click(function()
{
    sendCommandCheckAns("checkSecurityAnswers");
});

$(document).on("click", ".delBtn", function()
{   
    model.snippetID = $(this).attr("id");
    confirmalert();
});

$(document).on("click", ".displayEditForm", function()
{
    $("#SnippetForm").hide();
    model.snippetID = $(this).attr("id");
    
    $("#descriptionEdit").val($(this).attr("desc"));
    $("#codeEdit").val($(this).attr("cd"));
    $("#editDropdown").val($(this).attr("lang"));
    $("#t3").val($(this).attr("lang"));

    $("#editSnippetForm").show();
});

$("#editBtn").click(function()
{
    sendCommandUpdate("updateSnippet");
    $("#editSnippetForm").toggle(1000);
});

$('#languageAdd').change(function()
{
    var t = $('#languageAdd :selected').val();
    $("#t2").val(t);
});

$('#languageEdit').change(function()
{
    var t = $('#languageEdit :selected').val();
    $("#t3").val(t);
});

// ----------- Auto refresh --------------------
$('#Creator').keyup(function()
{
    autoRefresh(); 
});

$('#Language').keyup(function()
{
    autoRefresh(); 
});

$('#Description').keyup(function()
{
    autoRefresh(); 
});

$('#Language').change(function()
{
    var t = $('#Language :selected').text();
    $("#t1").val(t);
    autoRefresh();
});

$('#SortBy1').change(function()
{
    autoRefresh();
});
$('#SortBy2').change(function()
{
    autoRefresh();
});
$('#SortBy3').change(function()
{
    autoRefresh();
});
$('#SOpt1').change(function()
{
    autoRefresh();
});
$('#SOpt2').change(function()
{
    autoRefresh();
});
/*------------------------------------------------------*/
/*          Connect to php functions                    */
/*------------------------------------------------------*/
function sendCommand(cmd)
{
    var url = "../Server/snippet.php?cmd="+cmd;
    var request = $.post(url,model.filter);
    request.done(function(json)
    {
        console.log(json);
        model.data = json;
        updateView();
    });
    request.fail(function(jqXHR, textStatus, errorThrown)
    {
        $("#message").text(textStatus);
        console.log("fail object ", jqXHR);
        console.log("error thrown ", errorThrown);
        updateView();
    });
}

function sendCommandUser(cmd)
{
    var url = "../Server/snippet.php?cmd="+cmd;
    var data = $("#signUpForm" ).serialize();
    var request = $.post(url,data);
    request.done(function(json)
    {
      	console.log(json);
        modelCre = json;
        modelCre.formData = data;
        sendCommandSignUpLogin("signUpLogin");
        updateView();
    });
    request.fail(function(jqXHR, textStatus, errorThrown)
    {
        $("#signUpMsg").text(textStatus);
        console.log("fail object ", jqXHR);
        console.log("error thrown ", errorThrown);
        updateView();
    });
}

function sendCommandUserDetail(cmd)
{
    var url = "../Server/snippet.php?cmd="+cmd;
    var data = $("#passwordResetForm" ).serialize();
    var request = $.post(url,data);
    request.done(function(json)
    {
      	console.log(json);
        modelUsr = json;
        updatePasswordResetView();
    });
    request.fail(function(jqXHR, textStatus, errorThrown)
    {
        $("#passwordResetMsg").text(textStatus);
        console.log("fail object ", jqXHR);
        console.log("error thrown ", errorThrown);
        updatePasswordResetView();
    });
}

function sendCommandCheckAns(cmd)
{
    var url = "../Server/snippet.php?cmd="+cmd;
    var data = $("#securityQuestionReset" ).serialize();
    var request = $.post(url,data);
    request.done(function(json)
    {
      	console.log(json);
        modelChk = json;
        updatePasswordResetView();
    });
    request.fail(function(jqXHR, textStatus, errorThrown)
    {
        $("#passwordResetMsg").text(textStatus);
        console.log("fail object ", jqXHR);
        console.log("error thrown ", errorThrown);
        updatePasswordResetView();
    });
}

function sendCommandLogin(cmd)
{
    var url = "../Server/snippet.php?cmd="+cmd;
    var data = $("#loginForm" ).serialize();
    var request = $.post(url,data);
    request.done(function(json)
    {
      	console.log(json);
        modelLogin = json;
        updateLoginView();
    });
    request.fail(function(jqXHR, textStatus, errorThrown)
    {
        $("#loginMsg").text(textStatus);
        console.log("fail object ", jqXHR);
        console.log("error thrown ", errorThrown);
        updateLoginView();
    });
}

function sendCommandLogout(cmd)
{
    var url = "../Server/snippet.php?cmd="+cmd;
    var request = $.post(url);
    request.done(function(json)
    {
      	console.log(json);
        modelLogin = json;
        updateLogoutView();
    });
    request.fail(function(jqXHR, textStatus, errorThrown)
    {
        $("#loginMsg").text(textStatus);
        console.log("fail object ", jqXHR);
        console.log("error thrown ", errorThrown);
        updateLogoutView();
    });
}

function sendCommandAutoLogin(cmd)
{
    var url = "../Server/snippet.php?cmd="+cmd;
    var data = $("#passwordResetForm" ).serialize();;
    var request = $.post(url,data);
    request.done(function(json)
    {
      	console.log(json);
        modelLogin = json;
        updateLoginView();
    });
    request.fail(function(jqXHR, textStatus, errorThrown)
    {
        console.log("fail object ", jqXHR);
        console.log("error thrown ", errorThrown);
        updateLoginView();
    });
}

function sendCommandSignUpLogin(cmd)
{
    var url = "../Server/snippet.php?cmd="+cmd;
    var request = $.post(url,modelCre.formData);
    request.done(function(json)
    {
      	console.log(json);
        modelLogin = json;
        updateLoginView();
    });
    request.fail(function(jqXHR, textStatus, errorThrown)
    {
        $("#loginMsg").text(textStatus);
        console.log("fail object ", jqXHR);
        console.log("error thrown ", errorThrown);
        updateLoginView();
    });
}

function sendCommandCreateNewSnippet(cmd)
{
    var url = "../Server/snippet.php?cmd="+cmd;
    var data = $("#SnippetForm" ).serialize();
    var request = $.post(url,data);    
    request.done(function(json)
    {
      	console.log(json);
        model.data = json;
        updateView();
    });
    request.fail(function(jqXHR, textStatus, errorThrown)
    {
        $("#newSnippetMsg").text(textStatus);
        console.log("fail object ", jqXHR);
        console.log("error thrown ", errorThrown);
        updateView();
    });
}
function sendCommandGetLanguage(cmd)
{
    var url = "../Server/snippet.php?cmd="+cmd;
    var request = $.post(url);
    request.done(function(json)
    {
      	console.log(json);
        modelLanguage = json;
        loadLanguage();
    });
    request.fail(function(jqXHR, textStatus, errorThrown)
    {
        console.log("fail object ", jqXHR);
        console.log("error thrown ", errorThrown);
        loadLanguage();
    });
}
function sendCommandDelete(cmd)
{
    var url = "../Server/snippet.php?cmd="+cmd;
    var data = model.filter+"&snippetID=" + model.snippetID;
    var request = $.post(url,data);
    request.done(function(json)
    {
      	console.log(json);
        model.data = json;
        updateView();
    });
    request.fail(function(jqXHR, textStatus, errorThrown)
    {
        console.log("fail object ", jqXHR);
        console.log("error thrown ", errorThrown);
        updateView();
    });
}

function sendCommandUpdate(cmd)
{
    var url = "../Server/snippet.php?cmd="+cmd;
    var data = "&id=" + model.snippetID + "&" + $("#editSnippetForm" ).serialize();
    var request = $.post(url,data);
    request.done(function(json)
    {
      	console.log(json);
        model.data = json;
        updateView();
    });
    request.fail(function(jqXHR, textStatus, errorThrown)
    {
        console.log("fail object ", jqXHR);
        console.log("error thrown ", errorThrown);
        updateView();
    });
}

//==================================================================================//
//							Helper Functions                                        //
//==================================================================================//
/*------------------------------------------------------*/
/*          Display Delete Snippet Alert                */
/*------------------------------------------------------*/
function confirmalert()
{
    var userselection = confirm("Are you sure you want to delete this snippet?");
    if (userselection == true)
    {
        sendCommandDelete("deleteSnippet");
    }
}

/*------------------------------------------------------*/
/*          Display all data from the model             */
/*------------------------------------------------------*/
function displayData()
{
    $("#message").html("<div style = color:red>" + "");
    $("#TableBody").empty();
    
    for (var i in model.data)
    {
        var row = model.data[i];
        var id = row.SnippetID;
        var creatorID = row.CreatorID;
		$("#TableBody").append("<tr>"+
		"<td>"+row.Creator+"</td>"+
		"<td>"+row.Language+"</td>"+
		"<td>"+row.Description+"</td>"+
		"<td><a cd='"+row.Code +"' desc='"+row.Description 
		    +"' href='#' class='codeBtn btn-info btn-sm'>View</a>"+"  "+
		    (usrID==creatorID?
    		    "<a id='"+id+"'cd='"+row.Code +"' desc='"+row.Description +"' lang='"+row.LangID
    		        +"' href='#' class='displayEditForm btn-info btn-sm'>Edit</a>"+"  "+	
        		"<a id='"+id 
        		    +"' href='#' class='delBtn btn-info btn-sm'>Delete</a>":"")+
		"</td>"+	
		"</tr>");
    }
}

/*------------------------------------------------------*/
/*            Display code in dialog                    */
/*------------------------------------------------------*/
function DialogView()
{
    $("#codeMsg").html("<pre><code>" + cds + "</code></pre>");
    $("#codeTit").html("<h4>" + tit + "</h4>");
    $('#viewCodeDlg').modal('show');
    $('pre code').each(function(i, block) 
    {
        hljs.highlightBlock(block);
    });
    
}
/*------------------------------------------------------*/
/*              fill out language drop down             */
/*------------------------------------------------------*/
function loadLanguage()
{
    var filt = $('<select id="filterDropdown" name="languageDN" class="form-control col-sm-9" style="width: 385px;" />');
    var addN = $('<select id="newSnippetDropdown" name="languageDN" class="form-control col-sm-9" />');
    var editN = $('<select id="editDropdown" name="languageDN" class="form-control col-sm-9" />');
    for(var i in modelLanguage)
    {
        var row = modelLanguage[i];
        $('<option />', {value: row.LanguageID, text: row.Language}).appendTo(filt);
        $('<option />', {value: row.LanguageID, text: row.Language}).appendTo(addN);
        $('<option />', {value: row.LanguageID, text: row.Language}).appendTo(editN);
    }
    filt.appendTo('#Language');   
    addN.appendTo('#languageAdd'); 
    editN.appendTo('#languageEdit'); 
}

/*------------------------------------------------------*/
/*              auto refresh for filter                 */
/*------------------------------------------------------*/
function autoRefresh()
{
    $("#OrderBy").val($('input[name=SortBy]:checked', '#filterSortForm').val() + " " +
    	$('input[name=SOpt]:checked', '#filterSortForm').val());
    	
	model.filter = $("#filterSortForm" ).serialize(); //Stores the filter settings in the model.	
	
	sendCommand("filter");      
}
/*------------------------------------------------------*/
/*   Clears the filter and sort settings in the form    */
/*------------------------------------------------------*/
function clearFilterForm()
{
	$("#Creator").val("");
    $("#Language").val("");
	$("#Description").val("");
	$("#OrderBy").val("USERS.US_USERNAME ASC");

	$("#SortBy1").prop("checked", true);
	$("#SOpt1").prop("checked", true);
}
/*-------------------------------------------------------*/
/*              clear signup form                        */
/*-------------------------------------------------------*/
function clrSignupFrm()
{
    $("#userName").val("");
    $("#userPassword").val("");
    $("#userQUE1").val("");
    $("#userQUE1ANS").val("");
    $("#userQUE2").val("");
    $("#userQUE2ANS").val("");
}
/*-------------------------------------------------------*/
/*              clear password reset form                */
/*-------------------------------------------------------*/
function clrPasswordResetFrm()
{
    $("#userNamePSW").val("");
    $("#newPassword").val("");
    $("#newPassword2").val("");
    $("#userQ1ANSReset").val("");
    $("#userQ2ANSReset").val("");
}
/*-------------------------------------------------------*/
/*              clear Snippets form                      */
/*-------------------------------------------------------*/
function clrSnippetsFrm()
{
    $("#languageAdd").val("");
    $("#descriptionAdd").val("");
    $("#codeAdd").val("");
}