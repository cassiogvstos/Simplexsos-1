module Mochila
    class Mochila
        def self.tabela(capacidade, pesos = [], valores = [])
            capacidade = capacidade.gsub(/[\s\*]/, '').strip
            pesos = pesos.compact.reject(&:blank?)
            valores = valores.compact.reject(&:blank?)

            @pesos_val = Hash[pesos.zip valores]

            tabela = []

            pesos_int = pesos.map do |peso|
                peso.to_i
            end

            (pesos_int.max + 1).times do |peso|
                tabela << Array.new(capacidade.to_i + 1, 0)
            end

            preencher_tabela(tabela)
        end

        def self.preencher_tabela(tabela)
            tabela.each_with_index do |linha, peso|
                linha.each_with_index do |item, i|
                    if peso.to_i <= i.to_i
                        valor = @pesos_val[peso.to_s].to_i

                        if peso == 0
                            valor = 0
                        elsif valor.nil?
                            valor = tabela[peso - 1][i]
                        elsif peso.to_i < i.to_i
                            diferenca = i.to_i - peso.to_i
                            valor = valor.to_i + tabela[peso - 1][diferenca].to_i
                        end

                        if valor < tabela[peso - 1][i].to_i
                            valor = tabela[peso - 1][i].to_i
                        end
                    else
                        valor = tabela[peso - 1][i]
                    end

                    tabela[peso][i] = valor.to_s
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
                    resultado << { i.to_s => @pesos_val[i.to_s] }

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
