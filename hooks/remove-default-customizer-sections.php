<?php

function bootstrap_customize_register_remove_sections( $wp_customize ) {

 //=============================================================
 // Remove header image and widgets option from theme customizer
 //=============================================================
 // $wp_customize->remove_control("header_image");


 //=============================================================
 // Remove Colors, Background image, and Static front page 
 // option from theme customizer     
 //=============================================================
 $wp_customize->remove_section("colors");

}
add_action( "customize_register", "bootstrap_customize_register_remove_sections" );