<?php

function getCombinations( $pin ) {
    $kl = [
        [1, 2, 3],
        [4, 5, 6],
        [7, 8, 9],
        [-1, 0, -1]
    ];
    // print_r($kl);

    if( 'string' !== gettype( $pin ) ) {
        $pin = strval( $pin );
    }

    $options = [];
    for( $i = 0; $i < strlen( $pin ); $i++ ) {
        $digit = substr( $pin, $i, 1);
        // echo "digit: $digit\n";
        $options[$i] = getDigitOptions( $digit, $kl );
    }

    // print_r($options);
    $attemps = mergeArray( $options );
    sort($attemps);

    return $attemps;
}

function mergeArray( $array ) {
    $len = count($array);

    if( $len >= 2 ) {
        $array[ $len - 2 ] = combine( $array[ $len - 2 ], $array[ $len - 1 ] );
        unset( $array[ $len -1 ] );
        return mergeArray( $array );
    }
    else {
        return $array[0];
    }
}

function combine( $row1, $row2 ) {
    $combinations = [];
    foreach( $row1 as $val1 ) {
        foreach( $row2 as $val2 ) {
            $combinations[] = $val1 . $val2;
        }
    }

    return $combinations;
}

function getDigitOptions( $digit, $kl ) {
    $pos = [];

    foreach( $kl as $ki => $i ) {
        foreach( $i as $kj => $j ) {
            if( $j == $digit ) {
                $pos = [$ki, $kj];
                break 2;
            }
        }
    }

    $options = [ $digit ];
    $options = getOptions( $pos[0], $pos[1] - 1, $kl, $options );
    $options = getOptions( $pos[0] - 1, $pos[1], $kl, $options );
    $options = getOptions( $pos[0], $pos[1] + 1, $kl, $options );
    $options = getOptions( $pos[0] + 1, $pos[1], $kl, $options );

    return $options;
}

function getOptions( $row, $column, $kl, $options ) {
    if( isset( $kl[ $row ][ $column ] ) && $kl[ $row ][ $column ] != -1 ) {
        $options[] = $kl[ $row ][ $column ];
    }

    return $options;
}

// print_r(getCombinations(8)); echo "\n";
// print_r(getCombinations(11)); echo "\n";
// print_r(getCombinations(1357)); echo "\n";
print_r(getCombinations(1234)); echo "\n";