module Mochila
    class Mochila
        def self.tabela(capacidade, pesos = [], valores = [])
            capacidade = capacidade.gsub(/[\s\*]/, '').strip
            pesos = pesos.compact.reject(&:blank?)
            valores = valores.compact.reject(&:blank?)

            capacidade = capacidade.to_i

            pesos.map! do |peso|
                peso.to_i
            end

            valores.map! do |valor|
                valor.to_i
            end

            pesos_val = pesos.zip valores

            @pesos_v = pesos_val

            tabela = [].tap { |m| (@pesos_v.size + 1).times { m << Array.new(capacidade + 1) } }

            tabela[0].each_with_index { |valor, peso| tabela[0][peso] = 0 }

            preencher_tabela(tabela, capacidade)
        end

        def self.preencher_tabela(tabela, capacidade)
            @iterations = 0

            (1..@pesos_v.size).each do |i|
                peso, valor = @pesos_v[i - 1]

                (0..capacidade).each do |x|
                    @iterations = @iterations + 1;

                    if peso > x
                        tabela[i][x] = tabela[i - 1][x]
                    else
                        tabela[i][x] = [tabela[i - 1][x], tabela[i - 1][x - peso] + valor].max
                    end
                end
            end

            procurar(tabela)
        end

        def self.procurar(tabela)
            i = tabela.size - 1
            j = tabela.last.size - 1

            resultado = []

            begin
                if tabela[i][j] != tabela[i - 1][j]
                    resultado << @pesos_v[i - 1]

                    j -= i
                    i -= 1
                else
                    i -= 1
                end
            end while i > 0

            return resultado, tabela
        end
    end
end
