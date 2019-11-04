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

        if ($op3 == '/' && $op2 == 0) {
            $errores[] = 'No se puede dividir por 0';
        }

        comprobarErrores($errores);
        
    }

    function comprobarParametros($par, &$errores) 
    {
        
        if (!empty($_GET)) {
            if (empty(array_diff_key(($_GET),$par)) && 
                 empty(array_diff_key($par,($_GET)))) {
                     return $_GET;
            } else {
                $errores[] = 'Los parametros recibidos no son correctos'; 

           }
        } 

        return $par;
       
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

    function pintarFormulario($op1, $op2, $op, $ops) {

        ?>
            <form action="" method="get">

            <label for="op1">Primer operando</label>
            <input type="text" name="op1" value="<?=$op1?>">
            <br>

            <label for="op2">Segundo operando</label>
            <input type="text" name="op2" value="<?=$op2?>">
            <br>

            <label for="op">Operación</label>
            
            
            <select name="op" id="op">
            <?php foreach ($ops as $o ) : ?>

                   <option value="<?= $o ?>" <?= selected($op, $o)?>>  
                        <?= $o ?>
                   </option>
            <?php   endforeach ?> 
            
            </select>

            <button type="submit">Enviar</button>

            </form>
        <?php

    }

    function mostrarErrores($errores) 
    {
        foreach ($errores as $error) {
            mensajeError($error);
        }
    }

    function selected($op, $o)
    {
        return $op == $o ? 'selected' : '';
    }
?>