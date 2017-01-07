module.exports = function(grunt) {

  /**
   * FIles added to WordPress SVN, don't inlucde 'assets/**' here.
   * @type {Array}
   */
  svn_files_list = [
    'admin/**',
    'includes/**',
    'languages/**',
    'public/**',
    '<%= pkg.main_file %>',
    'readme.txt',
    'uninstall.php',
    'index.php',
  ];

  /**
   * Let's add a couple of more files to github.
   * @type {Array}
   */
  git_files_list = svn_files_list.concat([
    '\.gitattributes',
    '\.gitignore',
    'Gruntfile.js',
    'package.json'
  ]);

  // Project configuration.
 grunt.initConfig({
    pkg: grunt.file.readJSON( 'package.json' ),
    clean: {
      post_build: [
        'build'
      ]
    },    
    checkDependencies: {
        this: {
            options: {
                install: true,
            },
        },
      },
    copy: {
      build_it:{
        options: {
          mode: true
        },
        expand: true,
        src: svn_files_list,
        dest: 'build/<%= pkg.name %>/'
      },
      svn_trunk: {
        options: {
          mode: true
        },
        expand: true,
        src: svn_files_list,
        dest: 'build/<%= pkg.name %>/trunk/'
      },
      svn_tag: {
        options: {
          mode: true
        },
        expand: true,
        src: svn_files_list,
        dest: 'build/<%= pkg.name %>/tags/<%= pkg.version %>/'
      }
    },
    gittag: {
      addtag: {
        options: {
          tag: 'v<%= pkg.version %>',
          message: 'Version <%= pkg.version %>'
        }
      }
    },
    gitcommit: {
      commit: {
        options: {
          message: 'Version <%= pkg.version %>',
          noVerify: true,
          noStatus: false,
          allowEmpty: true
        },
      },
      files: {
        src: [ git_files_list ]
      }
    },
    gitpush:{
      push: {
        options: {
          tags: true,
          remote: 'origin',
          branch: 'master'
        }
      }
    },
    "file-creator": {
        "folder": {
          ".gitattributes": function(fs, fd, done) {
              var glob = grunt.file.glob;
              var _ = grunt.util._;
          fs.writeSync(fd, '# We don\'t want these files in our "plugins.zip", so tell GitHub to ignore them when the user click on Download ZIP'  + '\n');
              _.each(git_files_list.diff(svn_files_list) , function(filepattern) {
                glob.sync(filepattern, function(err,files) {
                    _.each(files, function(file) {
                        fs.writeSync(fd, '/' + file + ' export-ignore'  + '\n');
                    });
                });
              });
          }
        }
    },
    replace: {
      readme_txt: {
        src: [ 'readme.txt' ],
        overwrite: true,
        replacements: [{
          from: /Stable tag: (.*)/,
          to: "Stable tag: <%= pkg.version %>"
        }]
      },
      'plugin_file': {
        src: [ '<%= pkg.main_file %>' ],
        overwrite: true,
        replacements: [{
          from: /\*\s*Version:\s*(.*)/,
          to: "* Version:         <%= pkg.version %>"
        }]
      }
    },
    svn_export: {
      dev: {
        options:{
          repository: 'https://plugins.svn.wordpress.org/<%= pkg.name %>',
          output: 'build/<%= pkg.name %>'
        }
      }
    },
    push_svn:{
      options: {
        remove: true
      },
      main: {
        src: 'build/<%= pkg.name %>',
        dest: 'https://plugins.svn.wordpress.org/<%= pkg.name %>',
        tmp: 'build/make_svn',
      }
    },
    makepot: {
      target: {
        options: {
          domainPath: '/languages',
          mainFile: '<%= pkg.main_file %>',
          potFilename: '<%= pkg.name %>.pot',
          processPot: function( pot, options ) {
            return pot;
          },
          type: 'wp-plugin',
          updateTimestamp: true,
          exclude: [
            'lib/.*',
            'node_modules/.*'
          ]
        }
      }
    },
    addtextdomain: {
      options: {
            updateDomains: true,// List of text domains to replace.
        },
      target: {
        files: {
          src: [
            '*.php',
            '**/*.php',
            '!lib/.*',
            '!node_modules/**',
            '!vendors/**'
          ]
        }
      }
    }
});
 

  grunt.loadNpmTasks( 'grunt-contrib-clean' );
  grunt.loadNpmTasks( 'grunt-contrib-copy' );
  grunt.loadNpmTasks( 'grunt-git' );
  grunt.loadNpmTasks( 'grunt-text-replace' );
  grunt.loadNpmTasks( 'grunt-svn-export' );
  grunt.loadNpmTasks( 'grunt-push-svn' );
  grunt.loadNpmTasks( 'grunt-wp-i18n' );
  grunt.loadNpmTasks( 'grunt-file-creator' );
  grunt.loadNpmTasks( 'grunt-contrib-uglify' );
  grunt.loadNpmTasks('grunt-contrib-cssmin');
  grunt.loadNpmTasks('grunt-check-dependencies');

  grunt.registerTask( 'default', ['addtextdomain'] );
  grunt.registerTask( 'minify', [ 'uglify', 'cssmin' ] );
  grunt.registerTask( 'version_number', [ 'replace:readme_txt', 'replace:plugin_file' ] );
  grunt.registerTask( 'pre_vcs', [ 'version_number', 'makepot', 'addtextdomain' ] );
  grunt.registerTask( 'gitattributes', [ 'file-creator' ] );

  grunt.registerTask( 'do_svn', [ 'svn_export', 'copy:svn_trunk', 'copy:svn_tag', 'push_svn' ] );
  grunt.registerTask( 'do_git', [  'gitcommit', 'gittag', 'gitpush' ] );
  grunt.registerTask( 'release', [ 'pre_vcs', 'do_svn' ] );
  grunt.registerTask( 'post_release', [ 'do_git', 'clean:post_build' ] );
  grunt.registerTask( 'build', [ 'copy','clean:post_build'  ] );

};

/**
 * Helper
 */
// from http://stackoverflow.com/a/4026828/1434155
Array.prototype.diff = function(a) {
    return this.filter(function(i) {return a.indexOf(i) < 0;});
};