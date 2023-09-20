<h1 class="nombre-pagina">Panel de Administración</h1>

<?php
    include_once __DIR__ . '/../templates/barra.php'; 
?>

<h2>Buscar Citas</h2>
<div class="busqueda">
    <form class="formulario">
        <div class="campo">
            <label for="fecha">Fecha</label>
            <input 
                type="date"
                id="fecha"
                name="fecha"
                value="<?php echo $fecha; ?>"
            />
        </div>
    </form>
</div>

<?php
    if(count($citas ) === 0){
        echo "<h3>No Hay Citas en esta Fecha </h3>";
    } 
?> 

<div id="citas-admin">
    <ul class="citas">
            <?php
                $idCita = 0;
                foreach($citas as $key => $cita){
                    if($idCita !== $cita->id){
                        $total = 0;
            ?>
            <li>
                    <p>ID: <span><?php echo $cita->id;  ?></span></p>
                    <p>Hora: <span><?php echo $cita->hora;  ?></span></p>
                    <p>Cliente: <span><?php echo $cita->cliente;  ?></span></p>
                    <p>Email: <span><?php echo $cita->email;  ?></span></p>
                    <p>Telefono: <span><?php echo $cita->telefono;  ?></span></p>

                    <h3>Servicios</h3>
            <?php 
                $idCita = $cita->id;    
            }//Fin de if 
                $total += $cita->precio;
            ?>

                    <p class="servicio"><?php echo $cita->servicio . " " . $cita->precio; ?></p>

            <?php 
                $actual = $cita->id;//retorna el ID que nos encontramos
                $proximo = $citas[$key + 1]->id ?? 0;// el indice en el arreglo de la BD,identifica cual es el ultimo registro 
                //funciona como un escaner de un supermercado hasta que no se pase el ultimo producto no imprime el total

                if(esUltimo($actual,$proximo)){ ?>
                    <p class="total">Total:<span> $<?php echo $total; ?></span> </p> 

                    <form action="/api/eliminar" method="POST">
                        <input type="hidden" name="id" value="<?php echo $cita->id; ?>">
                        <input type="submit" class="boton-eliminar" value="eliminar">
                    </form>
            <?php } 
            }//Fin de Foreach ?>
    </ul>

</div>

<?php
    $script = "<script src='build/js/buscador.js'></script>"
?>