<?php

class CRM_Customer
{

    /**
     * Definition method to define information of a customer
     *
     * @return multitype:multitype:string
     */
    public static function definition()
    {
        return array(
            'customer_information' => array(
                'validation' => 'required',
                'type' => 'group'
            ),
            'full_name' => array(
                'type' => 'field',
                'validation' => 'required',
                'group' => 'customer_information'
            ),
            'address' => array(
                'type' => 'field',
                'group' => 'customer_information',
                'validation' => 'required'
            ),
            'phone' => array(
                'type' => 'field',
                'group' => 'customer_information',
                'validation' => 'unique'
            ),
            'current_cars' => array(
                'type' => 'field'
            ),
            'interested_cars' => array(
                'type' => 'group'
            ),
            'cars_model' => array(
                'group' => 'interested_cars',
                'type' => 'field',
                'validation' => 'valid:CRM_Car:valid_model:cars_model'
            ),
            'cars_color' => array(
                'group' => 'interested_cars',
                'type' => 'field',
                'validation' => 'valid:CRM_Car:valid_color:cars_model:cars_color'
            ),
            'others_notes' => array(
                'group' => 'interested_cars',
                'type' => 'field'
            ),
            'customer_classification' => array(
                'type' => 'group',
                'validation' => 'required'
            ),
            'hot_customer' => array(
                'group' => 'customer_classification',
                'type' => 'group'
            ),
            'customer_use_cash' => array(
                'type' => 'field',
                'group' => 'customer_classification'
            ),
            'customer_use_bank' => array(
                'type' => 'group'
            ),
            'loan_level' => array(
                'type' => 'field',
                'group' => 'customer_use_bank'
            ),
            'bank_name' => array(
                'type' => 'field',
                'group' => 'customer_use_bank'
            ),
            'need_consultant' => array(
                'type' => 'field',
                'group' => 'customer_use_bank'
            ),
            'warm_customer' => array(
                'group' => 'customer_classification',
                'type' => 'field'
            ),
            'cold_customer' => array(
                'group' => 'customer_classification',
                'type' => 'field'
            ),
            'contract_signed' => array(
                'type' => 'field'
            ),
            'customer_source' => array(
                'type' => 'group'
            ),
            'showrom' => array(
                'group' => 'customer_source',
                'type' => 'field'
            ),
            'sales_relations' => array(
                'group' => 'customer_source',
                'type' => 'field'
            ),
            'mgmt_boards_relations' => array(
                'group' => 'customer_source',
                'type' => 'field'
            ),
            'agency' => array(
                'group' => 'customer_source',
                'type' => 'field'
            ),
            'others' => array(
                'group' => 'customer_source',
                'type' => 'field'
            ),
            'notes' => array(
                'type' => 'field'
            )
        );
    }

    /**
     * Validate a specific customer base on requirement of definition method
     *
     * @param stdClass $customerdata
     * @return string|boolean
     */
    public static function validate_customer($customerdata)
    {
        $validated_fields = stdClass;
        $failed = false;
        foreach (self::definition() as $key => $value) {
            $params = explode(':', $value['validation']);
            $validated_fields->$key = self::validate(array_shift($params), array($key, $customerdata, $params));
            if(is_a($validated_fields->$key, 'WP_Error'))
                $failed = $failed & true;
        }
        if($failed)
            return $validated_fields;
        return true;
    }

    public static function validate($function, $params)
    {
        $functions = array(
            'required' => function ($params)
            {
                if (is_array($params) && ! empty($params)) {
                    $field = $param[0];
                    $args = $params[1];
                    return $args->$field != '' ? true : new WP_Error(204, $params[1] . ' is empty');
                } else
                    return WP_Error(404, 'No input parameter');
            },
            'unique' => function ($params)
            {
                if (is_array($params) && ! empty($params)) {
                    $args = $param[1];
                    $field = $param[0];
                    $customers = get_customers();
                    foreach ($customers as $customer) {
                        if ($customer->ID != $args->ID && $customer->$field == $args->$field)
                            return WP_Error(300, $field . ' is not unique');
                    }
                    return true;
                }

                else
                    return WP_Error(404, 'No input parameter');
            },
            'valid' => function ($params)
            {
                if (is_array($params) && ! empty($params)) {
                    $args = $param[1];
                    $field = $param[0];
                    if(!call_user_func(array($params[0], $params[1]), $param[2], $params[3]))
                        return true;
                    else
                        return WP_Error(203, $field . ' is not valid');
                } else
                    return WP_Error(404, 'No input parameter');
            }
        );
    }

    /**
     * Create customer from $_POST information
     */
    public static function create_customer()
    {
        return self::edit_customer();
    }

    public static function edit_customer($customer_id = 0)
    {
        $customer = new stdClass();
        if ($customer_id) {
            $update = true;
            $customer = self::get_customer($customer_id);
        } else {
            $update = false;
        }
    }

    /**
     * Get a customer from database with fields based on definition method

     * @param int $customer_id
     * @return boolean|stdClass
     */
    public static function get_customer($customer_id)
    {
        if (! $customer_id)
            return false;
        $customer = new stdClass();
        $customer_p = get_post((int) $customer_id);
        $customer->author = $customer_p->post_author;
        $customer->date = $customer_p->post_date;
        $customer->ID = $customer_p->ID;
        foreach (self::definition() as $key => $value) {
            if ($value['type'] == 'field') {
                $customer->$key = $customer_p->__get($key);
            }
        }
        return $customer;
    }

    /**
     * Get all customer from database
     *
     * @todo Add criteria in the future
     * @return multitype:
     */
    public static function get_customers()
    {
        $customers = array();
        $agrs = array(
            'posts_per_page' => - 1,
            'orderby' => 'none',
            'post_type' => 'customer',
            'post_status' => 'any'
        );
        $customers_p = get_posts($args);
        foreach ($customers_p as $customer_p) {
            $customer = stdClass;
            $customer->ID = $customer_p->ID;
            $customer->author = $customer_p->post_author;
            foreach (self::definition() as $key => $value) {
                if ($value['type'] != 'field')
                    $customer->$key = $customer_p->__get($key);
            }
            array_push($customers, $customer);
        }
        return $customers;
    }
}