<?php
class CRM_Customer {
	public static function definition() {
		return array (
				'customer_information' => array (
						'validation' => 'required',
						'type' => 'group'
				),
				'full_name' => array (
						'type' => 'field',
						'validation' => 'required',
						'group' => 'customer_information'
				),
				'address' => array (
						'type' => 'field',
						'group' => 'customer_information',
						'validation' => 'required'
				),
				'phone' => array (
						'type' => 'field',
						'group' => 'customer_information',
						'validation' => 'unique'
				),
				'current_cars' => array (
						'type' => 'field'
				),
				'interested_cars' => array (
						'type' => 'group'
				),
				'cars_model' => array (
						'group' => 'interested_cars',
						'type' => 'field',
						'validation' => 'valid|car_models'
				),
				'cars_color' => array (
						'group' => 'interested_cars',
						'type' => 'field',
						'validation' => 'valid|car_colors'
				),
				'others_notes' => array (
						'group' => 'interested_cars',
						'type' => 'field'
				),
				'customer_classification' => array (
						'type' => 'group',
						'validation' => 'required'
				),
				'hot_customer' => array (
						'group' => 'customer_classification',
						'type' => 'group'
				),
				'customer_use_cash' => array (
						'type' => 'field',
						'group' => 'customer_classification'
				),
				'customer_use_bank' => array (
						'type' => 'group'
				),
				'loan_level' => array (
						'type' => 'field',
						'group' => 'customer_use_bank'
				),
				'bank_name' => array (
						'type' => 'field',
						'group' => 'customer_use_bank'
				),
				'need_consultant' => array (
						'type' => 'field',
						'group' => 'customer_use_bank'
				),
				'warm_customer' => array (
						'group' => 'customer_classification',
						'type' => 'field'
				),
				'cold_customer' => array (
						'group' => 'customer_classification',
						'type' => 'field'
				),
				'contract_signed' => array (
						'type' => 'field'
				),
				'customer_source' => array (
						'type' => 'group'
				),
				'showrom' => array (
						'group' => 'customer_source',
						'type' => 'field'
				),
				'sales_relations' => array (
						'group' => 'customer_source',
						'type' => 'field'
				),
				'mgmt_boards_relations' => array (
						'group' => 'customer_source',
						'type' => 'field'
				),
				'agency' => array (
						'group' => 'customer_source',
						'type' => 'field'
				),
				'others' => array (
						'group' => 'customer_source',
						'type' => 'field'
				),
				'notes' => array (
						'type' => 'field'
				),
		);


	}
}