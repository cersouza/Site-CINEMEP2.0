-- SELECT Dados de Filmes --
Select * from Filmes F
inner join Genero G on (F.Fil_Genero = G.Gen_Codigo)
inner join Classificacao C on (F.Fil_Classificacao = C.Cla_Codigo)
inner join Distribuidora D on (F.Fil_Distribuidora = D.Dis_Codigo)
Where F.Fil_Codigo= 1; -- "1" representa filme desejado

-- SELECT Dados de Comentários --
Select U.Usu_Nome, C.Com_Comentario, C.Com_Gostou, 
C.Com_NaoGostou, C.Com_Avaliacao, C.Com_Data from Comentario C
inner join Usuario U on (C.Com_Usuario = U.Usu_Codigo) Where C.Com_Filme = 1; -- "1" representa filme desejado


-- Selecionar Nota Média de um filme --
Select COUNT(Com_Usuario) as "qtd_avaliacao", AVG(Com_Avaliacao) as "media_avalicao"
from Comentario Where Com_Filme = 1
Group by Com_Filme;


-- Selecionar Atores do Filme --
Select A.Atr_Nome as "atr_nome", F.Atfl_Papel as "atr_papel"
From AtorFilme F inner join Ator A on (F.Atfl_Atr_Codigo = A.Atr_Codigo)
Where F.Atfl_Fil_Codigo = 1
Order by F.Atfl_Importancia;