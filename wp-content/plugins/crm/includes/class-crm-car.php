<?php

class CRM_Car
{

    /**
     * Return all car models with corresponding color code
     *
     * @return array
     */
    public static function get_cars_models_colors()
    {
        return array(
            'ALTIS' => array(
                'colors' => array(
                    'CG',
                    'CV',
                    'CQ'
                )
            ),
            'FORTUNER' => array(
                'colors' => array(
                    'FG',
                    'FV',
                    'FX',
                    'FTRD'
                )
            ),
            'VIOS' => array(
                'colors' => array(
                    'VG',
                    'VE',
                    'VJ'
                )
            ),
            'INNOVA' => array(
                'colors' => array(
                    'IE',
                    'IG',
                    'IV'
                )
            ),
            'YARIS' => array(
                'colors' => array(
                    'YE',
                    'YG'
                )
            ),
            'CAMRY' => array(
                'colors' => array(
                    'KE',
                    'KL',
                    'KZ'
                )
            ),
            'HILUX' => array(
                'colors' => array(
                    'HG',
                    'HE'
                )
            ),
            'LAND' => array(
                'colors' => array(
                    'LP',
                    'LC'
                )
            ),
            'HIACE' => array(
                'colors' => array(
                    'HD',
                    'HC'
                )
            )
        );
    }

    /**
     * Check if specific car model is valid
     *
     * @param string $car_model
     * @return boolean
     */
    public static function valid_model($car_model)
    {
        if ($car_model === '')
            return false;
        if (in_array($car_model, array_keys(self::get_cars_models_colors())))
            return true;
    }

    /**
     * Check if specific car color is valid with specific car model
     *
     * @param string $car_model
     * @param string $car_color
     * @return boolean
     */
    public static function valid_color($car_model, $car_color)
    {
        if ($car_model == '' || $car_color == '')
            return false;
        $cars_models_colors = self::get_cars_models_colors();
        if (in_array($car_color, $cars_models_colors[$car_model]['colors']))

            return true;
    }
}