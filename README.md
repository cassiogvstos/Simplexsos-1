# Simplex

**Projeto de Pesquisa Operacional** - 5º semestre BSI

### Integrantes

1. Gustavo Marttos, RA 536202
2. Jordana Nogueira, RA 542717

Implementação do metodo Simplex

## Ferramentas

* Heroku
* Ruby on Rails
* Bootstrap 3.3.6

## Simplex

O uso do Simplex permite que se encontre valores ideais em situações em
que diversos aspectos precisam ser respeitados. Diante de um problema, são
estabelecidas inequações que representam restrições para as variáveis.
A partir daí, testa-se possibilidades de maneira a otimizar o resultado
da forma mais rápida possível.
O uso mais comum do Simplex é para se maximizar um resultado, ou seja,
encontrar o maior valor possível para um total.

# Expressão

* Max Z = 3x1 + 5x2

# Restrições
* x1 <= 4
* x2 <= 6
* 3x1 + 2x2 <= 18

# Changelog
* Adicionado tratamento de erro quanto à formatação das expressões.

# Informações adicionais
* As restrições só aceitam "<=" como operador.