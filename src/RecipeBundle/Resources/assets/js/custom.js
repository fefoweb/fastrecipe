var UIManager = function() {
    var options;

    var init = function(opt) {
        options = opt || {};
        eventHandler();
    };
    var addOption = function(key, value) {
        options[key] = value;
    };
    var eventHandler = function() {
        toTopHandler();
        $('.my-tooltip').tooltip();
        addRecipeHandler();
    };
    var addRecipeHandler = function() {
        var btnAddIngredient = $('#btnAddIngredient'),
            btnRemoveRecipe = $('#recipe_remove');

        btnAddIngredient.on('click', function(e) {
            e.preventDefault();

            var ingredientList = $('#ingredient-field'),
                newWidgetIngredient = ingredientList.attr('data-prototype'),
                newIngredient;

            newWidgetIngredient = newWidgetIngredient.replace(/__name__/g, options.ingcounter);
            options.ingcounter++;

            newWidgetIngredient = '<h6 class="label label-warning">' + options.ingcounter + ' Ingredients<span class="erase" data-btn="action" data-action="delete-ingredient" data-id="">&times;</span></h6>' + newWidgetIngredient;
            newIngredient = $('<span class="col-md-6 col-xs-12 elem"></span>').html(newWidgetIngredient);
            newIngredient.appendTo(ingredientList);
        });
        btnRemoveRecipe.on('click', function(e){
            var recipeToRemove = parseInt($(this).attr('data-id'), 10);
            //TODO IMPLEMENTARE
            alert('RIMUOVERE LA RICETTA' + recipeToRemove);
        });

        $(document).on('click', 'span.erase[data-action="delete-ingredient"]', function(e) {
            alert("cancello!");
        });
    };
    var toTopHandler = function() {
        var btnToTop = $(".totop");
        btnToTop.hide();

        $(window).scroll(function() {
            if ($(this).scrollTop() > 300) {
                btnToTop.fadeIn();
            } else {
                btnToTop.fadeOut();
            }
        });
        btnToTop.find('a').click(function(e) {
            e.preventDefault();
            $("html, body").animate({ scrollTop: 0 }, "slow");
            return false;
        });
    };
    return {
        'load': init,
        'setOption': addOption
    }
};
var InterfaceManage;
$(document).ready(function() {
    InterfaceManage = new UIManager();
    InterfaceManage.load();

    InterfaceManage.setOption('ingcounter', ingredientsCounter);
});