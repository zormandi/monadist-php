<?php
require '../bootstrap.php';

use Monadist\Maybe;


function leadConversionRateHistory($customerMetrics)
{
    return $customerMetrics['lead']['conversion']['rate']['history'];
}

function leadConversionRateHistory_safe($customerMetrics)
{
    if (!is_null($customerMetrics)) {
        if (isset($customerMetrics['lead'])) {
            if (isset($customerMetrics['lead']['conversion'])) {
                if (isset($customerMetrics['lead']['conversion']['rate'])) {
                    if (isset($customerMetrics['lead']['conversion']['rate']['history'])) {
                        return $customerMetrics['lead']['conversion']['rate']['history'];
                    }
                }
            }
        }
    }
    return null;
}

function leadConversionRateHistory_maybe($customerMetrics)
{
    return Maybe::unit($customerMetrics)['lead']['conversion']['rate']['history']->value();
}

$metrics = array(
    'lead' => array(
        'conversion' => array(
            'rate' => array(
                'history' => array()
            )
        )
    )
);

//$metrics = array();

var_dump(leadConversionRateHistory($metrics));
var_dump(leadConversionRateHistory_safe($metrics));
var_dump(leadConversionRateHistory_maybe($metrics));
