
( function() {
  var app = angular.module( 'foro', [] );

  //Controlador encargo de manejar datos del usuario
  app.controller( 'ControladorAlumno', function() {
    this.alumno = alumno;
  } );

  //Controlador encargado de manejar las etiquetas
  app.controller( 'ControladorEtiquetas', function() {
    this.etiquetas = etiquetas;
  } );

  //Controlador encargado de manejar los temas que hay en un foro
  app.controller( 'ControladorForo', function() {
    this.foro = foro;
  } );

  var foro = { nombre_foro: 'Harambe',
              temas_foro: [ {
                              nombre_tema: '¿Que es un harambe?'
                            },
                            {
                              nombre_tema: 'Pururu'
                            },
                            {
                              nombre_tema: 'MapLab'
                            }]

              };

  var alumno = { nombre: 'JuanitoPeres',
                 matricula: '10003899',
                 carrera: 'LIS',
                 favoritos: [ {
                   nombre_preg : '¿Que es un harambe?',
                   num_res: '789',
                   certeza: 'Maxima',
                   tag: 'Ciencia',
                   relevancia : '4'
                 },{
                   nombre_preg : '¿Que es un maplab?',
                   num_res: '789',
                   certeza: 'Maxima',
                   tag: 'conocimiento general',
                   relevancia : '4'
                 } ]};

    var etiquetas = [ { tag: 'Calculo',
                        tipo_tag: 'btn-primary',
                        descripcion: 'Enfocado a dudas de calculo integral y diferencial',
                        num_temas: '45'
                      },
                      { tag: 'Calculo',
                        tipo_tag: 'btn-well',
                        descripcion: 'Enfocado a dudas de calculo integral y diferencial',
                        num_temas: '45'
                      },
                      { tag: 'Calculo',
                        tipo_tag: 'btn-info',
                        descripcion: 'Enfocado a dudas de calculo integral y diferencial',
                        num_temas: '45'
                      },
                      { tag: 'Calculo',
                        tipo_tag: 'btn-danger',
                        descripcion: 'Enfocado a dudas de calculo integral y diferencial',
                        num_temas: '45'
                      }];
} )();
