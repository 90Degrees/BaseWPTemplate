/*global module:false*/
module.exports = function(grunt) {

  grunt.initConfig({

    pkg: grunt.file.readJSON('package.json'),
    
    project: {
      app: ['.'],
      assets: ['<%= project.app %>/assets'],
      bower: ['<%= project.assets %>/bower_components'],
      vendor: ['<%= project.assets %>/vendor'],
			sass: ['<%= project.assets %>/sass'],
			css: ['<%= project.app %>/css'],
      js: ['<%= project.app %>/js'],
      fonts: ['<%= project.app %>/fonts']
		},
    
    compass: {
      options: {
        //importPath: ['<%= project.bower %>/foundation/scss'],
      },
      dev: {
        options: {  
          sassDir: ['<%= project.sass %>'],
          cssDir: ['<%= project.css %>'],
          environment: 'development',
          //specify: 'main.scss'
        }
      },
      prod: {
        options: { 
          sassDir: ['<%= project.sass %>'],
          cssDir: ['<%= project.css %>'],
          environment: 'production',
          outputStyle: 'compressed',
          sourceMap: true,
          //specify: 'main.scss'
        }
      },
    },

    concat: {
      options: {
        banner: [
            '/*!',
            '<%= pkg.name %>',
            '<%= grunt.template.today("dd-mm-yyyy") %>',
            '*/\n'
        ].join('\n'),
        separator: '\n\n',
        stripBanners: true
      },
      dist: {
        files: {
          '<%= project.css %>/vendor.css': [
            '<%= project.vendor %>/**/*.css',
            '<%= project.fonts %>/**/*.css',
            '!**/*.min.css'
          ],
          '<%= project.js %>/vendor.js': [
            '<%= project.vendor %>/**/*.js',
            '<%= project.bower %>/**/*.js', 
            '!<%= project.bower %>/jquery/**/*.js',
            '!<%= project.bower %>/modernizr/**/*.js',
            '!**/*.min.js'
          ],
          '<%= project.js %>/app.js': [
            '<%= project.assets %>/js/**/*.js'
          ],
        }
      }
    },
    uglify: {
			options: {
				banner: [
            '/*!',
            '<%= pkg.name %>',
            '<%= grunt.template.today("dd-mm-yyyy") %>',
            '*/\n'
        ].join('\n')
			},
      dist: {
        files: {
          '<%= project.css %>/vendor.min.css': ['<%= project.css %>/vendor.css'],
          '<%= project.js %>/vendor.min.js': ['<%= project.js %>/vendor.js'],
          '<%= project.js %>/app.min.js': ['<%= project.js %>/app.js'],
        }
      }
    },
    jshint: {
      options: {
        devel: true,
        curly: true,
        eqeqeq: true,
        immed: true,
        latedef: true,
        newcap: true,
        noarg: true,
        sub: true,
        undef: true,
        unused: true,
        boss: true,
        eqnull: true,
        browser: true,
        globals: {
          jQuery: true
        }
      },
      gruntfile: {
        src: 'Gruntfile.js'
      }
    },
    watch: {
      compass: {
        files: ['<%= project.assets %>/sass/{,*/}*.{scss,sass}'],
        tasks: ['compass:dev']
      },
      js: {
        files: ['<%= project.assets %>/js/{,*/}*.js'],
        tasks: ['jshint', 'concat'],
      },
      livereload: {
        // Here we watch the files the sass task will compile to
        // These files are sent to the live reload server after sass compiles to them
        options: { 
          livereload: true 
        },
        files: ['**/*.php','css/**/*', 'js/**/*'],
      },
      gruntfile: {
        files: '<%= jshint.gruntfile.src %>',
        tasks: ['jshint:gruntfile']
      }
    }
  });

  // These plugins provide necessary tasks.
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-jshint');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-compass');
  
  // Default Task
  grunt.registerTask('default', ['concat', 'compass:dev', 'watch']);

  // Release Task
  grunt.registerTask('release', ['concat', 'uglify', 'compass:prod']);

};