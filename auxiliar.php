<?php
    /**
     * Devuelve 
     * @param string $p
     * @return string
     */
    function param( string $p) : string {
        return isset($_GET[$p]) ?  trim($_GET[$p]) : '';
    }

    function calcular($args) 
    {
        extract($args);
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

        return compact('op1', 'op2', 'op');
    }

    function comprobarValores($args, $ops, &$errores)
    {
        extract($args);

        if (!is_numeric($op1)) {
            $errores['op1'] = 'El primer operando no es un numero';
            
        }
        if (!is_numeric($op2)) {
            $errores['op2'] = 'El segundo operando no es un numero';
            
        }
        if (!in_array($op,$ops)) {
            $errores['op'] = 'El operando no es correcto';
            
        }

        if ($op== '/' && $op2 == 0) {
            $errores['op'] = 'No se puede dividir por 0';
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
    function mensajeError($campo,$errores) 
    {
       if(isset($errores[$campo])) {
         return <<<EOT
            <div class="invalid-feedback">
                {$errores[$campo]}
            </div>
         EOT;
       } else {
           return '';
       }
    }

    function pintarFormulario($args, $ops, $errores) {
        extract($args);
        ?>
            <div class="container">
                <div class="row shadow mt-5 ">
                    <div class="col-12 shadow p-4">
                        <form action="" method="get">
                            <div class="form-group"> 
                                <?=insertaInput($errores, $args, 'op1')?>
                                <?=mensajeError('op1',$errores)?>
                            </div>
                            <div class="form-group">
                                <?=insertaInput($errores, $args, 'op2')?>
                                <?=mensajeError('op2',$errores)?>
                            </div>
                            <div class="form-group">
                                <label for="op">Operación</label>
                                <select class="form-control <?=isValid('op',$errores)?>" name="op" id="op">
                                <?php foreach ($ops as $o ) : ?>

                                    <option value="<?= $o ?>" <?= selected($op, $o)?>>  
                                            <?= $o ?>
                                    </option>
                                <?php   endforeach ?> 

                                </select>
                                <?=mensajeError('op',$errores);?>
                            </div>

                            <button type="submit" class="btn btn-primary">Enviar</button>

                        </form>
                    </div>
                    
                </div>
            </div>
            
        <?php

    }

   

    function selected($op, $o)
    {
        return $op == $o ? 'selected' : '';
    }

    function isValid($campo, $errores) 
    {
        if (isset($errores[$campo])) {
            return 'is-invalid';
        } elseif (!empty($_GET)) {
            return 'is-valid';
        } else {
            return '';
        }
    }

    function insertaInput($errores, $args, $nombre) 
    { 
        extract($args);
        $is_valid = isValid($nombre,$errores);
        $cad   = $nombre == 'op1' ? 'Primer' : 'Segundo';
        $valor = $nombre == 'op1' ?  $op1    : $op2;

       return <<< EOF
                  <label for="{$nombre}"> {$cad} operando</label> 
                  <input type="text" class="form-control {$is_valid}" name="{$nombre}" value="{$valor}"> 
                  
              EOF;
 
    }


?>