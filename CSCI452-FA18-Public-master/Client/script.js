//---------- Tyler UA3 Hide/Show Passwords ---------------------------------
//----------------Question 1 Answer ----------------------------------------
$(document).ready(function()
{
	$("#showHideQ1").click(function()
		{
			var passwordField = $('#userQ1ANSReset');
			var passwordFieldType = passwordField.attr('type');
			if(passwordFieldType == 'password')
			{
				passwordField.attr('type', 'text');
				$(this).text('Hide');
			}
			else
			{
				passwordField.attr('type', 'password'); 
				$(this).text('Show');
			}
		});
});

//--------------------------------------------------------------------------
//----------------------Question 2 Answer----------------------------------- 	
$(document).ready(function()
{
	$("#showHideQ2").click(function()
		{
			var passwordField = $('#userQ2ANSReset');
			var passwordFieldType = passwordField.attr('type');
			if(passwordFieldType == 'password')
			{
				passwordField.attr('type', 'text');
				$(this).text('Hide');
			}
			else
			{
				passwordField.attr('type', 'password'); 
				$(this).text('Show');
			}
		});
});

//--------------------------------------------------------------------------
//-----------------------------Sign Up Password-----------------------------
$(document).ready(function()
{
	$("#showHideSignUpPw").click(function()
		{
			var passwordField = $('#userPassword');
			var passwordFieldType = passwordField.attr('type');
			if(passwordFieldType == 'password')
			{
				passwordField.attr('type', 'text');
				$(this).text('Hide');
			}
			else
			{
				passwordField.attr('type', 'password'); 
				$(this).text('Show');
			}
		});
});

//--------------------------------------------------------------------------
//-----------------------------Sign Up Q1-----------------------------------
$(document).ready(function()
{
	$("#showHideSignUpQ1").click(function()
		{
			var passwordField = $('#userQUE1ANS');
			var passwordFieldType = passwordField.attr('type');
			if(passwordFieldType == 'password')
			{
				passwordField.attr('type', 'text');
				$(this).text('Hide');
			}
			else
			{
				passwordField.attr('type', 'password'); 
				$(this).text('Show');
			}
		});
});

//--------------------------------------------------------------------------
//-----------------------------Sign Up Q2-----------------------------------
$(document).ready(function()
{
	$("#showHideSignUpQ2").click(function()
		{
			var passwordField = $('#userQUE2ANS');
			var passwordFieldType = passwordField.attr('type');
			if(passwordFieldType == 'password')
			{
				passwordField.attr('type', 'text');
				$(this).text('Hide');
			}
			else
			{
				passwordField.attr('type', 'password'); 
				$(this).text('Show');
			}
		});
});

//--------------------------------------------------------------------------
//-------------------------Password Reset-----------------------------------
$(document).ready(function()
{
	$("#showHideResetPw").click(function()
		{
			var passwordField = $('#newPassword');
			var passwordFieldType = passwordField.attr('type');
			var passwordField2 = $('#newPassword2')
			var passwordFieldType2 = passwordField2.attr('type');
			if(passwordFieldType == 'password')
			{
				passwordField.attr('type', 'text');
				passwordField2.attr('type', 'text');
				$(this).text('Hide');
			}
			else
			{
				passwordField.attr('type', 'password'); 
				passwordField2.attr('type', 'password');
				$(this).text('Show');
			}
		});
});
//------------------------------------------------------------------------
//------------------------------Login Password---------------------------
$(document).ready(function()
{
	$("#showHideLogin").click(function()
		{
			var passwordField = $('#userPasswordLogin');
			var passwordFieldType = passwordField.attr('type');
			if(passwordFieldType == 'password')
			{
				passwordField.attr('type', 'text');
				$(this).text('Hide');
			}
			else
			{
				passwordField.attr('type', 'password'); 
				$(this).text('Show');
			}
		});
});