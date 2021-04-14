<?php
    require_once "/usr/local/lib/php/vendor/autoload.php";

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    if($_GET['ev'] == 'xbox'){

        $event = array(
            "title" => "xBoX",
            "organizer" => "Microsoft corporation",
            "date" => "Wednesday, June 13 - 11:00pm PDT",
            "description" => "XBOX Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus laborum obcaecati optio totam architecto, sequi minima nemo veritatis ex blanditiis iusto aspernatur quos vel ipsam reprehenderit illo corrupti excepturi enim, quaerat magnam quis repudiandae. Facilis officia, delectus maxime esse modi distinctio a cupiditate, inventore amet quibusdam debitis perspiciatis laborum minima, voluptatibus odio? Labore harum necessitatibus rerum, quidem quod fugit vitae voluptas similique minima eius pariatur excepturi dicta qui corporis iste aspernatur, incidunt quia non! Quaerat, eaque. Eius fugiat saepe architecto nesciunt commodi eveniet accusamus, ad sit, error magni nemo eaque obcaecati sed! Tempore, aliquid quibusdam, impedit officia, perspiciatis odit id quo ut minima quidem dignissimos! Tempora quaerat atque ullam saepe corrupti esse amet doloribus consequuntur, cum perferendis laboriosam porro earum debitis, maiores, ad nulla hic repellendus itaque veritatis soluta harum beatae unde et praesentium. Laudantium vel voluptas perferendis. Repudiandae vero exercitationem corporis similique temporibus in corrupti odit minima inventore sapiente esse doloremque quam facere veritatis modi, quis perspiciatis doloribus est quod vel quaerat molestiae consectetur eaque architecto. Cumque deserunt consequuntur labore iusto aut incidunt. Beatae doloribus tempore doloremque quaerat, cumque molestiae vero perferendis fuga deserunt officiis quae facilis fugiat. Aliquam culpa, eaque sunt laborum placeat enim pariatur nam quibusdam itaque ipsam cum repellat? Corrupti sequi maxime ad ratione provident mollitia, ipsa aut dicta labore autem hic cumque iusto laudantium, exercitationem magnam consectetur eligendi illo tempora voluptatem repudiandae qui nulla in. Placeat exercitationem reprehenderit quas sed et ipsa? Minima officiis, labore doloribus aspernatur in ut amet iste impedit incidunt, ipsum voluptates minus eveniet itaque debitis consectetur eum non iusto omnis nisi quo doloremque ullam eaque ducimus autem? Facere dolorum temporibus, mollitia iure quis, ea consectetur quisquam recusandae at sequi ducimus voluptate dicta. Architecto necessitatibus amet, quis aut provident totam quae quas laudantium vel omnis laboriosam veniam similique deserunt cupiditate odit iusto voluptas eos perspiciatis atque ratione minus. Nam dolore quaerat ex voluptatum ullam cum soluta amet dolor placeat dolorum similique animi sint dicta alias facere architecto aliquid, delectus nemo unde eaque? Odit provident eum totam, a laudantium perspiciatis aliquid culpa delectus sequi eius numquam natus vero at nihil soluta neque, exercitationem porro ipsa? Nihil asperiores numquam voluptates consequuntur neque officia laborum culpa nostrum quaerat perspiciatis tempore odit labore, eos nemo vero dolorem earum esse delectus in non? Et adipisci itaque molestias reprehenderit pariatur dignissimos vel repellat saepe obcaecati optio ipsa nesciunt a dolorum fugiat sequi laboriosam nobis repellendus, neque debitis impedit dolorem omnis? Quaerat optio porro debitis cum perspiciatis, ducimus veniam accusantium. Sint deserunt iure nesciunt, error, odit at reprehenderit beatae illum eligendi eius sed! Illo, quidem nisi dolorem reprehenderit repellendus aperiam itaque dolorum quos adipisci ratione vel a cupiditate perspiciatis delectus culpa exercitationem quasi, quo est, qui soluta id. Placeat animi itaque molestiae consequuntur omnis, ut culpa vitae exercitationem doloribus asperiores beatae debitis, repudiandae non. Quae vitae consequuntur, maiores vero ullam sunt? Velit hic consequatur, sunt omnis accusantium ipsam minus est aspernatur, tempore distinctio unde aperiam similique praesentium? Accusantium doloremque, maxime labore ipsam magni aspernatur eos exercitationem esse recusandae, sint, soluta repudiandae dolor illum nisi optio quibusdam eum obcaecati reiciendis? Sapiente, quasi nesciunt molestias nostrum totam expedita labore qui ratione amet. Optio aperiam qui consequatur velit voluptatibus recusandae, debitis ex laboriosam corrupti quos veniam sit voluptas illo tempore facere? Nam esse incidunt ex vitae id beatae hic nemo corrupti dolorem mollitia, ipsa aut animi ratione voluptatibus accusamus et dolores temporibus error suscipit!",
            "href" => "https://www.xbox.com/en-US/",
        );
    }
    else if($_GET['ev'] == 'playstation'){
        $event = array(
            "title" => "plAystaTIOn",
            "organizer" => "Sony Corporation",
            "date" => "Monday, June 11 - 9:00pm PDT",
            "description" => "Play Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus laborum obcaecati optio totam architecto, sequi minima nemo veritatis ex blanditiis iusto aspernatur quos vel ipsam reprehenderit illo corrupti excepturi enim, quaerat magnam quis repudiandae. Facilis officia, delectus maxime esse modi distinctio a cupiditate, inventore amet quibusdam debitis perspiciatis laborum minima, voluptatibus odio? Labore harum necessitatibus rerum, quidem quod fugit vitae voluptas similique minima eius pariatur excepturi dicta qui corporis iste aspernatur, incidunt quia non! Quaerat, eaque. Eius fugiat saepe architecto nesciunt commodi eveniet accusamus, ad sit, error magni nemo eaque obcaecati sed! Tempore, aliquid quibusdam, impedit officia, perspiciatis odit id quo ut minima quidem dignissimos! Tempora quaerat atque ullam saepe corrupti esse amet doloribus consequuntur, cum perferendis laboriosam porro earum debitis, maiores, ad nulla hic repellendus itaque veritatis soluta harum beatae unde et praesentium. Laudantium vel voluptas perferendis. Repudiandae vero exercitationem corporis similique temporibus in corrupti odit minima inventore sapiente esse doloremque quam facere veritatis modi, quis perspiciatis doloribus est quod vel quaerat molestiae consectetur eaque architecto. Cumque deserunt consequuntur labore iusto aut incidunt. Beatae doloribus tempore doloremque quaerat, cumque molestiae vero perferendis fuga deserunt officiis quae facilis fugiat. Aliquam culpa, eaque sunt laborum placeat enim pariatur nam quibusdam itaque ipsam cum repellat? Corrupti sequi maxime ad ratione provident mollitia, ipsa aut dicta labore autem hic cumque iusto laudantium, exercitationem magnam consectetur eligendi illo tempora voluptatem repudiandae qui nulla in. Placeat exercitationem reprehenderit quas sed et ipsa? Minima officiis, labore doloribus aspernatur in ut amet iste impedit incidunt, ipsum voluptates minus eveniet itaque debitis consectetur eum non iusto omnis nisi quo doloremque ullam eaque ducimus autem? Facere dolorum temporibus, mollitia iure quis, ea consectetur quisquam recusandae at sequi ducimus voluptate dicta. Architecto necessitatibus amet, quis aut provident totam quae quas laudantium vel omnis laboriosam veniam similique deserunt cupiditate odit iusto voluptas eos perspiciatis atque ratione minus. Nam dolore quaerat ex voluptatum ullam cum soluta amet dolor placeat dolorum similique animi sint dicta alias facere architecto aliquid, delectus nemo unde eaque? Odit provident eum totam, a laudantium perspiciatis aliquid culpa delectus sequi eius numquam natus vero at nihil soluta neque, exercitationem porro ipsa? Nihil asperiores numquam voluptates consequuntur neque officia laborum culpa nostrum quaerat perspiciatis tempore odit labore, eos nemo vero dolorem earum esse delectus in non? Et adipisci itaque molestias reprehenderit pariatur dignissimos vel repellat saepe obcaecati optio ipsa nesciunt a dolorum fugiat sequi laboriosam nobis repellendus, neque debitis impedit dolorem omnis? Quaerat optio porro debitis cum perspiciatis, ducimus veniam accusantium. Sint deserunt iure nesciunt, error, odit at reprehenderit beatae illum eligendi eius sed! Illo, quidem nisi dolorem reprehenderit repellendus aperiam itaque dolorum quos adipisci ratione vel a cupiditate perspiciatis delectus culpa exercitationem quasi, quo est, qui soluta id. Placeat animi itaque molestiae consequuntur omnis, ut culpa vitae exercitationem doloribus asperiores beatae debitis, repudiandae non. Quae vitae consequuntur, maiores vero ullam sunt? Velit hic consequatur, sunt omnis accusantium ipsam minus est aspernatur, tempore distinctio unde aperiam similique praesentium? Accusantium doloremque, maxime labore ipsam magni aspernatur eos exercitationem esse recusandae, sint, soluta repudiandae dolor illum nisi optio quibusdam eum obcaecati reiciendis? Sapiente, quasi nesciunt molestias nostrum totam expedita labore qui ratione amet. Optio aperiam qui consequatur velit voluptatibus recusandae, debitis ex laboriosam corrupti quos veniam sit voluptas illo tempore facere? Nam esse incidunt ex vitae id beatae hic nemo corrupti dolorem mollitia, ipsa aut animi ratione voluptatibus accusamus et dolores temporibus error suscipit!",
            "href" => "https://www.playstation.com/en-us",
        );
    }
    $textImgs = array(
        array(
            "href" => "https://www.343industries.com/",
            "src" => "templates/images/343-logo.png",
            "alt" => "343 Industries Logo",
            "id" => "industries-logo",
        ),
        array(
            "href" => "https://www.obsidian.net/",
            "src" => "templates/images/obsidian-logo.png",
            "alt" => "Obsidian Entertainment",
            "id" => "obsidian-logo",
        ),
    );
    $comments = array(
        array(
            "author" => "Enrique Montilla",
            "date" => "10-04-2021  20:35",
            "body" => "No vea que hambre
                Que hambre
                Que hambre
                Que hambre
                Estoy canino
                
                Son la ocho y media me voy a levantar
                Hermano vaya hambre toca desayunar
                Me voy a se un bocata que eso va a ser ilegal
                Eh esto lo que suelen llamar felicidad
                
                Me lavo la cara con to el arte
                Hoy va ser la polla lo veo venir
                Nada ni nadie podrá pararme
                La putada fue cuando el armario abrí
                
                No hay pan
                No hay pan
                
                Y que desayuno yo?
                Yo, yo
                Donde pongo yo el jamón?
                Elja-mon
                Loco vaya putadon
                Illo, illo
                Toy sin ganas de vivir
                De vivir
                Creo que me voy a desnutrir
                Illo, illo
                La panza empieza a rugir
                Es el fin
                
                Un sándwich
                Yo lo que quiero eh un sándwich
                Un sándwich, un sándwich
                Un sándwich, un sándwich
                No es mucho pedir
                
                Un sándwich
                Yo lo que quiero eh un sándwich
                Un sándwich, un sándwich
                Un sándwich, un sándwich
                No es mucho pedir
                
                Llamo a la mama
                Le comento to el drama y a la ve me doy
                Cuenta que no hay mermelada
                Esto es mas grave de lo que yo pensaba
                Creo que me voy a ahogar con la almohada
                
                Se acaba aquí
                Voy a hacer a toa esa gente feliz
                Esa peña se merece un sándwich
                Si yo no pueo tenerlo al menos tu si
                
                No hay pan
                No hay pan
                
                Y que desayuno yo?
                Yo, yo
                Donde pongo yo el jamón?
                Elja-mon
                Loco vaya putadon
                Illo, illo
                Toy sin ganas de vivir
                De vivir
                Creo que me voy a desnutrir
                Illo, illo
                La panza empieza a rugir
                Es el fin
                
                Un sándwich
                Yo lo que quiero eh un sándwich
                Un sándwich, un sándwich
                Un sándwich, un sándwich
                No es mucho pedir
                
                Un sándwich
                Yo lo que quiero eh un sándwich
                Un sándwich, un sándwich
                Un sándwich, un sándwich
                Aunque sea salami",
        ),
        array(
            "author" => "Don Mattrick",
            "date" => "14-04-2021  11:41",
            "body" => "El Kinect lo mejor de verdad hacedme caso que lo petamos",
        ),
    );

    echo $twig->render('/html/evento.html.twig',['event' => $event, 'textImgs' => $textImgs, 'comments' => $comments]);
?>