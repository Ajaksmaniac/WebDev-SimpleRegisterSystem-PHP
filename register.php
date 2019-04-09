<!DOCTYPE html>
<html>
    <head>
        <title>Test login form</title>
    </head>
    <body>
        
        <?php  
            if(isset($_POST['user'],$_POST['pass'])){
                $inUsername = $_POST['user'];
                $inPassword = $_POST['pass'];
                
            }

            $DatabaseServerName = "localhost";
            $DatabaseUserName = "root";
            $DatabasePassword = "";
            $DatabaseName ="test login";
            

            $DatabaseConnection = mysqli_connect($DatabaseServerName, $DatabaseUserName, $DatabasePassword, $DatabaseName);

            if(!$DatabaseConnection){
                echo "Connection failed";
                
            }else{
                $SQL_FindUser = "SELECT username FROM user WHERE username like '$inUsername'";
                $Database_FindUserResult = mysqli_query($DatabaseConnection, $SQL_FindUser);
              
                $row = mysqli_fetch_assoc($Database_FindUserResult);
                if($inUsername == $row['username']){
                    echo "Username already exists";
                   
                }else{
                    
                    $SQL_MaxUserId = "SELECT MAX(id)as id FROM `user` ";
                    $Database_MaxUserIdResult = mysqli_query($DatabaseConnection,$SQL_MaxUserId);
                    $Database_MaxUserIdResultCheck = mysqli_num_rows($Database_MaxUserIdResult);
                    if($Database_MaxUserIdResultCheck != 1){
                        echo "Error";
                    }else{
                        $row = mysqli_fetch_assoc($Database_MaxUserIdResult);
                        $maxId = $row['id'];
                        $maxId++;

                        $SQL_INSERT = "INSERT INTO user (id, username, password)
                        VALUES ($maxId, '$inUsername', '$inPassword')"; 
                        
                        if(mysqli_query($DatabaseConnection,$SQL_INSERT)){
                            echo "Registered";
                        }else{
                            echo "Error" . mysqli_error($DatabaseConnection);
                        }
                    }
                }     
            }

            
            
            
        
            

            
            mysqli_close($DatabaseConnection);
        ?>
    
    </body>

</html>