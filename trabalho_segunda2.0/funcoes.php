<?php

function calcularSaldo($transacoes) {
    $saldo = 0;

    foreach ($transacoes as $t) {
        if ($t["tipo"] == "receita") {
            $saldo += $t["valor"];
        } else {
            $saldo -= $t["valor"];
        }
    }

    return $saldo;
}

function calcularReceitas($transacoes) {
    $total = 0;

    foreach ($transacoes as $t) {
        if ($t["tipo"] == "receita") {
            $total += $t["valor"];
        }
    }

    return $total;
}

function calcularDespesas($transacoes) {
    $total = 0;

    foreach ($transacoes as $t) {
        if ($t["tipo"] == "despesa") {
            $total += $t["valor"];
        }
    }

    return $total;
}

function calcularPercentualDespesas($transacoes) {
    $receitas = calcularReceitas($transacoes);
    $despesas = calcularDespesas($transacoes);

    if ($receitas == 0) return 0;

    return ($despesas / $receitas) * 100;
}
?>