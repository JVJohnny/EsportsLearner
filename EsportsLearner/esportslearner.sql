
CREATE TABLE videos (
	cod_videos int PRIMARY KEY AUTO_INCREMENT,
    url_embed varchar(255),
    categoria varchar(52),
    titulo varchar(255),
    media float,
    cod_usuario int, foreign key(cod_usuario) references usuarios(cod_usuario),
    cod_rating int, foreign key(cod_rating) references rating(cod_rating)
);

CREATE TABLE comment (
	id int PRIMARY KEY AUTO_INCREMENT,
    nome varchar(255),
    comentario text,
    cod_video int,
    quando datetime
);

insert into comment (nome, comentario, cod_video, quando) values ("joao", "muito top esse video", 10, "2022-10-20 14:21:00")

select comment.comentario, comment.quando, profileimg.name, usuarios.usuario from comment inner join profileimg on comment.userid = 
profileimg.userid inner join usuarios on comment.userid = usuarios.cod_usuario 

select videos.cod_videos, videos.titulo, videos.url_embed, videos.cod_usuario, rating.nota, SUm(rating.nota)/count(rating.cod_vid) as soma  from rating left join videos on rating.cod_vid = videos.cod_videos group by rating.cod_vid

select rating.nota, rating.cod_vid, count(rating.cod_vid), SUM(rating.nota), SUm(rating.nota)/count(rating.cod_vid) as media from rating group by rating.cod_vid

select cod_videos, url_embed, categoria, titulo from videos where categoria = "League of Legends" order by cod_videos;

insert into videos (url_embed, categoria, titulo,media, cod_usuario, cod_rating) values ("https://www.youtube.com/embed/yAKw_CScZJ4", "League of Legends", "Como vender drogas",NULL, 1, 2)

create table rating(
    cod_rating int PRIMARY key AUTO_INCREMENT,
    cod_notas int, foreign key(cod_notas) references usuarios(cod_usuario),
    nota float,
    cod_vid int, foreign key(cod_vid) references videos(cod_videos)
);

select cod_videos, url_embed, categoria, titulo, SUM(nota) as parcial from videos left join rating on videos.cod_videos = cod_vid

insert into rating (cod_notas, nota, cod_vid) values (1, 5, 1)

update videos set media = NULL where cod_videos = 1

truncate table rating

select senha as (*) from usuarios 

select count(cod_usuario) as contador from videos where cod_usuario = 1

select profileimg.name, usuarios.usuario, count(rating.cod_notas) from rating
left join profileimg on profileimg.userid = rating.cod_notas inner join usuarios on rating.cod_notas = usuarios.cod_usuario group by cod_notas order by rating.cod_notas asc

select profileimg.name, usuarios.usuario, count(videos.cod_usuario) from videos
left join profileimg on profileimg.userid = videos.cod_usuario inner join usuarios on videos.cod_usuario = usuarios.cod_usuario group by videos.cod_usuario order by videos.cod_usuario asc


