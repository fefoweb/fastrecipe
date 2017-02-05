module.exports = {
	script_js: {
		files: ['<%= recipeAssetsDir %>js/**.js'],
		tasks: ['uglify','shell'],
		options: {
			spawn: false
		}
	},
	css: {
		files: ['<%= recipeAssetsDir %>css/**.css'],
		tasks: ['cssmin','shell'],
		options: {
			spawn: false
		}
	},
	twig: {
		files: ['src/RecipeBundle/Resources/views/**.twig', 'app/Resources/views/**.twig'],
		tasks: ['shell'],
		options: {
			spawn: false
		}
	},
};