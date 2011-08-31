<?php

/**
 * Fuel is a fast, lightweight, community driven PHP5 framework.
 *
 * @package    Fuel
 * @version    1.0
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2011 Fuel Development Team
 * @link       http://fuelphp.com
 */

 /**
 * FuelPHP Google package implementation. This namespace controls all Google
 * package functionality, including multiple sub-namespaces for the various
 * tools.
 *
 * @author     Mior Muhammad Zaki <crynobone@gmail.com>
 * @version    1.0
 * @package    Fuel
 * @subpackage Google
 */

namespace Google;

/**
 * Google APIs Visualization Library Class.
 *
 * @author   Mior Muhammad Zaki <crynobone@gmail.com>
 * @version  1.0
 * @package  Fuel
 * @package  Google
 * @category classes
 */
class Chart_GeoMap extends Chart_Driver {

    public function __construct() 
    {
        parent::__construct();

        $this->set_options(\Config::get('chart.geomap', array()));
    }

    public function generate($width = '100%', $height = '300px') 
    {
        $columns    = $this->columns;
        $rows       = $this->rows;

        $this->set_options('width', $width);
        $this->set_options('height', $height);

        $options    = json_encode($this->options);

        $id         = 'geomap_' . md5($columns . $rows . time() . microtime());

        return <<<SCRIPT
<div id="{$id}" style="width:{$width}px; height:{$height}px;"></div>
<script type="text/javascript">
google.load('visualization', '1', {'packages': ['geomap']});

google.setOnLoadCallback(draw_{$id});
function draw_{$id}() {
    var data = new google.visualization.DataTable();
    {$columns}
    {$rows}
    
    var geomap = new google.visualization.GeoMap(document.getElementById('{$id}'));
    geomap.draw(data, {$options});
};
</script>
SCRIPT;
    }

}

