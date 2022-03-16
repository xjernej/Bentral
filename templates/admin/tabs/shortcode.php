<?php

function shortCodeInfo($title, $type, $group = 'widget'): string
{
    return '<div class="form-group row">        
    <label for="staticEmail" class="col-sm-4 col-form-label">' . $title . '</label>
    <div class="col-sm-8">
        <span class="form-control-plaintext xVar" style="padding: 10px;">[bentral-' . $group . ' type="' . $type . '"]</span>
        <span class="clipboard-info hidden">Shortcode copied to clipboard</span>
    </div>
  </div>';
}

?>
<div class="row">
    <div class="col-sm-6">
        <h3>Widgets</h3>
        <?php
        echo shortCodeInfo('Search form', 'search-form');
        echo shortCodeInfo('Search results', 'search-results');
        echo shortCodeInfo('Property reservation form', 'reservation');
        echo shortCodeInfo('Property calendar', 'calendar');
        echo shortCodeInfo('Property price info', 'price');
        echo shortCodeInfo('Property image gallery', 'gallery');
        echo shortCodeInfo('Property service list', 'services');
        echo shortCodeInfo('Property reviews', 'reviews');
        echo shortCodeInfo('Property maps', 'map');
        echo shortCodeInfo('Properties list', 'list');
        echo shortCodeInfo('Properties card', 'cards');
        echo shortCodeInfo('Properties map', 'maps');
        ?>
    </div>
    <div class="col-sm-6">
        <h3>Plain text</h3>
        <?php
        echo shortCodeInfo('Unit title', 'title', 'text');
        echo shortCodeInfo('Property title', 'property_title', 'text');
        echo shortCodeInfo('Property capacity', 'capacity', 'text');
        echo shortCodeInfo('Property capacity additional', 'capacity-additional', 'text');
        echo shortCodeInfo('Property floor size', 'floor-size', 'text');
        echo shortCodeInfo('Property intro text', 'intro', 'text');
        echo shortCodeInfo('Custom description text', 'description', 'text');
        ?>
    </div>
</div>