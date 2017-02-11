module.exports = {
    options : {
        banner: '/*! <%= pkg.name %> - v<%= pkg.version %> - ' +
        '<%= grunt.template.today("yyyy-mm-dd") %> - by Stefano Frasca */',
    },
    frontend: {
        files: {
            '<%= assetBuildDir %>css/<%= pkg.name %>.min.css': [
                '<%= recipeAssetsDir %>css/components/jquery-ui.css',
                '<%= recipeAssetsDir %>css/components/bootstrap.min.css',
                '<%= recipeAssetsDir %>css/components/prettyPhoto.min.css',
                '<%= recipeAssetsDir %>css/components/font-awesome.min.css',
                '<%= recipeAssetsDir %>css/components/config.css',
                '<%= recipeAssetsDir %>css/style.css'
            ]
        }
    }
};