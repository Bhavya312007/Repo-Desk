     </div>
    </div>
    <script src="libs/js/jquery.min.js"></script>
  <script src="libs/js/bootstrap.min.js"></script>
  <script src="libs/js/bootstrap-datepicker.min.js"></script>
  <script type="text/javascript" src="libs/js/functions.js"></script>
  </body>
  <script>
    Array.from(document.querySelectorAll("a.btn-danger")).map(
      delete1=>delete1.addEventListener('click',function(e){
      e.preventDefault();

      const redirectURL = delete1.getAttribute('href');

      float_window(
        'Do you really want to delete this record?'
      ,['Yes','No']
      ,[
        ()=>{
          window.location.href=redirectURL;
          // console.log(redirectURL);
        }
        ,()=>{}]);
      console.log('one');
    }))
    // console.log(document.querySelectorAll(".btn-danger"));
    // console.log('one');
  </script>
</html>

<?php if(isset($db)) { $db->db_disconnect(); } ?>
