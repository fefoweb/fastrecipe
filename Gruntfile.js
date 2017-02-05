/**
 * Grunt main configuration file
 * @param grunt
 */
module.exports = function (grunt) {

    // measures the time each task takes
    require('time-grunt')(grunt);

    require('load-grunt-config')(grunt, {
        data       : { //data passed into config.  Can use with <%= pkg %>
            pkg          : grunt.file.readJSON('package.json'),
            sourceDir    : "./src/RecipeBundle/Resources/public/",
            assetBuildDir: "./web/assets/",
            vendorDir: "./vendor/",
            nodeModulesDir: "./node_modules/",
            recipeAssetsDir: "./src/RecipeBundle/Resources/assets/"
        },
        postProcess: function (config) {} //can post process config object before it gets passed to grunt
    });
    // A very basic default task.
    grunt.registerTask('log', 'Logging description', function () {
        grunt.log.write('Init fastRecipe frontend code deploy').ok();
    });

    /* LOAD GRUNT TASK */
    require('load-grunt-tasks')(grunt);
};