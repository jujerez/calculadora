<?php
    /**
     * Devuelve 
     * @param string $p
     * @return string
     */
    function param( string $p) : string {
        return isset($_GET[$p]) ?  trim($_GET[$p]) : '';
    }

    function calcular(&$op1, $op2, $op) 
    {
        switch ($op) {
            case '+':
                $op1 += $op2;
                break;
            case '-':
                $op1 -= $op2;
                break;

            case '*':
                $op1*=$op2;
                break;

            case '/':
                $op1/=$op2;
                break;

        }
    }

    function comprobarValores($op1, $op2, $op3, $ops, &$errores)
    {
        if (!is_numeric($op1)) {
            $errores[] = 'El primer operando no es un numero';
            
        }
        if (!is_numeric($op2)) {
            $errores[] = 'El segundo operando no es un numero';
            
        }
        if (!in_array($op3,$ops)) {
            $errores[] = 'El operando no es correcto';
            
        }
        
    }

    function comprobarParametros() 
    {
        $par = ['op1', 'op2', 'op'];
        if (!empty($_GET)) {
            if (empty(array_diff(array_keys($_GET),$par)) && 
                 empty(array_diff($par,array_keys($_GET)))) {
            } else {
                $errores[] = 'Los parametros recibidos no son correctos'; 

           }
        } 
       
    }

    function comprobarErrores($errores) 
    {
        if (!empty($errores) || empty($_GET)) {
            throw new Exception();
        }
    }

    /**
     * Vuelca por la salida un mensaje de error
     *
     * @param string $m
     * @return void
     */
    function mensajeError(string $m) 
    {
       ?><div class="error"><?= $m ?> </div><?php
    }

    function pintarFormulario($op1, $op2, $op) {

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
        <?php

    }
?>