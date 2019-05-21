<?php
    $array1 = array(
        array(
            'id' => 1
        ),
        array(
            'id' => 2
        )
    );

    $array2 = array(
        'id' => 3
    );

    array_push($array1, $array2);

    print_r(json_encode($array1));
?>