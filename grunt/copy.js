module.exports = {
    images: {
        expand: true,
        cwd: '<%= recipeAssetsDir %>',
        src: ['img/**'],
        dest: '<%= assetBuildDir %>',
        flatten: false,
        filter: 'isFile'
    },
    font: {
        expand: true,
        cwd: '<%= recipeAssetsDir %>',
        src: ['fonts/**'],
        dest: '<%= assetBuildDir %>',
        flatten: false,
        filter: 'isFile'
    },
    css: {
        expand: true,
        cwd: '<%= recipeAssetsDir %>',
        src: ['css/ie-style.css'],
        dest: '<%= assetBuildDir %>css',
        flatten: true
    }
};
