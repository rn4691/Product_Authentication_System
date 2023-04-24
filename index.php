<!DOCTYPE html>
<html>
<head>
   <title>Verification Table</title>

   <!-- Meta -->
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
   <meta charset="utf-8">
   
</head>
<style>
@import url("https://fonts.googleapis.com/css?family=Lato:400,700");
/* #bg {
  /* background: url("bg_product.png"); 
  background-color: black;
  position: fixed;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  background-size: cover;
  filter: blur(5px);
} */

body{
   background: url("new_bg.jpg");
   height: 100%;
   background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  font-family: "Lato", sans-serif;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  margin: 0;
  padding: 0;
  display: flex;
  flex-direction: column;
  overflow: hidden;

}


/* body {
  font-family: "Lato", sans-serif;
  color: #4a4a4a;
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  overflow: hidden;
  margin: 0;
  padding: 0;
} */

form {
  width: 350px;
  position: relative;

}

.form-field {
   position: relative;
}
form.form-field:nth-child(1)::before {
  background-image: url('user-icon.png');
  width: 20px;
  height: 20px;
  top: 15px;
}


form .form-field:nth-child(2)::before {
   content: '';
  background-image: url('lock-icon.png');
  width: 16px;
  height: 16px;
}

form input {
  font-family: inherit;
  width: 100%;
  outline: none;
  background-color: #fff;
  border-radius: 4px;
  border: none;
  display: block;
  padding: 0.9rem 0.7rem;
  box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.16);
  font-size: 17px;
  color: #4a4a4a;
  text-indent: 40px;
}
#btn_search {
  outline: none;
  width: 100%;
  border: none;
  cursor: pointer;
  display: inline-block;
  margin: 0 auto;
  padding: 0.9rem 2.5rem;
  text-align: center;
  background-color: #47ab11;
  color: #fff;
  border-radius: 4px;
  box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.16);
  font-size: 17px;
  text-indent: 40px;

}


table, thead,th {
  border: 2px solid black;
  /* margin-top: 250px;
  margin-left: 800px; */
  background-color: lightblue;
  width:auto;
}
</style>
<body>

<!-- 
<form>
  <div class="form-field">
    <input type='text' id='email' name='email' placeholder='Enter email' required />
  </div>

  <div class="form-field">
    <input type='text' id='unique_code' name='unique_code' placeholder='Enter unique code' required />
  </div>

  <div class="form-field">
    <button class="btn" type="submit" value='Search' id='btn_search'>VERIFY</button>
  </div>
</form> -->

<form id="verify-form">

   <div class="form-field">
      <input type='number' id='unique_code' name='unique_code' placeholder='Enter unique code' required>

   <br />
   </div>
   <div class="form-field">
      <input type='email' id='email' name='email' placeholder='Enter email' required> 

   </div>
   <br />
   <input type='submit' value='Search' id='btn_search'>
   
</form>
<br />
   
   
   <!-- Table -->
   <table border='1' id='userTable' >
     <thead>
         <th>Unique ID</th>
         <th>Product Name</th>
         <th>Email</th>
         <th>Colour</th>
         <th>Size</th>
         <th>Country of maufacture</th>

     </thead>
     <tbody></tbody>
   </table>

   <!-- Script -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

   <script type='text/javascript'>

      // Search by userid
      $('#verify-form').submit(function(e){
         e.preventDefault()
         var unique_code = ($('#unique_code').val().trim());
         var email = ($('#email').val().trim());

         // if(unique_code > 0 && email.length > 0){

           // AJAX POST request
           $.ajax({
              url: 'ajaxfile.php',
              type: 'post',
              data:{request: 'fetchbyid',unique_code: unique_code, email: email},
              dataType: 'json',
              success: function(response){
                 createRows(response);
              }
           });
         // }

      });

      // Create table rows
      function createRows(response){
         var len = 0;
         $('#userTable tbody').empty(); // Empty <tbody>
         if(response != null){
            len = response.length;
         }
         
         if(len > 0){
         for(var i=0; i<len; i++){
            var unique_code = response[i].unique_code;
            var pname = response[i].pname;
            var email = response[i].email;
            var colour = response[i].colour;
            var size = response[i].size;
            var country = response[i].country;


            var tr_str = "<tr>" +
               "<td align='center'>" + unique_code + "</td>" +
               "<td align='center'>" + pname + "</td>" +
               "<td align='center'>" + email + "</td>" +
               "<td align='center'>" + colour + "</td>" +
               "<td align='center'>" + size + "</td>" +
               "<td align='center'>" + country + "</td>" +

            "</tr>";

            $("#userTable tbody").append(tr_str);
         }
         }else{
            var tr_str = "<tr>" +
            "<td align='center' colspan='7S'>No record found.</td>" +
            "</tr>";

            $("#userTable tbody").append(tr_str);
         }
      } 
   </script>
</body>
</html>