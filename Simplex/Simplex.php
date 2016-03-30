<?php
namespace Simplex;

class Simplex
{
    /**
     * Máximo de vezes que o programa roda.
     */
    const MAX_VOLTAS = 20;

    /**
     * Array de folgas.
     *
     * @var array
     */
    private $folgas = [];

    /**
     * Gera a matriz principal da solução.
     *
     * @param  string $expr
     * @param  array  $restr
     * @return array
     */
    private function gerarMatriz($expr, array $restr = [])
    {
        $restr = array_filter($restr);

        // Retira os espaços em branco das restrições.
        $restr = array_map(
            function ($e) {
                return str_replace(' ', '', trim($e));
            },
            $restr
        );

        // Retira os espaços em branco da expressão.
        $expr = str_replace(' ', '', trim($expr));

        // Guarda em $_val cada unidade da expressão.
        preg_match_all('/\-*\w*\,*\.*\w+/', $expr, $_val);

        $valores = [];

        foreach ($_val as $val) {
            foreach ($val as $k => $v) {
                $valores[] = $v;
            }
        }

        // Guarda em $_var cada elemento da expressão.
        preg_match_all('/[a-zA-Z]\d*/', $expr, $_var);

        $variaveis = [];

        foreach ($_var as $var) {
            foreach ($var as $k => $v) {
                $variaveis[] = $v;
            }
        }

        $folgas = [];

        // Guarda as variáveis de folga.
        foreach ($restr as $k => $v) {
            $folgas[] = 'f' . ($k + 1);
        }

        $this->folgas = $folgas;

        // Primeira linha da matriz.
        $matriz = [
            array_merge(["Linha"], $variaveis, $folgas, ["B"])
        ];

        for ($i = 0; $i < (count($folgas) + 1); $i++) {
            $matriz[] = array_fill(0, count($matriz[0]), (float) 0.0);
        }

        // Coloca o nome das variáveis de folga na primeira coluna.
        foreach ($folgas as $k => $v) {
            $matriz[$k + 1][0] = $v;
        }

        // Coluna o Z na última linha da primeira coluna.
        $matriz[count($matriz) - 1][0] = 'Z';

        foreach ($valores as $k => $v) {
            // Filtra os números dos valores da expressão.
            preg_match('/(^-*\d*\,*\.*\d*)[a-zA-Z].*/', $v, $valor);

            $valor = trim(preg_replace('/\,/', '.', $valor[1]));

            if (empty($valor)) {
                $valor = (float) 1;
            } else if ($valor == '-') {
                $valor = (float) -1;
            } else {
                $valor = (float) $valor;
            }

            // Adiciona à última linha os valores da expressão (* -1).
            $matriz[count($matriz) - 1][$k + 1] = (float) ($valor * -1.0);
        }

        $valor_ult_col = [];

        // $v é o trecho de cada expressão, e.g.: 5x1.
        foreach ($restr as $k => $v) {
            $posicao = array_search('f' . ($k + 1), $matriz[0]);

            $matriz[$k + 1][$posicao] = (float) 1.0;

            preg_match('/\d+$/', $v, $valor_restr);

            $valor_restr = (float) $valor_restr[0];

            $matriz[$k + 1][count($matriz[$k + 1]) - 1] = $valor_restr;

            $valor_ult_col[] = $valor_restr;

            // $variavel é o trecho da expressão sem o valor, e.g.: 'x1'
            foreach ($variaveis as $variavel) {
                $pattern = '/.*' . $variavel . '.*/';

                if (preg_match($pattern, $v)) {
                    $posicao = array_search($variavel, $matriz[0]);

                    preg_match('/(-*\d*\,*\.*\d*)' . $variavel . '.*/', $v, $elemento);

                    if (empty($elemento)) {
                        continue;
                    }

                    $elemento = trim(preg_replace('/\,/', '.', $elemento[1]));

                    if (empty($elemento)) {
                        $matriz[$k + 1][$posicao] = (float) 1.0;
                    } else if ($elemento == '-') {
                        $matriz[$k + 1][$posicao] = (float) -1.0;
                    } else {
                        $matriz[$k + 1][$posicao] = (float) $elemento;
                    }
                }
            }
        }

        return $matriz;
    }

