<?php
function parentesisBalanceados($expresion) {
    $pila = [];
    $pares = ['(' => ')', '{' => '}', '[' => ']'];

    for ($i = 0; $i < strlen($expresion); $i++) {
        $char = $expresion[$i];
        if (isset($pares[$char])) {
            array_push($pila, $char);
        } elseif (in_array($char, $pares)) {
            $ultimo = array_pop($pila);
            if ($pares[$ultimo] !== $char) {
                return false;
            }
        }
    }
    return empty($pila);
}

// Lista con el ejemplo 
$ejemplos = ["({[]})", "(({})", "{[()]}[]", "([)]"];

foreach ($ejemplos as $expresion) {
    echo "La expresión '$expresion' " . 
         (parentesisBalanceados($expresion) ? "está balanceada" : "NO está balanceada") 
         . PHP_EOL;
}
?>
