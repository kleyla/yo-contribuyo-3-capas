
CREATE DATABASE yo_contribuyo
DEFAULT CHARACTER  SET utf8;
USE yo_contribuyo;
CREATE TABLE usuarios (
  id_usuario INT NOT NULL UNIQUE AUTO_INCREMENT,
  nick VARCHAR(50) NOT NULL UNIQUE,
  email VARCHAR(255) NOT NULL UNIQUE,
  pass VARCHAR(255) NOT NULL,
  rol VARCHAR(20) NOT NULL,
  estado TINYINT NOT NULL DEFAULT 1,
  fecha DATETIME NOT NULL DEFAULT now(),
  PRIMARY KEY (id_usuario)
);

CREATE TABLE proyectos (
  id_proyecto INT NOT NULL UNIQUE AUTO_INCREMENT,
  usuario_id INT NOT NULL,
  nombre VARCHAR(255) NOT NULL,
  descripcion TEXT CHARACTER SET utf8 NOT NULL,
  repositorio VARCHAR(255) NOT NULL UNIQUE,
  tags TEXT CHARACTER SET utf8,
  estado TINYINT NOT NULL DEFAULT 1,
  fecha DATETIME NOT NULL DEFAULT now(),
  PRIMARY KEY (id_proyecto),
  FOREIGN KEY (usuario_id) REFERENCES usuarios(id_usuario) ON UPDATE CASCADE ON DELETE RESTRICT
);
CREATE TABLE lenguajes (
  id_lenguaje INT NOT NULL UNIQUE AUTO_INCREMENT,
  nombre VARCHAR(255) NOT NULL UNIQUE,
  link TEXT CHARACTER SET utf8 NOT NULL,
  estado TINYINT NOT NULL DEFAULT 1,
  fecha DATETIME NOT NULL DEFAULT now(),
  PRIMARY KEY (id_lenguaje)
);
CREATE TABLE proyecto_lenguaje (
  proyecto_id INT NOT NULL,
  lenguaje_id INT NOT NULL,
  PRIMARY KEY (proyecto_id, lenguaje_id),

  FOREIGN KEY (proyecto_id) REFERENCES proyectos(id_proyecto) ON UPDATE CASCADE ON DELETE RESTRICT,
  FOREIGN KEY (lenguaje_id) REFERENCES lenguajes(id_lenguaje) ON UPDATE CASCADE ON DELETE RESTRICT
  
);

