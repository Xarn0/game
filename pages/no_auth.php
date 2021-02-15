<?php
require_once './sys/connect.php';

$errors = [];

if(isset[$_POST['ok']]){
    if(empty($_POST['userName'] && $_POST['password'] && $_POST['password2'])){
        $errors[] = 'Все поля обязательны для заполнения';
    }
    if($_POST['password'] != $_POST['password2']){
        $errors[] = 'Введённые пароли не совпадают';
    }
    $query = $connect->prepare('SELECT COUNT(*) FROM `users` WHERE `nick` = :nick AND `password` = :password');
    $query->execute(['nick' => $_POST['userName'],
                     'password' => md5($_POST['password']) ]);
    $data = $query->fetchColumn(); 
    if($data == 1){
        $_SESSION = $_POST['nick'];
        header('Location: ../pages/Shop.php'); 
    }else{
        echo 'Неверный логин или пароль';
    }
if(isset($_GET['regi']))
{
include_once 'inc/registration.php';
}
?>

         <form name="formReg" action="/?registration.php" method="POST">
                  <div>
                           <input type="name" placeholder="Ваше имя" name="userName" require maxlength="20"><br>
                           <input type="password" placeholder="Ваш пароль" name="password" minlength="8" require ><br>
                           <input type="password" placeholder="Ещё раз пароль" name="password2" minlength="8" require><br>
                          
                           <input type="submit" name="ok" value="Зарегистрироваться">
                           <button name="welcom">Уже есть Аккаунт</button>
                  </div>  

         </form>
         <form name='formWelcom'  method="POST" action="/?auth.php">
                  <div>
                           <input type="name" placeholder="Ваше имя" name="name" require maxlength="20"><br>
                           <input type="password" placeholder="Ваш пароль" name="passr" minlength="8" require ><br>  
                           <input type="submit" name="formWelcomSubmit" value="Войти"><br> 
                           <button name="Rega">Зарегистрироваться</button>
                  </div>   
                  <?php
                        if(isset($_SESSION['rega']))
                        {
                                echo "<p class='sucess msg '>$_SESSION[rega]</p>";
                                unset($_SESSION['rega']);
                        }
                       
                  ?>      
         </form>

<script>
                let pass =  document.forms[0].elements.password;
                let pass2 =  document.forms[0].elements.password2,
                user = document.forms[0].elements.userName;
                submit = document.forms[0].elements.ok;
                bool = true ;
                submit.addEventListener('click',(event)=>
                                                                {
                                                                        
                                                                        if(bool)
                                                                        {
                                                                                event.preventDefault();
                                                                        }
                                                                }
                                                                )
                   pass2.addEventListener('blur', (event)=>
                   {
                            setInterval(()=>
                            {                if(pass.value == pass2.value && pass.value != '' )
                                             {
                                                      
                                                        pass2.classList.remove('error');
                                                        pass2.classList.add('sucess'); 
                                                        if(user.value != '') {
                                                            bool = false;
                                                            submit.style.backgroundColor = "#4e67e2" ;   
                                                        }
                                                       
                                                        
                                             } 
                                             else if(pass.value == '' || pass2.value == '')
                                             {
                                                                pass2.classList.remove('error')  ; 
                                                                pass2.classList.remove('sucess');
                                             }
                                             else
                                             {  
                                                        
                                                        pass2.classList.add('error');
                                                        pass2.classList.remove('sucess');
                                                        bool = true
                                                        submit.style.backgroundColor = '#4e67e24d';  
                                                              
                                                                
                                                      

                                             } 
                                            
                           },100)
                        
                   })  ;
                   let welcom = document.forms[0].welcom;
                   console.log(welcom)
                   welcom.addEventListener('click',(event)=>{
                            event.preventDefault();
                            document.forms[0].style.display = 'none';
                            document.forms[1].style.display = 'block';
                   })  
                   let rega = document.forms[1].Rega;
                   rega.addEventListener('click',(event)=>{
                            event.preventDefault();
                            document.forms[1].style.display = 'none';
                            document.forms[0].style.display = 'block';
                   })  
             let check = true,
             formWelcomSubmit = document.forms[1].elements.formWelcomSubmit,
             nameWELCOM = document.forms[1].elements.name,
             passwordWELCOM = document.forms[1].elements.passr;
             formWelcomSubmit.addEventListener('click',(e)=>
             {
                     if(check)
                     {
                             e.preventDefault();
                             
                     }
                                                              
                     
                        
                   
                   
             });
              setInterval(()=>
              {  
                      if( nameWELCOM.value.length >= 7 && passwordWELCOM.value.length >= 8)
                        {
                                check = false;
                                formWelcomSubmit.style.backgroundColor = '#4e67e2';
                        }
                        else
                        {
                                check = true;
                                formWelcomSubmit.style.backgroundColor = '#4e67e24d';       
                        }
                },100)
             
                         
       
                   
</script>
</body>
</html>