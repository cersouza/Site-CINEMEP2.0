INSERT INTO `Ator` (`Atr_Codigo`, `Atr_Nome`, `Atr_DataNasc`) VALUES
(1, 'Brie Larson', '1989-11-01'),
(2, 'Samuel L. Jackson', '1948-12-21'),
(3, 'Jude Law', '1972-12-29');

INSERT INTO `Classificacao` (`Cla_Codigo`, `Cla_Descricao`) VALUES
(1, 'Livre');

INSERT INTO `Distribuidora` (`Dis_Codigo`, `Dis_RazaoSocial`, `Dis_NomeFantasia`, `Dis_Cnpj`, `Dis_Site`, `Dis_Email`, `Dis_Endereco`, `Dis_Bairro`, `Dis_Cidade`, `Dis_Estado`, `Dis_Numero`, `Dis_Ie`) VALUES
(1, NULL, 'Marvel', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);


INSERT INTO `Genero` (`Gen_Codigo`, `Gen_Descricao`) VALUES
(1, 'Aventura');

INSERT INTO `Filmes` (`Fil_Codigo`, `Fil_Titulo`, `Fil_Sinopse`, `Fil_Foto`, `Fil_Lancamento`, `Fil_Tempo`, `Fil_Genero`, `Fil_Classificacao`, `Fil_Distribuidora`, `Fil_Situacao`) VALUES
(1, 'Capita Marvel', 'Carol Danvers (Brie Larson) é uma ex-agente da Força Aérea norte-americana, que, sem se lembrar de sua vida na Terra, é recrutada pelos Kree para fazer parte de seu exército de elite. Inimiga declarada dos Skrull, ela acaba voltando ao seu planeta de origem para impedir uma invasão dos metaformos, e assim vai acabar descobrindo a verdade sobre si, com a ajuda do agente Nick Fury (Samuel L. Jackson) e da gata Goose.', 'img/filmes/capa-capita-marvel.jpg', '2019-03-07', '2h10', 1, 1, 1, 'Cartaz');

INSERT INTO `AtorFilme` (`Atfl_Codigo`, `Atfl_Atr_Codigo`, `Atfl_Fil_Codigo`, `Atfl_Papel`, `Atfl_Importancia`) VALUES
(1, 1, 1, 'Capita Marvel', 1),
(2, 2, 1, 'Nick Fury', 2),
(3, 3, 1, 'Yon-Rogg', 2);

INSERT INTO `Usuario` (`Usu_Codigo`, `Usu_Usuario`, `Usu_Nome`, `Usu_Senha`, `Usu_Email`, `Usu_Situacao`) VALUES
(1, 'caio', 'Caio Eduardo', '123456', 'souzacaiodu@cinemep.com', 'Ativo'),
(2, 'dudu', 'Eduardo Du', '123456', 'dudu@cinemep.br', 'Ativo'),
(3, 'igor', 'Igor Eduardo', '123456', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Inativo');

INSERT INTO `Comentario` (`Com_Codigo`, `Com_Usuario`, `Com_Comentario`, `Com_Gostou`, `Com_NaoGostou`, `Com_Avaliacao`, `Com_Filme`, `Com_Data`, `Com_Situacao`) VALUES
(1, 1, 'Eu gostei Mais ou Menos do filme : /', 0, 0, 4, 1, '2019-05-14 14:43:18', '1'),
(2, 1, 'Eu gostei Mais ou Menos do filme : /', 0, 1, 3, 1, '2019-05-14 14:40:34', '1'),
(3, 1, 'Eu gostei Mais ou Menos do filme : /', 1, 0, 3, 1, '2019-05-14 14:40:34', '1'),
(14, 1, 'Eu gostei Mais ou Menos do filme : /', 0, 0, 3, 1, '2019-05-14 14:40:34', 'T'),
(15, 1, 'Eu gostei Mais ou Menos do filme : /', 0, 0, 3, 1, '2019-05-14 14:40:34', 'T'),
(16, 1, 'Eu gostei Mais ou Menos do filme : /', 0, 0, 3, 1, '2019-05-14 14:40:34', 'T');