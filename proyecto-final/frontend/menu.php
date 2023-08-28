     <?php
session_start();
if(isset($_SESSION['idC'])){
$idC = $_SESSION['idC'];
$nombre = $_SESSION['nombreC'];
}
// require "../funciones/conecta.php";
// $con = conecta();

?> 
    <div class="header-container">
        <header>
            <div class="espacio">
                <a href="index.php">
                    TOMASINO
                    <i class="fas fa-book"></i>
                </a>
            </div>

            <nav>
                <a href="index.php">
                    <div class="navbutton">HOME</div>
                </a>

                <a href="productos.php"><div class="navbutton">
                    PRODUCTOS

                </div></a>


                <a href="contacto.php"><div class="navbutton">
                    CONTACTO
                </div></a>
            </nav>
            
            <div class="apartado">
                <div class="sesion">
                    <a href="alta_clientes.php">
                        <p>Crear una cuenta</p>
                    </a>
                    <?php 
                    if(isset($idC)){                       
                    ?>

                    <?php 
                    
                    
              
                    
                    ?>

                    <a href="salir.php">
                        <p>Cerrar Sesión</p>
                    </a>
                    <p class="benvenut"><i class="fa fa-user-o" aria-hidden="true"></i><?php echo $nombre?></p>

                    <div class="carrito"><a href="javascript:void(0);" onclick="menu();"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></div>
                    <?php }else{?>
                        <a href="acceder.php">
                        <p>Acceder</p>
                    </a>
                    <?php }?>
                    
                    

                    <!-- <p>Cerrar sesión</p> -->
                </div>
            </div>
        </header>
    </div>
