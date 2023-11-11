<?php
function rsssl_disable_fields_pro( $fields )
{
    /**
     * If a feature is already enabled, but not by RSSSL, we can simply check for that feature, and if the option in RSSSL is active.
     * We set is as true, but disabled. Because our React interface only updates changed option, and this option never changes, this won't get set to true in the database.
     */

    $third_party_headers = RSSSL_PRO()->headers->get_detected_security_headers('thirdparty');
    $header_ids = array_column($third_party_headers, 'option_name');
    foreach ($fields as $index => $field) {
        $field_id = $field['id'];

        if (in_array($field_id, $header_ids, true)) {
            foreach ($third_party_headers as $header => $data) {
                $detected_option = $data['option_name'];
                if ($field_id !== $detected_option) {
                    continue;
                }
                #disable this option, it's already enabled.
                $fields[$index]['disabled'] = true;
                if ($detected_option === 'csp_frame_ancestors') {
                    $frame_ancestors_urls_index = array_search('csp_frame_ancestors_urls', array_column($fields, 'id'));
                    $fields[$frame_ancestors_urls_index + 1]['disabled'] = true;
                }

                #now try to set the value
                if ($field['type'] === 'checkbox') {
                    $fields[$index]['value'] = true;
                }

                if ($detected_option === 'content_security_policy') {
                    $csp_status_index = array_search('csp_status', array_column($fields, 'id'));
                    $fields[$csp_status_index + 1]['value'] = 'enforced-by-thirdparty';
                }

                if ($field['type'] === 'permissionspolicy') {
                    $permissions_policy_status_index = array_search('enable_permissions_policy', array_column($fields, 'id'));
                    $fields[$permissions_policy_status_index + 1]['value'] = true;
                    $value = $data['value'];
                    $defaults = $field['default'];
                    $possible_values = ['*' => '(*)', '()' => '()', 'self' => '(self)'];
                    $override_value = $defaults;
                    foreach ($defaults as $default_key => $default_item) {
                        $type = $default_item['id'];
                        #set default to allow, in case not set
                        $override_value[$default_key]['value'] = '*';
                        foreach ($possible_values as $setting_value => $detect_value) {
                            $type_value = $type . '=' . $detect_value;
                            if (stripos($value, $type_value) !== false) {
                                $override_value[$default_key]['value'] = $setting_value;
                                $override_value[$default_key]['status'] = true;
                            }
                        }
                    }
                    $fields[$index]['value'] = $override_value;
                }

                if ($field['type'] === 'select') {
                    $field_index = array_search($detected_option, array_column($fields, 'id'));
                    $found_option = false;

                    if (isset($fields[$field_index + 1]['options'])) {
                        foreach ($fields[$field_index + 1]['options'] as $key => $label) {
                            //strip comment from the label
                            $label = trim(preg_replace('/\(.*?\)/', '', $label));
                            if (strtolower($label) === strtolower($data['value']) || strtolower($key) === strtolower($data['value'])) {
                                $fields[$index]['value'] = $key;
                                $found_option = true;
                                break;
                            }
                        }
                    }
                }
            }
        }

	    // Disable change_login_url + change_login_url_failure_url fields when wp-login.php is not available, and the option has not been set. We can then assume it's done by a different plugin
	    if ($field['id'] === 'change_login_url'
	    && !test_rsssl_wp_login_available()
	    && empty(rsssl_get_option('change_login_url'))
	    ) {
		    $fields[$index]['value'] = __("Login URL already changed by something else than Really Simple SSL", "really-simple-ssl-pro");
		    $fields[$index]['disabled'] = true;
	    }

	    if ($field['id'] === 'change_login_url_failure_url'
	        && !test_rsssl_wp_login_available()
	        && empty(rsssl_get_option('change_login_url'))) {
		    $fields[$index]['value'] = __("Login URL already changed by something else than Really Simple SSL", "really-simple-ssl-pro");
		    $fields[$index]['disabled'] = true;
	    }

	    if ( $field['id'] === 'block_admin_creation' && is_multisite() ) {
		    unset( $fields[ $index ] );
	    }
    }

	if ( get_option('rsssl_csp_max_size_exceeded') ) {
		//find csp_status, and set it to disabled
		$csp_status_index = array_search( 'csp_status', array_column( $fields, 'id' ), true );
		if ( $csp_status_index ) {
			$fields[ $csp_status_index+1 ]['value'] = 'error';
		}
	}

	return $fields;

}

add_filter('rsssl_fields_values', 'rsssl_disable_fields_pro', 99, 1);

