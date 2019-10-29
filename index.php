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

            $op1 = param('op1');
            $op2 = param('op2');
            $op  = param('op');

            if (comprobarParametros()) {

                if (comprobarValores($op1, $op2, $op, OPS)){
                    calcular($op1, $op2, $op);

                } else {
                    mensajeError('Los valores introducidos no no son correctos');
                }
            }
            
            ?>
            <form action="" method="get">

            <label for="op1">Primer operando</label>
            <input type="text" name="op1" value="<?=$op1?>">
            <br>

            <label for="op2">Segundo operando</label>
            <input type="text" name="op2" value="<?=$op2?>">
            <br>

            <label for="op">Operación</label>
            <input type="text" name="op" value="<?=$op?>">
            <br>

            <button type="submit">Enviar</button>

            </form>
        </body>
    </html>