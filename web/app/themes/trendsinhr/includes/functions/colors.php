<?php
/***
 * Custom colors.
 */

$theColor = '#f5afa4'; // roze
$theColorDark = '#7c9680'; // donkerroze

$theColor1 = '#ffbf38'; // geel
$theColor2 = '#9bbc97'; // groen
$theColor3 = '#e05453'; // rood
$theColor4 = '#af8ab3'; // paars
$theColor5 = '#95b2ca'; // blauw

function trendsinhr_customize_register( $wp_customize ) {

    global $theColor;
    global $theColorDark;
    global $theColor1;
    global $theColor2;
    global $theColor3;
    global $theColor4;
    global $theColor5;

    $wp_customize->add_section( 'themecolors' , array(
        'title' =>  'Kleurenschema',
    ) );

    // add colors to array
    $themecolors[] = array(
        'slug'=>'themecolor',
        'default' => $theColor,
        'label' => 'Themecolor'
    );
    $themecolors[] = array(
        'slug'=>'themecolor-dark',
        'default' => $theColorDark,
        'label' => 'Themecolor dark'
    );
    $themecolors[] = array(
        'slug'=>'themecolor-01',
        'default' => $theColor1,
        'label' => 'Themecolor 1'
    );
    $themecolors[] = array(
        'slug'=>'themecolor-02',
        'default' => $theColor2,
        'label' => 'Themecolor 2'
    );
    $themecolors[] = array(
        'slug'=>'themecolor-03',
        'default' => $theColor3,
        'label' => 'Themecolor 3'
    );
    $themecolors[] = array(
        'slug'=>'themecolor-04',
        'default' => $theColor4,
        'label' => 'Themecolor 4'
    );
    $themecolors[] = array(
        'slug'=>'themecolor-05',
        'default' => $theColor5,
        'label' => 'Themecolor 5'
    );

    // add the settings and controls for each color
    foreach( $themecolors as $themecolor ) {

        // SETTINGS
        $wp_customize->add_setting(
            $themecolor['slug'], array(
                'default' => $themecolor['default'],
                'type' => 'option',
                'capability' =>
                    'edit_theme_options'
            )
        );
        // CONTROLS
        $wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize,
                $themecolor['slug'],
                array('label' => $themecolor['label'],
                    'section' => 'themecolors',
                    'settings' => $themecolor['slug'])
            )
        );
    }
}
add_action( 'customize_register', 'trendsinhr_customize_register' );

function trendsinhr_customize_colors() {

    global $theColor;
    global $theColorDark;
    global $theColor1;
    global $theColor2;
    global $theColor3;
    global $theColor4;
    global $theColor5;

    $themecolor = get_option( 'themecolor' );
    $themecolorDark = get_option( 'themecolor-dark' );
    $themecolor1 = get_option( 'themecolor-01' );
    $themecolor2 = get_option( 'themecolor-02' );
    $themecolor3 = get_option( 'themecolor-03' );
    $themecolor4 = get_option( 'themecolor-04' );
    $themecolor5 = get_option( 'themecolor-05' );

    if($themecolor == '') { $themecolor = $theColor; }
    if($themecolorDark == '') { $themecolorDark = $theColorDark; }
    if($themecolor1 == '') { $themecolor1 = $theColor1; }
    if($themecolor2 == '') { $themecolor2 = $theColor2; }
    if($themecolor3 == '') { $themecolor3 = $theColor3; }
    if($themecolor4 == '') { $themecolor4 = $theColor4; }
    if($themecolor5 == '') { $themecolor5 = $theColor5; }

    ?>
    <style>
        :root {
            --themecolor: <?php echo $themecolor; ?>;
            --themecolor-rgb:  <?php echo hex2RGB($themecolor, true); ?>;
            --themecolor-dark: <?php echo $themecolorDark; ?>;
            --themecolor-dark-rgb: <?php echo hex2RGB($themecolorDark, true); ?>;
            --themecolor-01: <?php echo $themecolor1; ?>;
            --themecolor-01-rgb:  <?php echo hex2RGB($themecolor1, true); ?>;
            --themecolor-02: <?php echo $themecolor2; ?>;
            --themecolor-02-rgb: <?php echo hex2RGB($themecolor2, true); ?>;
            --themecolor-03: <?php echo $themecolor3; ?>;
            --themecolor-03-rgb: <?php echo hex2RGB($themecolor3, true); ?>;
            --themecolor-04: <?php echo $themecolor4; ?>;
            --themecolor-04-rgb: <?php echo hex2RGB($themecolor4, true); ?>;
            --themecolor-05: <?php echo $themecolor5; ?>;
            --themecolor-05-rgb: <?php echo hex2RGB($themecolor5, true); ?>;
        }
    </style>
    <?php
}
add_action( 'wp_head', 'trendsinhr_customize_colors' );
add_action( 'amp_post_template_head', 'trendsinhr_customize_colors' );

function hex2RGB($hexStr, $returnAsString = false, $seperator = ',') {
    $hexStr = preg_replace("/[^0-9A-Fa-f]/", '', $hexStr); // Gets a proper hex string
    $rgbArray = array();
    if (strlen($hexStr) == 6) { //If a proper hex code, convert using bitwise operation. No overhead... faster
        $colorVal = hexdec($hexStr);
        $rgbArray['red'] = 0xFF & ($colorVal >> 0x10);
        $rgbArray['green'] = 0xFF & ($colorVal >> 0x8);
        $rgbArray['blue'] = 0xFF & $colorVal;
    } elseif (strlen($hexStr) == 3) { //if shorthand notation, need some string manipulations
        $rgbArray['red'] = hexdec(str_repeat(substr($hexStr, 0, 1), 2));
        $rgbArray['green'] = hexdec(str_repeat(substr($hexStr, 1, 1), 2));
        $rgbArray['blue'] = hexdec(str_repeat(substr($hexStr, 2, 1), 2));
    } else {
        return false; //Invalid hex color code
    }
    return $returnAsString ? implode($seperator, $rgbArray) : $rgbArray; // returns the rgb string or the associative array
}

function getThemeColor() {
    $color = get_field('themecolor');
    if ($color == 'themeColor1') { $color = 'theme-bg-01'; }
    if ($color == 'themeColor2') { $color = 'theme-bg-02'; }
    if ($color == 'themeColor3') { $color = 'theme-bg-03'; }
    if ($color == 'themeColor4') { $color = 'theme-bg-04'; }
    if ($color == 'themeColor5') { $color = 'theme-bg-05'; }
    if ($color == '') { $color = 'theme-bg-01'; }
    return $color;
}

?>