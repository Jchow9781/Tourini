<html>
   
   <head>
      <title>Sign up</title>
      
      <style type = "text/css">
         body {
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
         }
         
         label {
            font-weight:bold;
            width:100px;
            font-size:14px;
         }
         
         .box {
            border:#666666 solid 1px;
         }
      </style>
      
   </head>
   
   <body bgcolor = "#FFFFFF">
      <center><img src="https://i.gyazo.com/ef6a99447b5e67bb044a2df22bbb1622.png" alt="yourmom"> </center>
	
      <div align = "center">
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Create an account</b></div>
				
            <div style = "margin:30px">
             
              <!-- //Gets uname, pw, first/last name, and bio from user -->
               <form action = "createaccount.php" method = "post">
                  <label>Username:</label><input type = "text" name = "username" class = "box"/><br /><br />
                  <label>Password:</label><input type = "password" name = "password" class = "box" /><br/><br />
                  <label>First/Last Name:</label><input type = "text" name = "name" class = "box" /><br/><br />
                  <label>Short Decription:</label><input type = "text" name = "description" class = "box" /><br/><br />

                  <input type = "submit" value = " Submit "/><br />
               </form>


               <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
					
            </div>
				
         </div>
			
      </div>

   </body>
</html>		