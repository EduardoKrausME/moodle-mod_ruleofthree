# Regra de Três

Rule of Three é uma atividade Moodle para explorar cálculos proporcionais de forma interativa. Ela pode ser usada por professores que querem disponibilizar uma calculadora simples dentro do curso e por estudantes que precisam visualizar como os valores mudam mantendo uma proporção direta ou inversa.

## Recursos

- Regra de três simples com proporção direta ou inversa.
- Regra de três composta com duas grandezas de influência e um resultado em duas situações.
- Campos sincronizados: ao alterar um valor, os demais valores relacionados são recalculados imediatamente.
- Exibição passo a passo da equação, substituição, fatores e resultado.
- Precisão decimal configurável.
- Conclusão da atividade por visualização usando a API padrão do Moodle.
- Registro de acesso nos logs por meio do evento padrão `course_module_viewed`.
- Suporte a backup e restauração, inclusive para links existentes na descrição da atividade.
- Nenhuma resposta ou histórico de cálculo do estudante é armazenado.

## Configuração da atividade

Ao criar a atividade, o professor escolhe o modo de cálculo, o tipo de relação, os valores iniciais e a precisão decimal. A descrição pode ser usada para explicar o exercício ou apresentar o contexto antes da calculadora interativa.

No modo simples, os quatro valores proporcionais permanecem sincronizados. No modo composto, duas grandezas podem usar relações diretas ou inversas de forma independente, enquanto o resultado é recalculado a partir dos dois fatores.

## Requisitos

Moodle 4.5 ou superior.
