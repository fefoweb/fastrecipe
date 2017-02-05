module.exports = {
    options: {
        banner  : '/*!\n* <%= pkg.name %> - v<%= pkg.version %>' +
        '\n* deploy: <%= grunt.template.today("yyyy-mm-dd") %>\n* author: Stefano Frasca\n*/\n',
        compress: {
            drop_console: false
        }
    },
    recipe : {
        files: {
            '<%= assetBuildDir %>js/<%= pkg.name %>.min.js': [
                '<%= nodeModulesDir %>jquery/dist/jquery.min.js',
                '<%= recipeAssetsDir %>js/lib/bootstrap.min.js',
                '<%= recipeAssetsDir %>js/lib/jquery.prettyPhoto.js',
                '<%= recipeAssetsDir %>js/lib/respond.min.js',
                '<%= recipeAssetsDir %>js/lib/html5shiv.js',
                '<%= recipeAssetsDir %>js/custom.js',
            ]
        }
    }
};