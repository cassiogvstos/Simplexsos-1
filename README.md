# Simplex e Mochila

[Abrir aplicação online - Simplex](http://simplex-univem.herokuapp.com/)

[Abrir aplicação online - Mochila](http://simplex-univem.herokuapp.com/mochila)

**Projeto de Pesquisa Operacional** - 5º semestre BSI

### Integrantes

1. Gustavo Marttos, RA 536202
2. Jordana Nogueira, RA 542717

## Introdução
Este documento provê uma visão geral da versão do aplicativo Simplex que está sendo liberada.
Aqui será descrito as funcionalidades do aplicativo, bem como seus problemas e limitações conhecidos.
Por último são descritas as demandas e os problemas que foram resolvidos para liberação da versão atual.

O Método Simplex é um procedimento matricial usado para resolver os modelos de
programação linear, visando buscar a solução ótima para o problema.

Além disso, há a liberação do aplicativo da Mochila, onde há um problema de otimização combinatória, que leva o mesmo nome. Possui como objetivo a mochila ter o maior valor possível, não ultrapassando o peso máximo dela.

## Nota de release

### Simplex

* Entradas personalizadas para maximização e minimização;
* Quantidade ilimitada de restrições e variáveis;
* Quantidade especifica de iterações;
* Tabela de sensibilidade;
* Possibilidade de mostrar passo a passo ou somente o resultado final;
* Tratamento de erros quanto à expressões erradas ou loop infinito.

### Mochila

* Quantidade de itens ilimitada;
* Tratamento de erros;
* Apreentação da solução, dos itens a serem considerados e a tabela de cálculo.

## Problemas conhecidos e limitações

### Simplex

* As restrições só aceitam "<=" como operador;
* É necessário separar os sinais matemáticos das variáveis com um espaço para não causar erro de interpretação (`e.g.: 3x1 + 2x2`).

### Mochila

* Somente valores inteiros são permitidos

## Datas importantes

### Simplex

| Data  | Evento    |
|:-----:|-----------|
| 10/03/2016    | Início do projeto.   |
| 14/03/2016    | Análise de tecnologias.   |
| 22/03/2016    | Início do desenvolvimento da aplicação.   |
| 26/03/2016    | Realização dos primeiros testes.  |
| 27/03/2016    | Continuação dos testes (ref. geração das matrizes)    |
| 17/04/2016    | Estrutura da aplicação criada.    |
| 17/04/2016    | Primeiros tratamentos de erros criados.   |
| 23/03/2016    | Finalização da primeira versão.   |
| 24/04/2016    | Criada opção de exibir passo a passo ou somente resultado final.  |
| 24/04/2016    | Variáveis básicas e não básicas incluídas.    |
| 24/04/2016    | Entrega da versão final do projeto.   |
| 24/04/2016    | Projeto disponibilizado no ambiente de produção.  |
| 29/04/2016    | Conclusão da wiki.    |


### Mochila

| Data  | Evento    |
|:-----:|-----------|
| 27/05/2016    | Início do projeto.   |
| 28/05/2016    | Estrutura da aplicação reutilizada do Simplex.   |
| 28/05/2016    | Aplicação base criada.   |
| 28/05/2016    | Layout criado.   |
| 28/05/2016    | Finalização da primeira versão.   |

## Compatibilidade

| Requisitos    | Ferramentas   |
|---------------|---------------|
| Navegadores   | Google Chrome, Mozilla Firefox, Opera, Safari, Microsoft Edge e Internet Explorer 9+.     |
| Sistemas Operacionais     | UNIX, Windows.    |

| Tecnologias   ||
|---------------||
| Front-end | HTML, CSS, Javascript |
| Back-end  | Ruby  |
| Frameworks    | Rails e Bootstrap     |
| Design Pattern    | MVC   |
| Servidor  | Heroku    |

## Procedimento e alteração de configuração do ambiente
Para alteração no ambiente é necessário possuir o Git e o Heroku Toolbelt, realizar login no Heroku e executar o comando `heroku create`. Após a configuração, basta dar um `push` no branch master. E.g.: `git push heroku master`.

## Atividades realizadas no período

### Simplex

| Código    | Título    | Tarefa    | Situação  |
|:---------:|-----------|-----------|:---------:|
| 1 | Gerar matrizes    | Permitir a criação da primeira matriz.    | Concluído |
| 2 | Interpretar expressões como `3x1 + 2x2`   | Realizar a leitura de valores e variáveis da expressão.   | Concluído |
| 3 | Definir tratamento de erros   | Verificar se o cálculo está correto.  | Concluído |
| 4 | Desenvolvimento da UI     | Criação da UI para liberação da versão final.     | Concluído     |

## Guia de uso do Simplex

### Expressão
Exemplo de expressão:

* Max Z = 3x1 + 5x2
* Min Z = -3x1 - 5x2

### Restrições
Utilize os botões de `+` e `-` para adicionar ou remover as restrições.

Exemplos de restrições:

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
A Análise de Sensibilidade é uma análise pós-otimização que busca verificar os efeitos causados
ao PPL devido as possíveis variações (aumentando ou diminuindo) dos valores dos coeficientes das
variáveis, tanto da função objetivo como nas restrições além das disponibilidades dos recursos
mencionados nas restrições (termos constantes).

## Guia de uso da Mochila

### Capacidade
Informe como capacidade o número **4**.

### Itens (pesos e valores)
Utilize os botões de `+` e `-` para adicionar ou remover os itens.

* Coloque **1** no primeiro campo de peso e **31** no campo de valor em frente;
* Clique no botão verde com o ícone de "+";
* Coloque **2** no segundo campo de peso e **47** no campo de valor em frente;
* Clique no botão verde com o ícone de "+";
* Coloque **3** no terceiro campo de peso e **14** no campo de valor em frente.

Deverá ficar desta forma:

| Peso  | Valor |
|:-----:|:-----:|
| 1 | 31    |
| 2 | 47    |
| 3 | 14    |

### Resultado
Após clicar em `Calcular`, serão apresentados os itens escolhidos pelo algoritmo, o resultado da solução ótima e a tabela.