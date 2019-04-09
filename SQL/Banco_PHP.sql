Create table Usuario {
	Usu_Codigo int identity(1,1),
    Usu_Usuario varchar(25) not null,
	Usu_Nome varchar(50),
	Usu_Senha varchar(20),
	Usu_Email varchar(100),
	Usu_Situacao varchar(7),
	primary key(Usu_ID)
}

Create table Moderador {
	Mod_Codigo int identity(1,1),
    Mod_Usuario varchar(25) not null,
	Mod_Nome varchar(50),
	Mod_Senha varchar(20),
	Mod_Email varchar(100),
	Mod_Telefone varchar(15),
	Mod_CPF char(11),
	Mod_Situacao varchar(7),
	primary key(Mod_ID)
}

Create table Classificacao(
    Cla_Codigo int,
    Cla_Descricao varchar(50),
    primary key(Cla_codigo)
);

Create table Genero(
    Gen_Codigo int,
    Gen_Descricao varchar(50),
    primary key(Gen_Codigo)
);

create table Distribuidora(
    Dis_Codigo int identity(1,1),
    Dis_RazaoSocial varchar(50),
    Dis_NomeFantasia varchar(50),
    Dis_Cnpj varchar(14),
    Dis_Site varchar(100),
    Dis_Email varchar(100),
    Dis_Endereco varchar(60),
    Dis_Bairro varchar(40),
    Dis_Cidade varchar(32),
    Dis_Estado char(2),
    Dis_Numero varchar(5),
    Dis_Ie varchar(14),
    primary key(Dis_Codigo)
);

create table Filmes(
    Fil_Codigo int identity(1,1),
    Fil_Titulo varchar(50),
    Fil_Sinopse text,
    Fil_Foto text,
    Fil_Lancamento datetime,
    Fil_Tempo varchar(6),
    Fil_Genero int,
    Fil_Classificacao int,
    Fil_Distribuidora int,
    Fil_Situacao varchar(07),
    primary key(Fil_Codigo),
    foreign key(Fil_Genero) references Genero(Gen_codigo),
    foreign key(Fil_Distribuidora) references Distribuidora(Dis_Codigo),
    foreign key(Fil_Classificacao) references Classificacao(Cla_Codigo)
);

create table Comentario(
    Com_Codigo int identity(1,1),
    Com_Usuario int,
    Com_Comentario text,
    Com_Gostou int,
    Com_NaoGostou int,
    Com_Avaliacao int,
    Com_Filme int,
    Com_Data date,
    Com_Situacao char,
    primary key(Com_Codigo),
    foreign key(Com_Usuario) references Usuario(Usu_Codigo),
    foreign key(Com_Filme) references Filmes(Fil_Codigo)
);