CREATE TABLE Imagen(
    DB_idIm INT PRIMARY KEY AUTO_INCREMENT,
    id VARCHAR(100),
    href VARCHAR(100),
    src VARCHAR(100) NOT NULL,
    alt VARCHAR(100) NOT NULL
);

CREATE TABLE Evento(
    DB_idEv INT PRIMARY KEY AUTO_INCREMENT,
    titulo VARCHAR(50) NOT NULL,
    href VARCHAR(200) NOT NULL,
    organizador VARCHAR(100) NOT NULL,
    fecha DATETIME NOT NULL,
    descripcion VARCHAR(10000) NOT NULL,
    imagenPortada INT NOT NULL,
    FOREIGN KEY (imagenPortada) REFERENCES Imagen(DB_idIm)
);

CREATE TABLE Usuario(
    email VARCHAR(100) NOT NULL,
    uname VARCHAR(100) PRIMARY KEY,
    pass VARCHAR(200) NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    direccion VARCHAR(100) NOT NULL,
    sexo VARCHAR(10) NOT NULL,
    pais VARCHAR(100) NOT NULL,
    fNac DATE NOT NULL,
    nivel INT NOT NULL,
    intocable INT NOT NULL DEFAULT 0,
    CONSTRAINT max_user_level CHECK (nivel < 5),
    CONSTRAINT intocable_bool CHECK (intocable = 1 OR intocable = 0)
);

CREATE TABLE Comentario(
    DB_idCo INT PRIMARY KEY AUTO_INCREMENT,
    uname VARCHAR(100) NOT NULL,
    fecha DATETIME NOT NULL,
    cuerpo VARCHAR(10000) NOT NULL,
    DB_idEv INT NOT NULL,
    FOREIGN KEY (DB_idEv) REFERENCES Evento(DB_idEv),
    FOREIGN KEY (uname) REFERENCES Usuario(uname)
);

CREATE TABLE ImagenEvento(
    DB_idEv INT,
    DB_idIm INT,
    PRIMARY KEY (DB_idEv,DB_idIm),
    FOREIGN KEY (DB_idEv) REFERENCES Evento(DB_idEv),
    FOREIGN KEY (DB_idIm) REFERENCES Imagen(DB_idIm)
);

CREATE TABLE PalabraProhibida(
    DB_idPa INT PRIMARY KEY AUTO_INCREMENT,
    palabra VARCHAR(100) NOT NULL
);

CREATE TABLE Etiqueta(
    etiqueta VARCHAR(100),
    DB_idEv INT,
    FOREIGN KEY (DB_idEv) REFERENCES Evento(DB_idEv),
    PRIMARY KEY (etiqueta,DB_idEv)
);

INSERT INTO Imagen(id,href,src,alt) VALUES ("naughty-dog-logo","https://www.naughtydog.com/","templates/images/naughtydog_logo.png","Naughty Dog logo");
INSERT INTO Imagen(id,href,src,alt) VALUES ("santa-monica-logo","https://sms.playstation.com/","templates/images/santa-monica-logo.png","Santa Monica Studio logo");
INSERT INTO Imagen(id,href,src,alt) VALUES ("industries-logo","https://www.343industries.com/","templates/images/343-logo.png","343 Industries Logo");
INSERT INTO Imagen(id,href,src,alt) VALUES ("obsidian-logo","https://www.obsidian.net/","templates/images/obsidian-logo.png","Obsidian Entertainment");
INSERT INTO Imagen(id,href,src,alt) VALUES ("PlayStation","/evento.php?ev=1","templates/images/play-logo.png","Logo PlayStation");
INSERT INTO Imagen(id,href,src,alt) VALUES ("Xbox","/evento.php?ev=2","templates/images/xbox-logo.png","Logo Xbox");

