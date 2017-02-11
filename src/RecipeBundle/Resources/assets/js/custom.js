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
            btnRemove = $('button[data-action="remove"]'),
            btnEdit = $('button[data-action="edit"]');

        btnAddIngredient.on('click', function(e) {
            e.preventDefault();

            var ingredientList = $('#ingredient-field'),
                newWidgetIngredient = ingredientList.attr('data-prototype'),
                newIngredient;

            newWidgetIngredient = newWidgetIngredient.replace(/__name__/g, options.ingcounter);
            options.ingcounter++;

            newWidgetIngredient = '<h6 class="label label-warning">' + options.ingcounter + ' Ingredients<span class="erase" data-btn="action" data-action="delete-ingredient" data-id="" data-num="' + options.ingcounter +  '">&times;</span></h6>' + newWidgetIngredient;
            newIngredient = $('<span class="col-md-6 col-xs-12 elem"></span>').html(newWidgetIngredient);
            newIngredient.appendTo(ingredientList);
        });
        btnRemove.on('click', function (e) {
            e.preventDefault();
            var recipeToRemove = parseInt($(this).attr('data-id'), 10) || null,
                typeRemove = $(this).attr('data-type') || 'recipe',
                whereRemove = $(this).attr('data-where') || 'listing',
                urlRemoveRecipe = options.basepath + '/recipe/remove/',
                removing = false;

            if ('recipe' == typeRemove && null !== recipeToRemove) {
                removing = confirm('Are you sure to remove the recipe?');
                if (removing) {
                    urlRemoveRecipe += recipeToRemove;
                    //DELETE not supported by all browser
                    var jXhr = $.ajax({
                        url     : urlRemoveRecipe,
                        dataType: 'json',
                        type    : 'DELETE'
                    }).done(function (data) {
                        if (!!data.removed) {
                            if('listing' != whereRemove){
                                setTimeout(function(){
                                    window.location.href = options.basepath + '/recipe/list';
                                }, 500);
                            } else{
                                $('div.recipe-content[data-recipe-id="' + recipeToRemove + '"]').fadeOut(300, function () {
                                    $(this).remove();
                                });
                            }
                        }
                    }).fail(function (jqXHR, textStatus) {
                        console.error("Houston they have a problem: " + textStatus);
                    });
                }
            }
        });

        btnEdit.on('click', function (e) {
            e.preventDefault();
            var recipeToEdit = parseInt($(this).attr('data-id'), 10) || null;
            if(null !== recipeToEdit){
                window.location.href = options.basepath + '/recipe/edit/' + recipeToEdit;
            }
        });

        $(document).on('click', 'span.erase[data-action="delete-ingredient"]', function(e) {
            e.preventDefault();
            var ingredientToRemove = parseInt($(this).attr('data-id'), 10) || null,
                idxIngredient = parseInt($(this).attr('data-num'), 10) || null,
                urlRemoveIngredient = options.basepath + '/ingredient/remove/',
                removing = false;

            if (null !== ingredientToRemove) {
                removing = confirm('Are you sure to remove this ingredient?');
                if (removing) {
                    urlRemoveIngredient += ingredientToRemove;
                    //DELETE not supported by all browser
                    var jXhr = $.ajax({
                        url     : urlRemoveIngredient,
                        dataType: 'json',
                        type    : 'DELETE'
                    }).done(function (data) {
                        if (!!data.removed) {
                            $('span.elem[data-id-ingredient="' + ingredientToRemove + '"]').fadeOut(300, function () {
                                $(this).remove();
                            });
                        }
                    }).fail(function (jqXHR, textStatus) {
                        console.error("Houston they have a problem: " + textStatus);
                    });
                }
            }
            if(null != idxIngredient){
                removing = confirm('Are you sure to remove this ingredient?');
                if (removing) {
                    $('span.elem[data-num="' + idxIngredient + '"]').fadeOut(300, function () {
                        $(this).remove();
                    });
                }
            }
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

    if('undefined' !== typeof ingredientsCounter) {
        InterfaceManage.setOption('ingcounter', ingredientsCounter);
    }
    InterfaceManage.setOption('basepath', _BASEURL);
});