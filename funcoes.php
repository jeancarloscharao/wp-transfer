<?php


function MOD( $number, $base ) {

	return $number % $base;

}


function DIV( $number, $base ) {

	return floor( $number / $base );

}


$teste = MOD( 2, 45 );

echo $teste;

?>

