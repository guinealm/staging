5. Área de trabajo: jumalenin-staging

Para:

staging.jumalenin.com

Carpeta local:

C:\Users\...\Proyectos\jumalenin-staging

Repositorio GitHub:

guinealm/jumalenin-staging

Uso:

temas privados;
temas semiprivados;
páginas con acceso restringido;
pruebas no públicas.

8. Estructura de staging.jumalenin.com

Este es diferente: privado o semiprivado. No lo mezclaría con support.

jumalenin-staging/
│
├── index.html
├── README.md
├── AGENTS.md
│
├── assets/
│   ├── css/
│   ├── js/
│   ├── img/
│   └── data/
│
├── private/
│   └── tema-actual/
│       ├── index.html
│       ├── assets/
│       └── docs/
│
└── docs/
    ├── control-acceso.md
    └── temas-privados.md

Aquí usaría acceso restringido desde Hostinger, por ejemplo:

protección por contraseña del directorio;
o restricción mediante panel de hosting;
o una página no enlazada públicamente, aunque esto no es seguridad real.

Para contenido realmente privado, mejor contraseña.