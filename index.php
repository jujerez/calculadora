<!DOCTYPE html>
    <html lang="es">
        <head> 
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <script src=""></script>
            <title></title>
        </head>
        <body>
            <?php
            require __DIR__ . '/auxiliar.php';
            const OPS = ['+','-', '*', '/'];
            $errores = [];

            

            pintarFormulario($op1, $op2, $op);
            try {
                comprobarParametros($errores);
                comprobarErrores($errores);
                comprobarValores($op1, $op2, $op, OPS, $errores);
                comprobarErrores($errores);
                calcular($op1, $op2, $op);
                
            } catch (Exception $e) {
                foreach ($errores as $error) {
                    mensajeError($error);
                }
            }
            
            
            ?>
            
        </body>
    </html>