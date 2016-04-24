# Simplex

http://simplex-univem.herokuapp.com/

**Projeto de Pesquisa Operacional** - 5º semestre BSI

### Integrantes

1. Gustavo Marttos, RA 536202
2. Jordana Nogueira, RA 542717

## Simplex
O Método Simplex é um procedimento matricial usado para resolver os modelos de
programação linear, visando buscar a solução ótima para o problema.

## Ferramentas

* Heroku
* Ruby on Rails
* Bootstrap 3.3.6

## Guia de uso do Simplex

### Expressão
* Max Z = 3x1 + 5x2

### Restrições
Utilize os botões de '+' e '-' para adicionar ou remover as restrições.
* x1 <= 4
* x2 <= 6
* 3x1 + 2x2 <= 18

### Apresentação do Resultado
Selecione a forma de apresentação do resultado, todas as iterações ou somente a tabela com o resultado final.

### Maximizar / Minimizar
O resultado é apresentado após o calculo a solução ótima do problema de PL proposto.
Se ao final do processo a solução não for ótima, é porque um dos pontos adjacentes fornece um valor
maior que o inicial.

### Análise de Sensibilidade
A Análise de Sensibilidade é uma análise pósotimização que busca verificar os efeitos causados
ao PPL devido as possíveis variações (aumentando ou diminuindo) dos valores dos coeficientes das
variáveis, tanto da função objetivo como nas restrições além das disponibilidades dos recursos
mencionados nas restrições (termos constantes).

## To-do

- [ ] Retornar variáveis básicas e não básicas.
- [x] Opção de obter o resultado passo a passo ou somente o final - _24/04/2016_;
- [x] Adicionado tratamento de erro quanto à formatação das expressões - _17/04/2016_.

## Informações adicionais
* As restrições só aceitam "<=" como operador.
