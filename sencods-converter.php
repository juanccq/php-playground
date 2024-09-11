<?php
function converter( $seconds ) {
    $results = [
        'year'  => [ 0, 'years' ],
        'day'   => [ 0, 'days' ],
        'hour'  => [ 0, 'hours' ],
        'min'   => [ 0, 'minutes' ],
        'sec'   => [ 0, 'seconds' ]
    ];

    $results['year'][0] = floor( $seconds / (60*60*24*365) );

    if( $results['year'][0] > 0 ) {
        $seconds = $seconds % (60*60*24*365);

        if( $results['year'][0] == 1 ) {
            $results['year'][1] = 'year';
        }
    }

    $results['day'][0] = floor( $seconds / (60*60*24) );

    if( $results['day'][0] > 0 ) {
        $seconds = $seconds % (60*60*24);

        if( $results['day'][0] == 1 ) {
            $results['day'][1] = 'day';
        }
    }

    $results['hour'][0] = floor( $seconds / (60*60) );

    if( $results['hour'][0] > 0 ) {
        $seconds = $seconds % (60*60);

        if( $results['hour'][0] == 1 ) {
            $results['hour'][1] = 'hour';
        }
    }

    $results['min'][0] = floor( $seconds / 60 );

    if( $results['min'][0] > 0 ) {
        $seconds = $seconds % 60;

        if( $results['min'][0] == 1 ) {
            $results['min'][1] = 'minute';
        }
    }

    $results['sec'][0] = $seconds;

    if( $results['sec'][0] == 1 ) {
        $results['sec'][1] = 'second';
    }
    
    $filtered = array_filter( $results, function( $item ){
        return $item[0] > 0;
    } );

    $filtered = array_combine( range(1, count($filtered) ), $filtered );

    $response = '';

    foreach( $filtered as $key => $value ) {
        $response .= $value[0] . ' ' . $value[1];

        if( $key != count($filtered) && $key < count($filtered) - 1 ) {
            $response .= ', ';
        }
        elseif( $key != count($filtered) && $key < count($filtered) ) {
            $response .= ' and ';
        }
    }

    return $response;
}

echo "\n".converter(54);
echo "\n".converter(1254);
echo "\n".converter(6254);
echo "\n".converter(95254);
echo "\n".converter(844495254);
echo "\n".converter(31536911);