INSERT INTO Evento(titulo,href,organizador,fecha,descripcion,imagenPortada) VALUES('Playstation','https://www.playstation.com/en-us', 'Sony Corporation', '2021-06-11 09:00:00', 'Playstation Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eos labore recusandae at autem sit impedit, quidem praesentium facilis possimus fuga mollitia quaerat in distinctio quos provident eius voluptatem consequatur nostrum eligendi aperiam obcaecati voluptatum a placeat. Temporibus perspiciatis quas veniam reiciendis sequi optio magni. Perspiciatis, quasi, molestias cupiditate debitis nulla harum, in non sequi molestiae sunt inventore? Magnam eveniet, sequi excepturi voluptate vero vitae eum nesciunt doloribus nihil in, nulla ut optio asperiores repellendus sunt cumque atque officia ducimus rerum explicabo! Quod aliquid voluptatum ex necessitatibus, obcaecati eligendi, suscipit voluptatem commodi cum corrupti sunt, excepturi itaque! Expedita alias nostrum suscipit, cumque asperiores quos error impedit voluptate deleniti iure veniam sequi laudantium adipisci tenetur quia ipsum similique! Ex sed iure incidunt accusamus facilis maxime voluptate laudantium esse repudiandae, eos, accusantium voluptas possimus cupiditate quaerat blanditiis! Iusto asperiores enim recusandae tempora voluptas inventore mollitia neque maiores pariatur nesciunt incidunt blanditiis minima, quos corrupti eaque optio velit id expedita, nostrum quasi. Similique fuga consectetur iste provident magnam sed numquam? Deleniti ex necessitatibus minima autem at vel eum dolores dignissimos mollitia aut quae accusamus laborum modi, delectus adipisci iure quo nulla cumque sed. Assumenda reprehenderit numquam a laudantium odio atque, aliquam veniam amet sapiente cumque? Illum porro laboriosam quibusdam voluptatibus minima, ipsam et? Neque culpa reprehenderit nostrum? Incidunt debitis, quibusdam animi omnis aspernatur, eligendi voluptatem excepturi non beatae repellat odit autem assumenda doloribus ex vero sunt placeat. Architecto maxime quos accusantium nihil ex dignissimos! Quos placeat voluptatem beatae harum tempore. Dolore fugiat, nobis nesciunt repellendus inventore, veritatis architecto nemo reprehenderit saepe tempora dolores maxime eligendi molestias autem nulla? Similique, ad sit saepe rem necessitatibus error dolor temporibus culpa fuga deleniti voluptate odit ea nesciunt, corrupti optio hic consequatur tenetur ratione? Nostrum praesentium unde suscipit porro nemo assumenda, maxime quasi, sed nulla sit necessitatibus totam! Laboriosam sapiente debitis voluptate dolorem. Et vero voluptas magnam! Temporibus saepe facere doloremque dicta, natus esse nam dolorem nulla harum laboriosam animi quam non dolore ipsum, delectus tempore! Voluptas reiciendis sunt nihil incidunt voluptatem excepturi unde possimus hic doloremque odit velit alias facere earum mollitia, magni quod ducimus quaerat fuga consequatur minus laborum nisi numquam? Nihil, eveniet ut qui consequuntur id distinctio provident modi, reiciendis error inventore eos alias. Aliquid fuga reiciendis ipsam id, ipsa facilis voluptatum explicabo, dolorem unde nulla maxime. Debitis soluta iure quas suscipit deleniti. Sequi dicta inventore cum eligendi magnam consectetur fugit voluptate et id similique, molestias dolores rem incidunt harum voluptatum error obcaecati veritatis quia reprehenderit. Nam magnam maxime quas accusamus aperiam numquam necessitatibus velit magni deserunt, sint inventore dignissimos dolorem. Aliquam, dolorum! Maxime cumque iste quisquam quas eaque odio? Consequuntur unde earum temporibus debitis nam numquam tenetur deleniti. Dolores unde aspernatur quam doloremque accusamus, rem iure deleniti nemo excepturi magni quibusdam sint in asperiores laudantium officiis! Saepe, voluptas veritatis voluptates provident accusantium quam voluptatibus dolores alias labore id iste, aspernatur nihil perspiciatis delectus officiis odit placeat, ipsam esse ab et aliquam iusto? Quibusdam sapiente mollitia ab quaerat officiis sunt error praesentium corporis nisi velit!',5);
INSERT INTO Evento(titulo,href,organizador,fecha,descripcion,imagenPortada) VALUES('Xbox','https://www.xbox.com/en-US/', 'Microsoft Corporation', '2021-06-13 11:00:00', 'Xbox Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus laborum obcaecati optio totam architecto, sequi minima nemo veritatis ex blanditiis iusto aspernatur quos vel ipsam reprehenderit illo corrupti excepturi enim, quaerat magnam quis repudiandae. Facilis officia, delectus maxime esse modi distinctio a cupiditate, inventore amet quibusdam debitis perspiciatis laborum minima, voluptatibus odio? Labore harum necessitatibus rerum, quidem quod fugit vitae voluptas similique minima eius pariatur excepturi dicta qui corporis iste aspernatur, incidunt quia non! Quaerat, eaque. Eius fugiat saepe architecto nesciunt commodi eveniet accusamus, ad sit, error magni nemo eaque obcaecati sed! Tempore, aliquid quibusdam, impedit officia, perspiciatis odit id quo ut minima quidem dignissimos! Tempora quaerat atque ullam saepe corrupti esse amet doloribus consequuntur, cum perferendis laboriosam porro earum debitis, maiores, ad nulla hic repellendus itaque veritatis soluta harum beatae unde et praesentium. Laudantium vel voluptas perferendis. Repudiandae vero exercitationem corporis similique temporibus in corrupti odit minima inventore sapiente esse doloremque quam facere veritatis modi, quis perspiciatis doloribus est quod vel quaerat molestiae consectetur eaque architecto. Cumque deserunt consequuntur labore iusto aut incidunt. Beatae doloribus tempore doloremque quaerat, cumque molestiae vero perferendis fuga deserunt officiis quae facilis fugiat. Aliquam culpa, eaque sunt laborum placeat enim pariatur nam quibusdam itaque ipsam cum repellat? Corrupti sequi maxime ad ratione provident mollitia, ipsa aut dicta labore autem hic cumque iusto laudantium, exercitationem magnam consectetur eligendi illo tempora voluptatem repudiandae qui nulla in. Placeat exercitationem reprehenderit quas sed et ipsa? Minima officiis, labore doloribus aspernatur in ut amet iste impedit incidunt, ipsum voluptates minus eveniet itaque debitis consectetur eum non iusto omnis nisi quo doloremque ullam eaque ducimus autem? Facere dolorum temporibus, mollitia iure quis, ea consectetur quisquam recusandae at sequi ducimus voluptate dicta. Architecto necessitatibus amet, quis aut provident totam quae quas laudantium vel omnis laboriosam veniam similique deserunt cupiditate odit iusto voluptas eos perspiciatis atque ratione minus. Nam dolore quaerat ex voluptatum ullam cum soluta amet dolor placeat dolorum similique animi sint dicta alias facere architecto aliquid, delectus nemo unde eaque? Odit provident eum totam, a laudantium perspiciatis aliquid culpa delectus sequi eius numquam natus vero at nihil soluta neque, exercitationem porro ipsa? Nihil asperiores numquam voluptates consequuntur neque officia laborum culpa nostrum quaerat perspiciatis tempore odit labore, eos nemo vero dolorem earum esse delectus in non? Et adipisci itaque molestias reprehenderit pariatur dignissimos vel repellat saepe obcaecati optio ipsa nesciunt a dolorum fugiat sequi laboriosam nobis repellendus, neque debitis impedit dolorem omnis? Quaerat optio porro debitis cum perspiciatis, ducimus veniam accusantium. Sint deserunt iure nesciunt, error, odit at reprehenderit beatae illum eligendi eius sed! Illo, quidem nisi dolorem reprehenderit repellendus aperiam itaque dolorum quos adipisci ratione vel a cupiditate perspiciatis delectus culpa exercitationem quasi, quo est, qui soluta id. Placeat animi itaque molestiae consequuntur omnis, ut culpa vitae exercitationem doloribus asperiores beatae debitis, repudiandae non. Quae vitae consequuntur, maiores vero ullam sunt? Velit hic consequatur, sunt omnis accusantium ipsam minus est aspernatur, tempore distinctio unde aperiam similique praesentium? Accusantium doloremque, maxime labore ipsam magni aspernatur eos exercitationem esse recusandae, sint, soluta repudiandae dolor illum nisi optio quibusdam eum obcaecati reiciendis? Sapiente, quasi nesciunt molestias nostrum totam expedita labore qui ratione amet. Optio aperiam qui consequatur velit voluptatibus recusandae, debitis ex laboriosam corrupti quos veniam sit voluptas illo tempore facere? Nam esse incidunt ex vitae id beatae hic nemo corrupti dolorem mollitia, ipsa aut animi ratione voluptatibus accusamus et dolores temporibus error suscipit!',6);

