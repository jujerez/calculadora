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

    function comprobarValores($a, $b, $c, $ops)
    {
        
        return is_numeric($a) && is_numeric($b) && in_array($c,$ops);
    }

    function comprobarParametros() 
    {
        return isset($_GET['op1'], $_GET['op2'], $_GET['op']);
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
?>