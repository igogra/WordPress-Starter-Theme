module.exports = function(grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        'bower-install-simple': {
            dist: {
                options: {
                    production: true
                }
            },
            dev: {
                options: {
                    production: false
                }
            }
        },

        bowercopy: {
            options: {
                srcPrefix: 'bower_components'
            },
            php: {
                options: {
                    destPrefix: 'inc'
                },
                files: {
                    'aq_resizer.php': 'Aqua-Resizer/aq_resizer.php'
                }
            },
            js: {
                options: {
                    destPrefix: 'js/src'
                },
                files: {
                    'bootstrap.js': 'bootstrap-sass/assets/javascripts/bootstrap.js',
                    'lazyload.js': 'jquery_lazyload/jquery.lazyload.js'
                }
            },
            sass: {
                options: {
                    destPrefix: 'sass'
                },
                files: {
                    '_bootstrap.scss': 'bootstrap-sass/assets/stylesheets/_bootstrap.scss',
                    'bootstrap': 'bootstrap-sass/assets/stylesheets/bootstrap/*.scss',
                    'bootstrap/mixins': 'bootstrap-sass/assets/stylesheets/bootstrap/mixins/*.scss'
                }
            }
        },

        phplint: {
            files: ['**/*.php']
        },

        scsslint: {
            files: ['sass/main.scss']
        },

        jshint: {
            options: {
                jshintrc: '.jshintrc'
            },
            files: ['Gruntfile.js', 'js/src/main.js']
        },

        sass: {
            dev: {
                options: {
                    sourcemap: 'none'
                },
                files: {
                    'css/src/main.css': 'sass/main.scss',
                }
            }
        },

        cssmin: {
            dist: {
                files: [{
                    expand: true,
                    cwd: 'css/src',
                    src: ['*.css', '!*.min.css'],
                    dest: 'css/dist',
                    ext: '.min.css'
                }]
            }
        },

        uglify: {
            dist: {
                files: [{
                    expand: true,
                    cwd: 'js/src',
                    src: ['*.js', '!*.min.js'],
                    dest: 'js/dist',
                    ext: '.min.js'
                }]
            }
        },

        watch: {
            options: {
                livereload: true
            },
            php: {
                files: ['**/*.php'],
                tasks: ['phplint']
            },
            css: {
                files: ['sass/**/*.scss'],
                tasks: ['scsslint', 'sass', 'cssmin']
            },
            js: {
                files: ['js/*.js'],
                tasks: ['jshint', 'uglify']
            }
        },

        imagemin: {
            dist: {
                files: [{
                    expand: true,
                    cwd: 'img/src',
                    src: ['*.{png,jpg,gif}'],
                    dest: 'img/dist'
                }]
            }
        }
    });

    grunt.loadNpmTasks('grunt-bower-install-simple');
    grunt.loadNpmTasks('grunt-bowercopy');
    grunt.loadNpmTasks('grunt-phplint');
    grunt.loadNpmTasks('grunt-scss-lint');
    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-imagemin');

    grunt.registerTask('dev', ['bower-install-simple:dev', 'bowercopy', 'sass', 'cssmin', 'uglify', 'imagemin']);
    grunt.registerTask('default', ['phplint', 'scsslint', 'jshint', 'sass', 'cssmin', 'uglify', 'watch']);
    grunt.registerTask('dist', ['scsslint', 'jshint', 'sass', 'cssmin', 'uglify', 'imagemin']);
};
