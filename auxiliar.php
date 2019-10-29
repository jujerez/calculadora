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
        $par = ['op1', 'op2', 'op'];
        if (!empty($_GET)) {
           if (!(empty(array_diff(array_keys($_GET),$par)) && 
           empty(array_diff($par,array_keys($_GET))))) {
               
           }
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
?>