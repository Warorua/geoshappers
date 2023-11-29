module.exports = function(grunt) {
  require('jit-grunt')(grunt);

  grunt.initConfig({
    less: {
      development: {
        options: {
          compress: false,
          yuicompress: true,
          optimization: 2
        },
        files: {
          "css/theme.css": "less/theme.less" // destination file and source file
          "css/bdt-uikit.css": "less/bdt-uikit.less" // destination file and source file
        }
      }
    },
    rtlcss: {
      myTask:{
        // task options 
        options: {
          
          // rtlcss options 
          opts: {
            clean:false
          },
          // rtlcss plugins 
          plugins:[],
          // save unmodified files 
          saveUnmodified: true,
        },
        expand : true,
        cwd    : 'css/',
        dest   : 'css/',
        src    : ['**/*.css', '!**/*.rtl.css'],
        ext    : '.rtl.css'
      }
    },
    watch: {
      styles: {
        files: ['less/**/*.less'], // which files to watch
        tasks: ['less', 'rtlcss'],
        options: {
          nospawn: true
        }
      }
    }
  });

  grunt.registerTask('default', ['less', 'watch']);

  grunt.loadNpmTasks('grunt-rtlcss');
};