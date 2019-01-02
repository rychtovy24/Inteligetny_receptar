<?php
/**
 * Created by PhpStorm.
 * User: rycht
 * Date: 29. 12. 2018
 * Time: 13:52
 */

return [
    'userUri' => 'http://127.0.0.1:8000/users/',
    'recipeUri' => 'http://127.0.0.1:8000/recipes/',
    'measure' => array(
        'l', 'dl', 'ml',
        'kg', 'g', 'mg', 'piece'
    ),
    'measure_recipe' => array(
        'l', 'dl', 'ml',
        'kg', 'g', 'mg', 'piece','pound', 'ounce',
        'teaspoon', 'tablespoon', 'dessertspoon',
        'gill', 'cup', 'piece', 'pint', 'quart', 'gallon'
    ),
    'hasFood' => new EasyRdf_Resource('http://webprotege.stanford.edu/RuNd2NeHnHVvpluzNdD8z5'),
    'hasIngredient' => new EasyRdf_Resource('http://webprotege.stanford.edu/RBwblvGC0EObTN3NFz6IjP5'),
    'count' => new EasyRdf_Resource('http://webprotege.stanford.edu/count'),
    'metric_quantity' => new EasyRdf_Resource('http://purl.org/ontology/fo/metric_quantity'),
    'hasIngredientList' => new EasyRdf_Resource('http://webprotege.stanford.edu/RQLjz93GfBm42rpVfzF1mB'),
    'hasQuantity' => new EasyRdf_Resource('https://schema.org/hasQuantity'),
    'hasDescription' => new EasyRdf_Resource('http://webprotege.stanford.edu/RDhCZtQsVsCV8TUZvwuht6z'),
    'hasAnAuthor' => new EasyRdf_Resource('http://webprotege.stanford.edu/R70lHXU7IVm0MMHWVTEaRIs'),
    'RECIPE' => new EasyRdf_Resource('http://purl.org/ontology/fo/Recipe'),
    'INGREDIENT_LIST' => new EasyRdf_Resource('http://purl.org/ontology/fo/IngredientList'),
    'FOOD' => new EasyRdf_Resource('http://purl.org/ontology/fo/Food'),
    'INGREDIENT' => new EasyRdf_Resource('http://purl.org/ontology/fo/Ingredient'),
    'MASS' => new EasyRdf_Resource('https://schema.org/Mass'),
    'TEXT' => new EasyRdf_Resource('http://webprotege.stanford.edu/RBSQByXCwS33B5MOrDR02mu')
];