    /**
     * Verifica se a todos os elementos da última linha da matriz são <b>negativos</b>.
     *
     * @param  array $ultimaLinha
     * @return boolean
     */
    private function condicaoParada(array $ultimaLinha = [])
    {
        foreach (array_slice($ultimaLinha, 1) as $elemento) {
            if ($elemento < 0) {
                return true;
            }
        }

        return false;
    }

    /**
     * Verifica se pode parar de verificar a coluna.
     *
     * @param  array $array
     * @return boolean
     */
    private function condicaoParadaColuna(array $array = [])
    {
        foreach ($array as $k => $v) {
            if ($v != null) {
                if ($v <= 0) {
                    $array[$k] = null;
                }
            }
        }

        $array = array_filter($array);

        return empty($array);
    }

    private function simplex(array $matriz = [])
    {
        $slice = end($matriz);

        $entrada = min(array_slice($slice, 1));
        $entradaIdx = array_search($entrada, $slice);

        $entradaCol = array_map(
            function ($e) use ($entradaIdx) {
                if ($e[$entradaIdx] > 0) {
                    return $e[$entradaIdx];
                }
            },
            array_slice($matriz, 1)
        );

        $entradaCol_ = $entradaCol;

        if ($this->condicaoParadaColuna($entradaCol_)) {
            for ($i = 0; $i < count($matriz); $i++) {
                if ($i == count($matriz) - 1) {
                    for ($j = 0; $j < count($matriz[$i]); $j++) {
                        if ($j == count($matriz[$i]) - 1) {
                            $matriz[$i][$j] = null;
                        }
                    }
                }
            }

            return $matriz;
        }

        $saida = null;
        $saidaIdx = null;

        // $v é cada coluna, e.g.: ['z', 1.0, 2.0, 0.0, 0.0, 0.0]
        foreach (array_slice($matriz, 1) as $k => $v) {
            if (!is_null($entradaCol[$k])) {
                if ($saida == null) {
                    $saida = end($v) / $entradaCol[$k];
                }

                if ($saidaIdx == null) {
                    $saidaIdx = $k + 1;
                }

                if ($saida > end($v) / $entradaCol[$k]) {
                    $saida = end($v) / $entradaCol[$k];
                    $saidaIdx = $k + 1;
                }
            }
        }

        $matriz[$saidaIdx][0] = $matriz[0][$entradaIdx];

        $pivo = $matriz[$saidaIdx][$entradaIdx];

        foreach (array_slice($matriz[$saidaIdx], 1) as $k => $v) {
            $matriz[$saidaIdx][$k + 1] = $v / $pivo;
        }

        foreach (array_slice($matriz, 1) as $k => $v) {
            if ($k != $saidaIdx - 1) {
                $virarZero = $v[$entradaIdx];

                foreach (array_slice($matriz[$saidaIdx], 1) as $j => $w) {
                    $v[$j + 1] = $w * ($virarZero * - 1) + $v[$j + 1];
                }
            }
        }

        return $matriz;
    }

    /**
     * Executa o método Simplex.
     *
     * @param  string $expr
     * @param  array  $restr
     * @return array
     */
    public function executar($expr, array $restr = [])
    {
        $matrizes = [
            $this->gerarMatriz($expr, $restr)
        ];

        $voltas = 0;

        // condicaoParada precisa receber a última linha da última matriz de $matrizes.
        while ($this->condicaoParada(end(end($matrizes)))) {
            if (is_null(end(end(end($matrizes))))) {
                return $matrizes;
            }

            $voltas++;

            if ($voltas > Simplex::MAX_VOLTAS) {
                return $matrizes;
            }

            $cp = $this->copiarMatriz(end($matrizes));

            $matrizes[] = $this->simplex($cp);
        }

        return $matrizes;
    }

    /**
     * Copia a matriz passada por parâmetro.
     *
     * @param  array $matriz
     * @return array
     */
    private function copiarMatriz(array $matriz)
    {
        return $matriz;
    }
}
