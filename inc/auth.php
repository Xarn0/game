<?php 
session_start();
require_once '../sys/connect.php';

         $userAuto = $_POST['name'];
         $userPass = $_POST['passr'];
        
                      $query = $dbh->prepare('SELECT COUNT(*) FROM `users` WHERE `nick` = :nick AND `password` = :password');
                      $query->execute(['nick' => $userAuto,
                                       'password' => md5($userPass) ]);
                      $queryRow = $query->fetchColumn(); 
                      if($queryRow == 1)
                      {
                       header('Location: ./pages/shop.php'); 
                        exit();
                      }
                      else if($queryRow == 0){
                        $_SESSION['rega'] = 'Логин или пароль неверный';
                        // header('Location: ../index.php'); 
                      }
                                        
?>
 