CREATE TABLE articulos (
  id_articulo INT NOT NULL UNIQUE AUTO_INCREMENT,
  usuario_id INT NOT NULL,
  titulo VARCHAR(255) NOT NULL UNIQUE,
  contenido TEXT CHARACTER SET utf8 NOT NULL,
  estado TINYINT NOT NULL DEFAULT 1,
  fecha DATETIME NOT NULL DEFAULT now(),
  PRIMARY KEY (id_articulo),
  FOREIGN KEY (usuario_id) REFERENCES usuarios(id_usuario) ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE denuncia (
  articulo_id INT NOT NULL,
  usuario_id INT NOT NULL,
  razones VARCHAR(255) NOT NULL,
  estado TINYINT NOT NULL DEFAULT 1,
  fecha DATETIME NOT NULL DEFAULT now(),
  PRIMARY KEY (articulo_id, usuario_id),
  FOREIGN KEY (articulo_id) REFERENCES articulos(id_articulo) ON UPDATE CASCADE ON DELETE RESTRICT,
  FOREIGN KEY (usuario_id) REFERENCES usuarios(id_usuario) ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE acciones (
  id_accion INT NOT NULL UNIQUE AUTO_INCREMENT,
  usuario_id INT NOT NULL,
  proyecto_id INT NOT NULL,
  estado TINYINT NOT NULL DEFAULT 1,
  fecha DATETIME NOT NULL DEFAULT now(),
  PRIMARY KEY (id_accion),
  FOREIGN KEY (usuario_id) REFERENCES usuarios(id_usuario) ON UPDATE CASCADE ON DELETE RESTRICT,
  FOREIGN KEY (proyecto_id) REFERENCES proyectos(id_proyecto) ON UPDATE CASCADE ON DELETE RESTRICT
);
CREATE TABLE comentarios (
  -- id_comentario INT NOT NULL UNIQUE AUTO_INCREMENT,
  contenido TEXT CHARACTER SET utf8 NOT NULL,
  accion_id INT NOT NULL,
  PRIMARY KEY (accion_id),
  FOREIGN KEY (accion_id) REFERENCES acciones(id_accion) ON UPDATE CASCADE ON DELETE RESTRICT
);
CREATE TABLE favoritos (
  -- id_calificacion INT NOT NULL UNIQUE AUTO_INCREMENT,
  accion_id INT NOT NULL,
  -- estrellas FLOAT NOT NULL,
  PRIMARY KEY (accion_id),
  FOREIGN KEY (accion_id) REFERENCES acciones(id_accion) ON UPDATE CASCADE ON DELETE RESTRICT
);
-- DATA

-- USUARIOS
INSERT INTO usuarios(nick, email, pass, rol) VALUES ('leyla','leyla@live.com','96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 'Administrador');
INSERT INTO usuarios(nick, email, pass, rol) VALUES ('Noemy','noe@live.com','96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 'Administrador');
INSERT INTO usuarios(nick, email, pass, rol) VALUES ('alejandra','alejandra@live.com','96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 'Administrador');
INSERT INTO usuarios(nick, email, pass, rol) VALUES ('yolanda','landa@live.com','96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 'Contribuidor');

-- LENGUAJES
INSERT INTO lenguajes(nombre, link) VALUES ("Javascript",'https://www.javascript.com/');
INSERT INTO lenguajes(nombre, link) VALUES ("PHP",'https://www.php.net/');
INSERT INTO lenguajes(nombre, link) VALUES ("Go",'https://golang.org/');
INSERT INTO lenguajes(nombre, link) VALUES ("Assembly",'https://en.wikipedia.org/wiki/Assembly');
INSERT INTO lenguajes(nombre, link) VALUES ("Scala",'https://scala-lang.org/');
INSERT INTO lenguajes(nombre, link) VALUES ("C#",'https://ru.wikipedia.org/wiki/C_Sharp');
INSERT INTO lenguajes(nombre, link) VALUES ("Swift",'https://www.swift.com/');
INSERT INTO lenguajes(nombre, link) VALUES ("Perl",'https://www.perl.org/');
INSERT INTO lenguajes(nombre, link) VALUES ("Dart",'https://dart.dev/');
INSERT INTO lenguajes(nombre, link) VALUES ("Java",'https://www.java.com/es/');
INSERT INTO lenguajes(nombre, link) VALUES ("Vue",'https://vuejs.org/');
INSERT INTO lenguajes(nombre, link) VALUES ("Typescript",'https://www.typescriptlang.org/');
INSERT INTO lenguajes(nombre, link) VALUES ("CSS",'https://en.wikipedia.org/wiki/CSS');
INSERT INTO lenguajes(nombre, link) VALUES ("Ruby",'https://www.ruby-lang.org/es/');
INSERT INTO lenguajes(nombre, link) VALUES ("Kotlin",'https://kotlinlang.org/');
INSERT INTO lenguajes(nombre, link) VALUES ("Sass",'https://sass-lang.com/');
INSERT INTO lenguajes(nombre, link) VALUES ("Rust",'https://www.rust-lang.org/');
INSERT INTO lenguajes(nombre, link) VALUES ("Less",'http://lesscss.org/');
INSERT INTO lenguajes(nombre, link) VALUES ("C++",'https://www.cplusplus.com/doc/tutorial/');
INSERT INTO lenguajes(nombre, link) VALUES ("C",'https://en.wikipedia.org/wiki/C_(programming_language)');
INSERT INTO lenguajes(nombre, link) VALUES ("TeX",'https://en.wikipedia.org/wiki/TeX');
INSERT INTO lenguajes(nombre, link) VALUES ("Shell",'https://en.wikipedia.org/wiki/Shell_(computing)');
INSERT INTO lenguajes(nombre, link) VALUES ("Julia",'https://julialang.org/');
INSERT INTO lenguajes(nombre, link) VALUES ("HTML",'https://en.wikipedia.org/wiki/HTML');
INSERT INTO lenguajes(nombre, link) VALUES ("Python",'https://www.python.org/');
INSERT INTO lenguajes(nombre, link) VALUES ("R",'https://www.r-project.org/');

-- PROYECTOS
INSERT INTO proyectos(nombre, descripcion, repositorio, tags, usuario_id) VALUES ("Awesome for beginners", 'Impresionantes primeras oportunidades de Pull request. Una lista de proyectos increíbles para principiantes. Si es un mantenedor de proyectos de código abierto, agregue la etiqueta solo para principiantes a su proyecto y anótelo aquí para que la gente pueda encontrarlo. Si está buscando contribuir, explore esta lista, observe los problemas abiertos etiquetados solo para principiantes.', 'https://github.com/mungell/awesome-for-beginners','first-time-issue', 1);
INSERT INTO proyectos(nombre, descripcion, repositorio, tags, usuario_id) VALUES ("Awesome for non-programmers","Here comes a list of Open Source projects where you can contribute without any programming knowledge.","https://github.com/szabgab/awesome-for-non-programmers",'first-time-issue', 1);
-- INSERT INTO proyectos(nombre, descripcion, repositorio, tags, usuario_id) VALUES ("","","",,'first-time-issue', 1);

INSERT INTO proyecto_lenguaje(proyecto_id, lenguaje_id) VALUES ('1','1');
INSERT INTO proyecto_lenguaje(proyecto_id, lenguaje_id) VALUES ('1','2');
INSERT INTO proyecto_lenguaje(proyecto_id, lenguaje_id) VALUES ('1','3');
INSERT INTO proyecto_lenguaje(proyecto_id, lenguaje_id) VALUES ('1','4');
INSERT INTO proyecto_lenguaje(proyecto_id, lenguaje_id) VALUES ('1','5');
INSERT INTO proyecto_lenguaje(proyecto_id, lenguaje_id) VALUES ('1','6');
INSERT INTO proyecto_lenguaje(proyecto_id, lenguaje_id) VALUES ('1','7');
INSERT INTO proyecto_lenguaje(proyecto_id, lenguaje_id) VALUES ('1','8');
INSERT INTO proyecto_lenguaje(proyecto_id, lenguaje_id) VALUES ('1','9');
INSERT INTO proyecto_lenguaje(proyecto_id, lenguaje_id) VALUES ('1','10');
INSERT INTO proyecto_lenguaje(proyecto_id, lenguaje_id) VALUES ('1','11');
INSERT INTO proyecto_lenguaje(proyecto_id, lenguaje_id) VALUES ('1','12');
INSERT INTO proyecto_lenguaje(proyecto_id, lenguaje_id) VALUES ('1','13');
INSERT INTO proyecto_lenguaje(proyecto_id, lenguaje_id) VALUES ('1','14');
INSERT INTO proyecto_lenguaje(proyecto_id, lenguaje_id) VALUES ('1','15');
INSERT INTO proyecto_lenguaje(proyecto_id, lenguaje_id) VALUES ('1','16');
INSERT INTO proyecto_lenguaje(proyecto_id, lenguaje_id) VALUES ('1','17');
INSERT INTO proyecto_lenguaje(proyecto_id, lenguaje_id) VALUES ('1','18');
INSERT INTO proyecto_lenguaje(proyecto_id, lenguaje_id) VALUES ('1','19');
INSERT INTO proyecto_lenguaje(proyecto_id, lenguaje_id) VALUES ('1','20');
INSERT INTO proyecto_lenguaje(proyecto_id, lenguaje_id) VALUES ('2','10');
-- INSERT INTO proyecto_lenguaje(proyecto_id, lenguaje_id) VALUES ('3','');

-- ARTICULOS
INSERT INTO articulos(titulo, contenido, usuario_id) VALUES ("Qué significa contribuir?", "Si eres un colaborador de código abierto nuevo, el proceso puede ser intimidatorio. ¿Cómo encontrar el proyecto adecuado? ¿Qué hacer si no sabes cómo codificar? ¿Qué pasa si algo sale mal?

¡No debes preocuparte! Hay todo tipo de formas de involucrarse con un proyecto de código abierto, y unos pocos consejos te ayudarán a sacar el máximo provecho de tu experiencia.

**No necesitas contribuir con código**

Un error conceptual común acerca de contribuir con el código abierto es que debes contribuir con código. De hecho, son a menudo las otras partes de un proyecto las más descuidadas o pasadas por alto. ¡Le harás un enorme favor al proyecto si te ofreces a trabajar en este tipo de contribuciones!

**¿Te gusta planificar eventos?**

- Organiza workshops o reuniones acerca del proyecto, como hizo @fzamperin para NodeSchool
- Organiza la conferencia del proyecto (si es que tienen una)
- Ayuda a la comunidad de miembros a encontrar las conferencias apropiadas y a presentar propuestas para disertar

**¿Te gusta diseñar?**

- Reestructura los diseños para mejorar la usabilidad del proyecto
- Dirige la investigación de los usuarios para reorganizar y refinar la navegación del proyecto o sus menús, como lo sugiere Drupal
- Reúne una guía de estilos para ayudar al proyecto a tener un diseño con consistencia visual
- Crea diseños para las remeras o un nuevo logo, como hicieron los colaboradores de hapi.js’s

**¿Te gusta escribir?**

- Escribe y mejora la documentación del proyecto
- Sanea la carpeta de ejemplos para mostrar cómo se usa el proyecto
- Inicia el boletín informativo para el proyecto, o aspectos más destacados a enviar a la lista de correos
- Escribe tutoriales para el proyecto, como hicieron los colaboradores de pypa’s
- Escribe una traducción de la documentación del proyecto

**¿Te gusta ayudar a las personas?**

- Responde las preguntas acerca del proyecto en, por ejemplo, Stack Overflow (como este ejemplo Postgres) o en reddit
- Responde preguntas a las personas en los problemas abiertos
- Ayuda a moderar los foros de discusión o canales de conversación

**¿Te gusta ayudar a otros a programar?**

- Revisa el código que otras personas presentan
- Escribe tutoriales sobre cómo puede usarse un proyecto
- Ofrécete como tutor de otro colaborador, como lo hizo @ereichert para @bronzdocen on Rust", 2);

INSERT INTO articulos(titulo, contenido, usuario_id) VALUES ("Orientándote a un nuevo proyecto", "Para cualquier otra cosa distinta de una corrección de error tipográfico, contribuir con el código abierto es como caminar hacia un grupo de extraños en una fiesta. Si comienzas a hablar sobre las llamas, mientras ellos están muy involucrados en una discusión sobre el pez dorado, es probable que te miren de manera un poco extraña.

Antes de lanzarte con los ojos cerrados con tus propias sugerencias, comienza aprendiendo cómo leer a la sala. Si lo haces, aumentan las probabilidades de que tus ideas se noten y sean escuchadas.
**Anatomía de un proyecto de código abierto**

Todas las comunidades de código abierto son diferentes.
Luego de pasar años en un proyecto de código abierto significa que aprendiste a conocer un proyecto de código abierto. Si te mueves a un proyecto diferente encontrarás que el vocabulario, las normas, y los estilos de comunicación son completamente diferentes.
Dicho esto, muchos proyectos de código abierto siguen una estructura organizacional similar. Entender los roles de las diferentes comunidades y el proceso en general te ayudará a estar rapidamente orientado para cualquier proyecto nuevo.

Un proyecto de código abierto tiene los siguientes tipos de personas:

- **Autor:** La/s persona/s u organización que creó/crearon el proyecto.
- **Dueño:** La/s persona/s que tiene/n la propiedad administrativa sobre la organización o el repositorio(no siempre es la misma que el autor original)
- **Encargados:** Colaboradores que son responsables de dirigir la visión y la administrar aspectos organizacionales del proyecto. (Pueden también ser autores o dueños del proyecto.)
- **Colaboradores:** Cualquiera que haya contribuido con algo al proyecto.
- **Miembros de la comunidad:** Las personas que utilizan al proyecto. Pueden tener un rol activo en las conversaciones o expresar su opinión sobre la dirección que toma el proyecto.

Los proyectos más grandes pueden tener también subcomisiones o grupos de trabajo enfocados en tareas diferentes, como herramientas, priorización de urgencias, moderación de la comunidad, y organización de eventos. Busca en el sitio web del proyecto una página del “equipo”, o en su repositorio para encontrar la documentación política de gobierno, para encontrar esta documentación.

Un proyecto también tiene documentación. Estos archivos están normalmente listados en un nivel alto del repositorio.

- **LICENSE:** Por definición, cada proyecto de código abierto debe tener una licencia open source. Si el proyecto no tiene una licencia, entonces no es de código abierto.
- **README:** El archivo README es un manual de instrucción que da la bienvenida al proyecto a los nuevos miembros de la comunidad. Explica por qué el proyecto es útil y cómo comenzar.
- **CONTRIBUTING:** Mientras que el archivo READMES ayuda a las personas a usar el proyecto, el archivo CONTRIBUTING ayuda a las personas a contribuir con el proyecto. Explica qué tipo de contribuciones son necesarias y cómo llevar adelante el trabajo. Si bien no todos los proyectos tienen un archivo CONTRIBUTING, su presencia señala que se trata de un buen proyecto para contribuir.
- **CODE_OF_CONDUCT:** Sienta sólidas reglas sobre la conducta de los participantes asociados y ayuda a facilitar un entorno acogedor y amistoso. Si bien no todos los proyectos tienen un archivo CODE_OF_CONDUCT, su presencia señala que se trata de un buen proyecto para contribuir.
- **Otra documentación:** Puede haber documentación adicional, como tutoriales, recorridos o políticas de gobierno, especialmente en proyectos de mayor envergadura.

Finalmente, los proyectos de código abierto utilizan las siguientes herramientas para organizar la discusión. La lectura de estos archivos te darán una buena imagen de cómo piensa y trabaja la comunidad.

- **Seguidor de problemas (Issue tracker):** Es donde las personas discuten los problemas relacionados con el proyecto.
- **Pull requests:** Es donde las personas discuten y revisan los cambios que están en progreso.
- **Foros de discusión o lista de correos electrónicos:** Algunos proyectos pueden utilizar estos canales de conversación para tópicos de conversación (por ejemplo “Cómo hago para… o “Qué piensas sobre…“ en luga de reportes de errores o pedido de requerimientos). Otros utilizan un rastreador de problemas para todas las conversaciones.
- **Canal de chat síncrono:** Algunos proyectos utilizan canales de chat (como Slack o IRC) para conversaciones casuales, colaboración e intercambios rápidos.", 2);

INSERT INTO acciones(usuario_id, proyecto_id) VALUES(1,1);
INSERT INTO acciones(usuario_id, proyecto_id) VALUES(2,1);

INSERT INTO comentarios(accion_id, contenido) VALUES(1,'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sapiente harum laudantium soluta sunt, modi quas, saepe quis maiores inventore cum, nostrum veniam accusantium. Quos dolorem consequatur similique explicabo enim? Esse.');
INSERT INTO comentarios(accion_id, contenido) VALUES(2,'Holier');

INSERT INTO acciones(usuario_id, proyecto_id) VALUES(1,1);
INSERT INTO acciones(usuario_id, proyecto_id) VALUES(2,1);

INSERT INTO favoritos(accion_id) VALUES(3);
INSERT INTO favoritos(accion_id) VALUES(4);