INSERT INTO Etiqueta VALUES ("Exclusivos",1);
INSERT INTO Etiqueta VALUES ("PC",2);

INSERT INTO PalabraProhibida(palabra) VALUES ("xbox");
INSERT INTO PalabraProhibida(palabra) VALUES ("microsoft");
INSERT INTO PalabraProhibida(palabra) VALUES ("gamepass");
INSERT INTO PalabraProhibida(palabra) VALUES ("bill gates");
INSERT INTO PalabraProhibida(palabra) VALUES ("azure");
INSERT INTO PalabraProhibida(palabra) VALUES ("windows");
INSERT INTO PalabraProhibida(palabra) VALUES ("skype");
INSERT INTO PalabraProhibida(palabra) VALUES ("github");
INSERT INTO PalabraProhibida(palabra) VALUES ("kinect");
INSERT INTO PalabraProhibida(palabra) VALUES ("series x");

-- Pass: piolin --
INSERT INTO Usuario VALUES ("erkike69@marbella.com","erKike69","$2y$10$bCGegj7mgzKfSe3z/1EKlu9jfJMFz/QKJbZ8Z4.FQuT7tRZsrCAva","Enrique","Montilla","Marbella", "Male", "Spain", "1995-02-09", 4, 1);

-- Pass: gaviota --
INSERT INTO Usuario VALUES ("lilbokeron@mtv.com","LilBokeron","$2y$10$dIl7I6qOPuuXwESYvsusvOPlC9e88f/8JRSn2eluvtY.ESjB63WTO", "Andres", "Alguacil","Fungirola", "Male", "Spain", "1994-03-04", 3, 0);

