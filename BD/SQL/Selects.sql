-- SELECT Dados de Filmes --
Select * from Filmes F
inner join Genero G on (F.Fil_Genero = G.Gen_Codigo)
inner join Classificacao C on (F.Fil_Classificacao = C.Cla_Codigo)
inner join Distribuidora D on (F.Fil_Distribuidora = D.Dis_Codigo);

-- SELECT Dados de Comentários --
Select F.Fil_Codigo, F.Fil_Titulo, C.Com_Comentario, C.Com_Gostou, 
C.Com_NaoGostou, C.Com_Avaliacao, C.Com_Data from Comentario C
inner join Filmes F on (C.Com_Filme = F.Fil_Codigo);