-- Pass: golf --
INSERT INTO Usuario VALUES ("tigerwoods@pga.com","Abby","$2y$10$RZZwsSLyO4Ww6bFcOpnyQO6CRbINTb.8MAKugsrC90ySAWu7YY4Am", "Abigail", "Anderson", "Seattle", "Female", "United States", "2000-10-06", 2, 0);

-- Pass: kinect --
INSERT INTO Usuario VALUES ("mattrick@xbox.com","DonMattrick","$2y$10$bJtnbELpnOnL9EW1gH2HQuw9O5Mt41nMGqHFxbv4q8H9wG57EYnye", "Don", "Mattrick", "Vancouver", "Male", "Canada", "1964-02-13", 1, 0);

INSERT INTO Comentario(uname,fecha,cuerpo,DB_idEv) VALUES ("erkike69","2021-04-10 20:35:25", "No vea que hambre Que hambre Que hambre Que hambre Estoy canino Son la ocho y media me voy a levantar Hermano vaya hambre toca desayunar Me voy a se un bocata que eso va a ser ilegal Eh esto lo que suelen llamar felicidad Me lavo la cara con to el arte Hoy va ser la polla lo veo venir Nada ni nadie podrá pararme La putada fue cuando el armario abrí No hay pan No hay pan Y que desayuno yo? Yo, yo Donde pongo yo el jamón? Elja-mon Loco vaya putadon Illo, illo Toy sin ganas de vivir De vivir Creo que me voy a desnutrir Illo, illo La panza empieza a rugir Es el fin Un sándwich Yo lo que quiero eh un sándwich Un sándwich, un sándwich Un sándwich, un sándwich No es mucho pedir Un sándwich Yo lo que quiero eh un sándwich Un sándwich, un sándwich Un sándwich, un sándwich No es mucho pedir Llamo a la mama Le comento to el drama y a la ve me doy Cuenta que no hay mermelada Esto es mas grave de lo que yo pensaba Creo que me voy a ahogar con la almohada Se acaba aquí Voy a hacer a toa esa gente feliz Esa peña se merece un sándwich Si yo no pueo tenerlo al menos tu si No hay pan No hay pan Y que desayuno yo? Yo, yo Donde pongo yo el jamón? Elja-mon Loco vaya putadon Illo, illo Toy sin ganas de vivir De vivir Creo que me voy a desnutrir Illo, illo La panza empieza a rugir Es el fin Un sándwich Yo lo que quiero eh un sándwich Un sándwich, un sándwich Un sándwich, un sándwich No es mucho pedir Un sándwich Yo lo que quiero eh un sándwich Un sándwich, un sándwich Un sándwich, un sándwich Aunque sea salami",2);
INSERT INTO Comentario(uname,fecha,cuerpo,DB_idEv) VALUES ("DonMattrick", "2021-04-14 11:41:54","El Kinect lo mejor de verdad hacedme caso que lo petamos",2);
INSERT INTO Comentario(uname,fecha,cuerpo,DB_idEv) VALUES ("LilBokeron", "2021-03-15  13:05:24","Pues nada, gente, eh, aquí dejo lo que sería Mi mayor creación hasta la fecha: Justo un añito después de, del anterior Y por supuesto dedicado a... Al señor Guille, y al señor Juanito ¡Ayps! Seguimos con los versos perversos demuestro a todos que ejerzo De chico raro, con descaro, hijo de Amparo y de un tuerto Mi tío es Berto, no Romero, no Tomillo Ver todos los días al primo pillo, que pillaba frío y no se abriga Le suena la barriga, ¿diga? Hello, Im your belly, can you give me some comida? Mira, of course I can, y compro un caldo de Avecrem Se creen ustedes que soy rico, rico el caldo, ¡Sabe bien! ¿Sabes qué más sabe bien? Jeje, exacto Aunque parezca pintada por Goya, no es más que mi po-po-po Poción traída de Troya, la han traído Luis, Bernardo, Ernesto En esto que me da por ver el móvil; mensaje de texto Resulta ser Felipe VI el remitente Lo siento, brother, tengo el casoncio lleno e gente No te rayes - le contesto - y, fuera de contexto, resto Nueve menos dos son siete, increíble el gesto Don Guillempleado, vetado, lo echaron del reservado Se pira al prado y se corre mirando un cuadro doblado Doblado él, no el cuadro, ¿Champú o gel? Soy calvo Te ves muy bien, ¡Qué guapo!, ¿te pregunté?, ¡No, chato! Sabes que Poncio Pilato No se ha comprao los zapatos Viene descalzo el jabato Con los pelos del puto Arrebato Y ahora te tiro unas líneas sin dar muchos datos Son cosas banales, no de literatos La cosa es que vengo y me quedo pa un rato No miro el formato, te pongo el retrato Me vienen dos culos mulatos Dos culos bien grandes en un carromato Culitos de marca, no culos baratos Orondas las nalgas, bien anchos los anos Los cubre una tela del tipo satén La cosa es que huelen, y no huelen bien Estamos hablando de anos hediondos Estando en la calle producen asombro Por sus dimensiones, por su basta peste Subastan el fétido y étnico ambiente Qué asco, qué guarro, pa guarra tu hermana Se saca diez mocos por fin de semana Y emana de aquí cierta sabiduría: Si el culo es rojizo, muy mono sería Sorprende desnudo en la charcutería Mi abuelo Rogelio, con su brujería Del Día salía un guía, prendía la party Todo el mundo mano arriba and just move your body Son las fiestas de mi pueblo, vente, Maribel Se vino la Ana, se vino Susana, y la Magdalena también Recién me enteré de que un toxicómano Coma o no coma, se muere por verme Me llaman la droga, panoja in my pants, rayitas de esencia La demencia que es bélica y trágica, mágica Pito y huevito, tal cual Maduro a final del jornal ¡Yeah!, Ja Nada más que añadir, señores: Marca Patxingar Y espero que no pase otro año hasta el siguiente... ¡Con Dios!",1);
INSERT INTO Comentario(uname,fecha,cuerpo,DB_idEv) VALUES ("Abby","2021-03-21 12:19:12","So... Anyone up for some golf?",1);

INSERT INTO ImagenEvento VALUES(1,1);
INSERT INTO ImagenEvento VALUES(1,2);
INSERT INTO ImagenEvento VALUES(2,3);
INSERT INTO ImagenEvento VALUES(2,4);

--GRANT ALL PRIVILEGES ON SIBW.* TO 'webClient'@'%';
