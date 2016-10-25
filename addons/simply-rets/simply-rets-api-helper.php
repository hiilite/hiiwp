<?php

/*
 * simply-rets-api-helper.php - Copyright (C) 2014-2015 SimplyRETS, Inc.
 *
 * This file provides a class that has functions for retrieving and parsing
 * data from the remote retsd api.
 *
*/

/* Code starts here */
 
class SimplyRetsApiHelper {

    public static function retrieveRetsListings( $params, $settings = NULL ) {
        $request_url      = SimplyRetsApiHelper::srRequestUrlBuilder( $params );
        $request_response = SimplyRetsApiHelper::srApiRequest( $request_url );
        $response_markup  = SimplyRetsApiHelper::srResidentialResultsGenerator( $request_response, $settings );

        return $response_markup;
    }


    public static function retrieveListingDetails( $listing_id ) {
        $request_url      = SimplyRetsApiHelper::srRequestUrlBuilder( $listing_id );
        $request_response = SimplyRetsApiHelper::srApiRequest( $request_url );
        $response_markup  = SimplyRetsApiHelper::srResidentialDetailsGenerator( $request_response );

        return $response_markup;
    }

    public static function retrieveWidgetListing( $listing_id, $settings = NULL ) {
        $request_url      = SimplyRetsApiHelper::srRequestUrlBuilder( $listing_id );
        $request_response = SimplyRetsApiHelper::srApiRequest( $request_url );
        $response_markup  = SimplyRetsApiHelper::srWidgetListingGenerator( $request_response, $settings );

        return $response_markup;
    }

    public static function retrieveListingsSlider( $params, $settings = NULL ) {
        $request_url      = SimplyRetsApiHelper::srRequestUrlBuilder( $params );
        $request_response = SimplyRetsApiHelper::srApiRequest( $request_url );
        $response_markup  = SimplyRetsApiHelper::srListingSliderGenerator( $request_response, $settings );

        return $response_markup;
    }


    public static function makeApiRequest($params) {
        $request_url      = SimplyRetsApiHelper::srRequestUrlBuilder($params);
        $request_response = SimplyRetsApiHelper::srApiRequest($request_url);

        return $request_response;
    }

    /*
     * This function build a URL from a set of parameters that we'll use to
     * requst our listings from the SimplyRETS API.
     *
     * @params is either an associative array in the form of [filter] => "val"
     * or it is a single listing id as a string, ie "123456".
     *
     * query variables for filtering will always come in as an array, so it
     * this is true, we can build a query off the standard /properties URL.
     *
     * If we do /not/ get an array, thenw we know we are requesting a single
     * listing, so we can just build the url with /properties/{ID}
     *
     * base url for local development: http://localhost:3001/properties
    */
    public static function srRequestUrlBuilder( $params ) {
        $authid   = get_option( 'sr_api_name' );
        $authkey  = get_option( 'sr_api_key' );
        $base_url = "https://{$authid}:{$authkey}@api.simplyrets.com/properties";

        if( is_array( $params ) ) {
            $filters_query = http_build_query( array_filter( $params ) );
            $request_url = "{$base_url}?{$filters_query}";
            return $request_url;

        } else {
            $request_url = $base_url . $params;
            return $request_url;
        }

    }

    public static function srApiOptionsRequest( $url ) {
        $wp_version = get_bloginfo('version');
        $php_version = phpversion();
        $site_url = get_site_url();

        $ua_string     = "SimplyRETSWP/2.1.3 Wordpress/{$wp_version} PHP/{$php_version}";
        $accept_header = "Accept: application/json; q=0.2, application/vnd.simplyrets-v0.1+json";

        if( is_callable( 'curl_init' ) ) {
            $curl_info = curl_version();

            // init curl and set options
            $ch = curl_init();
            $curl_version = $curl_info['version'];
            $headers[] = $accept_header;

            curl_setopt( $ch, CURLOPT_URL, $url );
            curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers );
            curl_setopt( $ch, CURLOPT_USERAGENT, $ua_string . " cURL/{$curl_version}" );
            curl_setopt( $ch, CURLOPT_USERAGENT, $ua_string . " cURL/{$curl_version}" );
            curl_setopt( $ch, CURLOPT_REFERER, $site_url );
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
            curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, "OPTIONS" );

            // make request to api
            $request = curl_exec( $ch );

            // decode the reponse body
            $response_array = json_decode( $request );

            // close curl connection and return value
            curl_close( $ch );
            return $response_array;

        } else {
            return;
        }
    }

    public static function srUpdateAdvSearchOptions() {
        $authid   = get_option('sr_api_name');
        $authkey  = get_option('sr_api_key');
        $url      = "https://{$authid}:{$authkey}@api.simplyrets.com/";
        $options  = SimplyRetsApiHelper::srApiOptionsRequest( $url );
        $vendors  = $options->vendors;

        update_option("sr_adv_search_meta_vendors", $vendors);

        foreach((array)$vendors as $vendor) {
            $vendorUrl = $url . "properties?vendor=$vendor";
            $vendorOptions = SimplyRetsApiHelper::srApiOptionsRequest($vendorUrl);

            $defaultArray   = array();
            $defaultTypes   = array("Residential", "Condominium", "Rental");
            $defaultExpires = time();

            $types = $vendorOptions->fields->type;
            !isset( $types ) || empty( $types )
                ? $types = $defaultTypes
                : $types = $vendorOptions->fields->type;

            $expires = $vendorOptions->expires;
            !isset( $expires ) || empty( $expires )
                ? $expires = $defaultExpires
                : $expires = $vendorOptions->expires;

            $status = $vendorOptions->fields->status;
            !isset( $status ) || empty( $status )
                ? $status = $defaultArray
                : $status = $vendorOptions->fields->status;

            $counties = $vendorOptions->fields->counties;
            !isset( $counties ) || empty( $counties )
                ? $counties = $defaultArray
                : $counties = $vendorOptions->fields->counties;

            $cities = $vendorOptions->fields->cities;
            !isset( $cities ) || empty( $cities )
                ? $cities = $defaultArray
                : $cities = $vendorOptions->fields->cities;

            $features = $vendorOptions->fields->features;
            !isset( $features ) || empty( $features )
                ? $features = $defaultArray
                : $features = $vendorOptions->fields->features;

            $neighborhoods = $vendorOptions->fields->neighborhoods;
            !isset( $neighborhoods ) || empty( $neighborhoods )
                ? $neighborhoods = $defaultArray
                : $neighborhoods = $vendorOptions->fields->neighborhoods;

            update_option( "sr_adv_search_meta_timestamp_$vendor", $expires );
            update_option( "sr_adv_search_meta_status_$vendor", $status );
            update_option( "sr_adv_search_meta_types_$vendor", $types );
            update_option( "sr_adv_search_meta_county_$vendor", $counties );
            update_option( "sr_adv_search_meta_city_$vendor", $cities );
            update_option( "sr_adv_search_meta_features_$vendor", $features );
            update_option( "sr_adv_search_meta_neighborhoods_$vendor", $neighborhoods );

        }


        // foreach( $options as $key => $option ) {
        //     if( !$option == NULL ) {
        //         update_option( 'sr_adv_search_option_' . $key, $option );
        //     } else {
        //         echo '';
        //     }
        // }

        return;

    }


    /**
     * Make the request the SimplyRETS API. We try to use
     * cURL first, but if it's not enabled on the server, we
     * fall back to file_get_contents().
    */
    public static function srApiRequest( $url ) {
        $wp_version = get_bloginfo('version');
        $php_version = phpversion();

        $ua_string     = "SimplyRETSWP/2.1.3 Wordpress/{$wp_version} PHP/{$php_version}";
        $accept_header = "Accept: application/json; q=0.2, application/vnd.simplyrets-v0.1+json";

        if( is_callable( 'curl_init' ) ) {
            // init curl and set options
            $ch = curl_init();
            $curl_info = curl_version();
            $curl_version = $curl_info['version'];
            $headers[] = $accept_header;
            curl_setopt( $ch, CURLOPT_URL, $url );
            curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers );
            curl_setopt( $ch, CURLOPT_USERAGENT, $ua_string . " cURL/{$curl_version}" );
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
            curl_setopt( $ch, CURLOPT_HEADER, true );

            // make request to api
            $request = curl_exec( $ch );

            // get header size to parse out of response
            $header_size = curl_getinfo( $ch, CURLINFO_HEADER_SIZE );

            // separate header/body out of response
            $header = substr( $request, 0, $header_size );
            $body   = substr( $request, $header_size );

            $pag_links = SimplyRetsApiHelper::srPaginationParser($header);

            // decode the reponse body
            $response_array = json_decode( $body );

            $srResponse = array();
            $srResponse['pagination'] = $pag_links;
            $srResponse['response'] = $response_array;

            // close curl connection
            curl_close( $ch );
            return $srResponse;

        } else {
            $options = array(
                'http' => array(
                    'header' => $accept_header,
                    'user_agent' => $ua_string
                )
            );
            $context = stream_context_create( $options );
            $request = file_get_contents( $url, false, $context );
            $response_array = json_decode( $request );

            $srResponse = array();
            $srResponse['pagination'] = $pag_links;
            $srResponse['response'] = $response_array;

            return $srResponse;
        }

        if( $response_array === FALSE || empty($response_array) ) {
            $error =
                "Sorry, SimplyRETS could not complete this search." .
                "Please double check that your API credentials are valid " .
                "and that the search filters you used are correct. If this " .
                "is a new listing you may also try back later.";
            $response_err = array(
                "error" => $error
            );
            return  $response_err;
        }

        return $response_array;
    }


    public static function srPaginationParser( $linkHeader ) {
        // get link val from header
        $pag_links = array();
        $name = 'Link';
        preg_match('/^Link: ([^\r\n]*)[\r\n]*$/m', $linkHeader, $matches);
        unset($matches[0]);
        foreach( $matches as $key => $val ) {
            $parts = explode( ",", $val );
            foreach( $parts as $key => $part ) {
                if( strpos( $part, 'rel="prev"' ) == true ) {
                    $part = trim( $part );
                    preg_match( '/^<(.*)>/', $part, $prevLink );
                    // $prevLink = $part;
                }
                if( strpos( $part, 'rel="next"' ) == true ) {
                    $part = trim( $part );
                    preg_match( '/^<(.*)>/', $part, $nextLink );
                }
            }
        }

        $prev_link = $prevLink[1];
        $next_link = $nextLink[1];
        $pag_links['prev'] = $prev_link;
        $pag_links['next'] = $next_link;


        /**
         * Transform query parameters to what the Wordpress client needs
         */
        foreach( $pag_links as $key=>$link ) {
            $link_parts = parse_url( $link );

            $no_prefix = array('offset', 'limit', 'type', 'water');

            // Do NOT use the builtin parse_str, use our custom function
            // proper_parse_str instead
            // parse_str( $link_parts['query'], $output );
            $output = SrUtils::proper_parse_str($link_parts['query']);

            if( !empty( $output ) && !in_array(NULL, $output, true) ) {
                foreach( $output as $query=>$parameter) {
                    if( $query == 'type' ) {
                        $output['sr_p' . $query] = $output[$query];
                        unset( $output[$query] );
                    }
                    /** There a few queries that we don't prefix with sr_ */
                    if(!in_array($query, $no_prefix)) {
                        $output['sr_' . $query] = $output[$query];
                        unset( $output[$query] );
                    }
                }
                $link_parts['query'] = http_build_query( $output );
                $pag_link_modified = $link_parts['scheme']
                                     . '://'
                                     . $link_parts['host']
                                     . $link_parts['path']
                                     . '?'
                                     . $link_parts['query'];
                $pag_links[$key] = $pag_link_modified;
            }
        }

        return $pag_links;
    }


    public static function simplyRetsClientCss() {
        // client side css
        wp_register_style('simply-rets-client-css',
                          RETSURL.'assets/css/simply-rets-client.css');
        wp_enqueue_style('simply-rets-client-css');

        // listings slider css
        wp_register_style('simply-rets-carousel',
                          'https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css');
        wp_enqueue_style('simply-rets-carousel');

        // listings slider css
        wp_register_style('simply-rets-carousel-theme',
                          'https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.theme.min.css');
        wp_enqueue_style('simply-rets-carousel-theme');

    }

    public static function simplyRetsClientJs() {
        // client-side js
        wp_register_script('simply-rets-client-js',
                           RETSURL.'assets/js/simply-rets-client.js',
                           array('jquery'));
        wp_enqueue_script('simply-rets-client-js');

        // image gallery js
        wp_register_script('simply-rets-galleria-js',
                           RETSURL.'assets/galleria/galleria-1.4.2.min.js',
                           array('jquery'));
        wp_enqueue_script('simply-rets-galleria-js');

        // listings slider js
        wp_register_script('simply-rets-carousel',
                           'https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js',
                           array('jquery'));
        wp_enqueue_script('simply-rets-carousel');

    }


    /**
     * Run fields through this function before rendering them on single listing
     * pages to hide fields that are null.
     */
    public static function srDetailsTable($val, $name, $additional = NULL, $desc = NULL) {
        if( $val == "" ) {
            $val = "";
        } else {
            $data_attr = str_replace(" ", "-", strtolower($name));
            if(!$additional && !$desc) {
                $val = <<<HTML
                    <tr data-attribute="$data_attr">
                      <td>$name</td>
                      <td colspan="2">$val</td>
HTML;
            } elseif ($additional && !$desc) {
                $val = <<<HTML
                    <tr data-attribute="$data_attr">
                      <td>$name</td>
                      <td>$val</td>
                      <td>$additional</td>
HTML;
            } else {
                $val = <<<HTML
                    <tr data-attribute="$data_attr">
                      <td rowspan="2" style="vertical-align: middle">$name</td>
                      <td colspan="1">$val</td>
                      <td colspan="1">$additional</td>
                    <tr data-attribute="$data_attr">
                      <td colspan="2">$desc</td>
HTML;
            }
        }
        return $val;
    }



    /**
     * Build the photo gallery shown on single listing details pages
     */
    public static function srDetailsGallery( $photos ) {
        $photo_gallery = array();

        if( empty($photos) ) {
             $main_photo = RETSURL. 'assets/img/defprop.jpg';
             $markup = "<img src='$main_photo'>";
             $photo_gallery['markup'] = $markup;
             $photo_gallery['more']   = '';
             return $photo_gallery;

        } else {
            $markup = '';
            if(get_option('sr_listing_gallery') == 'classic') {
                $photo_counter = 0;
                $main_photo = $photos[0];
                $more = '<span id="sr-toggle-gallery">See more photos</span> |';
                $markup .= "<div class='sr-slider'><img class='sr-slider-img-act' src='$main_photo'>";
                foreach( $photos as $photo ) {
                    $markup .=
                        "<input class='sr-slider-input' type='radio' name='slide_switch' id='id$photo_counter' value='$photo' />";
                    $markup .= "<label for='id$photo_counter'>";
                    $markup .= "  <img src='$photo' width='100'>";
                    $markup .= "</label>";
                    $photo_counter++;
                }
                $markup .= "</div>";
                $photo_gallery['markup'] = $markup;
                $photo_gallery['more'] = $more;
                return $photo_gallery;

            } else {
                $more = '';
                $markup .= '<div class="sr-gallery" id="sr-fancy-gallery">';
                foreach( $photos as $photo ) {
                    $markup .= "<img src='$photo' data-title='$address'>";
                }
                $markup .= "</div>";
                $photo_gallery['markup'] = $markup;
                $photo_gallery['more'] = $more;
                return $photo_gallery;
            }
        }
        return $photo_gallery;

    }

	/*
	*	
	*	SINGLE LISTING VIEW
	*		
	*/

    public static function srResidentialDetailsGenerator( $listing ) {
        
		$listing = $listing['response'];

        return get_listing_template( $listing, 'full', 'rets');
        //return $cont;
    }


    public static function resultDataColumnMarkup($val, $name, $reverse=false) {
        if( $val == "" ) {
            $val = "";
        } else {
            if($reverse == false) {
                $val = "<li>$val $name</li>";
            }
            else {
                $val = "<li>$name $val</li>";
            }
        }
        return $val;
    }

	/*
	Generate results for [sr_listings]	
	*/
    public static function srResidentialResultsGenerator( $response, $settings ) {
	   
		
		$cont              = "";
        $br                = "<br>";
        $pagination        = $response['pagination'];
        $response          = $response['response'];
        $map_position      = get_option('sr_search_map_position', 'list_only');
        $show_listing_meta = SrUtils::srShowListingMeta();
        $pag               = SrUtils::buildPaginationLinks( $pagination );
        $prev_link         = $pag['prev'];
        $next_link         = $pag['next'];

        $vendor       = isset($settings['vendor'])   ? $settings['vendor']   : '';
        $map_setting  = isset($settings['show_map']) ? $settings['show_map'] : '';

        /** Allow override of "map_position" admin setting on a per short-code basis */
        $map_position = isset($settings['map_position']) ? $settings['map_position'] : $map_position;

        if(empty($vendor)) {
            $vendor = get_query_var('sr_vendor', '');
        }

        /*
         * check for an error code in the array first, if it's
         * there, return it - no need to do anything else.
         * The error code comes from the UrlBuilder function.
        */
        if($response == NULL
           || array_key_exists("errors", $response)
           || array_key_exists("error", $response)
        ) {
            $err = SrMessages::noResultsMsg((array)$response);
            return $err;
        }

        $response_size = sizeof($response);
        if(!array_key_exists("0", $response)) {
            $response = array($response);
        }


        $map       = SrSearchMap::mapWithDefaults();
        $mapHelper = SrSearchMap::srMapHelper();
        $map->setAutoZoom(true);
        $markerCount = 0;
        
		

        foreach( $response as $listing ) {
	        $resultsMarkup .= get_short_listing_template($listing);
        }
		
        $markerCount > 0 ? $mapMarkup = $mapHelper->render($map) : $mapMarkup = '';

        if( $map_setting == 'false' ) {
            $mapMarkup = '';
        }

        if( $map_position == 'list_only' )
        {
            $cont .= $resultsMarkup;
        }
        elseif( $map_position == 'map_only' )
        {
            $cont .= $mapMarkup;
        }
        elseif( $map_position == 'map_above' )
        {
            $cont .= $mapMarkup;
            $cont .= $resultsMarkup;
        }
        elseif( $map_position == 'map_below' )
        {
            $cont .= $resultsMarkup;
            $cont .= '<hr>';
            $cont .= $mapMarkup;
        }
        else
        {
            $cont .= $resultsMarkup;
        }

        $cont .= "<hr><p class='sr-pagination'>$prev_link $next_link</p>";
        $cont .= "<br><p><small><i>This information is believed to be accurate, but without any warranty.</i></small></p>";

        return $cont;

    }


    public static function srWidgetListingGenerator( $response, $settings ) {
        $br   = "<br>";
        $cont = "";

        /*
         * check for an error code in the array first, if it's
         * there, return it - no need to do anything else.
         * The error code comes from the UrlBuilder function.
        */
        $response = $response['response'];
        $response_size = sizeof( $response );

        if($response == NULL
           || array_key_exists( "error", $response )
           || array_key_exists( "errors", $response )) {

            $err = SrMessages::noResultsMsg($response);
            return $err;
        }

        if( array_key_exists( "error", $response ) ) {
            $error = $response['error'];
            $response_markup = "<hr><p>{$error}</p>";
            return $response_markup;
        }

        if( !array_key_exists("0", $response ) ) {
            $response = array( $response );
        }

        if( $response_size < 1 ) {
            $response = array( $response );
        }

        foreach ( $response as $listing ) {
            $listing_uid = $listing->mlsId;
            // widget details
            $bedrooms = $listing->property->bedrooms;
            if( $bedrooms == null || $bedrooms == "" ) {
                $bedrooms = 0;
            }
            $bathsFull   = $listing->property->bathsFull;
            if( $bathsFull == null || $bathsFull == "" ) {
                $bathsFull = 0;
            }
            $mls_status    = $listing->mls->status;
            $listing_remarks  = $listing->remarks;
            $listing_price = $listing->listPrice;
            $listing_USD   = '$' . number_format( $listing_price );

            // widget title
            $address = $listing->address->full;

            // widget photo
            $listingPhotos = $listing->photos;
            if( empty( $listingPhotos ) ) {
                $listingPhotos[0] = RETSURL. 'assets/img/defprop.jpg';
            }
            $main_photo = $listingPhotos[0];
            $main_photo = str_replace("\\", "", $main_photo);


            $vendor = isset($settings['vendor']) ? $settings['vendor'] : '';
            // create link to listing
            $link = SrUtils::buildDetailsLink(
                $listing,
                !empty($vendor) ? array("sr_vendor" => $vendor) : array()
            );

            // append markup for this listing to the content
            $cont .= <<<HTML
              <div class="sr-listing-wdgt">
                <a href="$link">
                  <h5>$address
                    <small> - $listing_USD </small>
                  </h5>
                </a>
                <a href="$link">
                  <img src="$main_photo" width="100%" alt="$address">
                </a>
                <div class="sr-listing-wdgt-primary">
                  <div id="sr-listing-wdgt-details">
                    <span>$bedrooms Bed | $bathsFull Bath | $mls_status </span>
                  </div>
                  <hr>
                  <div id="sr-listing-wdgt-remarks">
                    <p>$listing_remarks</p>
                  </div>
                </div>
                <div id="sr-listing-wdgt-btn">
                  <a href="$link">
                    <button class="button btn">
                      More about this listing
                    </button>
                  </a>
                </div>
              </div>
HTML;

        }
        return $cont;
    }


    public static function srContactFormMarkup($listing) {
        $markup .= '<div id="sr-contact-form text-block">';
        $markup .= '<h3>Contact us about this listing</h3>';
        $markup .= '<form action="' . esc_url( $_SERVER['REQUEST_URI'] ) . '" method="post">';
        $markup .= '<p>';
        $markup .= '<input type="hidden" name="sr-cf-listing" value="' . $listing . '" />';
        $markup .= 'Your Name (required) <br/>';
        $markup .= '<input type="text" name="sr-cf-name" pattern="[a-zA-Z0-9 ]+" value="'
            . ( isset( $_POST["sr-cf-name"] ) ? esc_attr( $_POST["sr-cf-name"] ) : '' ) . '" size="40" />';
        $markup .= '</p>';
        $markup .= '<p>';
        $markup .= 'Your Email (required) <br/>';
        $markup .= '<input type="email" name="sr-cf-email" value="'
            . ( isset( $_POST["sr-cf-email"] ) ? esc_attr( $_POST["sr-cf-email"] ) : '' ) . '" size="40" />';
        $markup .= '</p>';
        $markup .= '<p>';
        $markup .= 'Subject (required) <br/>';
        $markup .= '<input type="text" name="sr-cf-subject" pattern="[a-zA-Z ]+" value="'
            . ( isset( $_POST["sr-cf-subject"] ) ? esc_attr( $_POST["sr-cf-subject"] ) : '' ) . '" size="40" />';
        $markup .= '</p>';
        $markup .= '<p>';
        $markup .= 'Your Message (required) <br/>';
        $markup .= '<textarea rows="10" cols="35" name="sr-cf-message">'
            . ( isset( $_POST["sr-cf-message"] ) ? esc_attr( $_POST["sr-cf-message"] ) : '' ) . '</textarea>';
        $markup .= '</p>';
        $markup .= '<p><input class="btn button btn-submit" type="submit" name="sr-cf-submitted" value="Send"></p>';
        $markup .= '</form>';
        $markup .= '</div>';

        return $markup;

    }

    public static function srContactFormDeliver() {

        // if the submit button is clicked, send the email
        if ( isset( $_POST['sr-cf-submitted'] ) ) {

            // sanitize form values
            $listing = sanitize_text_field( $_POST["sr-cf-listing"] );
            $name    = sanitize_text_field( $_POST["sr-cf-name"] );
            $email   = sanitize_email( $_POST["sr-cf-email"] );
            $subject = sanitize_text_field( $_POST["sr-cf-subject"] );
            $message = esc_textarea( $_POST["sr-cf-message"] ) . ' - ' . $listing;

            // get the blog administrator's email address
            $to = get_option('sr_leadcapture_recipient', '');
            $to = empty($to) ? get_option('admin_email') : $to;

            $headers = "From: $name <$email>" . "\r\n";

            // If email has been process for sending, display a success message
            if ( wp_mail( $to, $subject, $message, $headers ) ) {
                echo '<div></div>';
            } else {
                echo 'An unexpected error occurred';
            }
        }
    }


    public static function srListingSliderGenerator( $response, $settings ) {
	    global $post;
        $listings = $response['response'];
        $additional_class = '';
        $inner;
        if(!empty($settings['random']) && $settings['random'] === "true") {
            shuffle($listings);
        }
        $wp_listings = new WP_Query(array( 'post_type' => 'listing', 'posts_per_page' => 10 ));
        if($wp_listings->have_posts()):
	        while($wp_listings->have_posts()):
	        	$wp_listings->the_post();
	        	$additional_class = '';
	        	$l = get_post_meta(get_the_id());
	        	
	        	$object = new stdClass();
				foreach ($l as $key => $value)
				{
					if(strpos($key, '-') !== false) {
						list($key1, $key2) = explode('-', $key);
						if(!isset($object->$key1)) { 
							$object->$key1 = new stdClass();
							$object->$key1->$key2 = $value[0];
						} else {
							$object->$key1->$key2 = $value[0];
						}
						
					} else {
					    $object->$key = $value[0];
					}
				}
				$l = $object;
				
	        	$uid     = $l->mlsId;
	            $lid	= $l->listingId;
	            $subarea	= $l->mls->area;
	            $streetNumber	= $l->address->streetNumber;
	            $streetName		= $l->address->streetName;
	            $city 			= $l->address->city;
	            $unit 			= $l->address->unit;
	            $address = $l->address->full;
	            $price   = $l->listPrice;
	            $photos  = $l->photos;
	            $beds    = $l->property->bedrooms;
	            $baths   = $l->property->bathsFull;
	            $area    = $l->property->area;
	            $subType = $l->property->subType;
	            $status = $l->mls->status;
	            $office = $l->office->name;
	
				if($subType == 'SingleFamilyResidence')$subType = 'House';
	            elseif($subType == 'Apartment')$subType = 'Condo';
	            
	            $priceUSD = '$' . number_format( $price );
	
				$fullAddress = $unit.' - '.$streetNumber.' '.$streetName.' '.$city.', '.$subarea;
	            // create link to listing
	            $vendor = isset($settings['vendor']) ? $settings['vendor'] : '';
	            $link = get_the_permalink();
	
	            if( $area == 0 ) {
	                $area = 'na';
	            } else {
	                $area = number_format( $area );
	            }
	
	            if( empty( $photos ) ) {
	                $photo = RETSURL. 'assets/img/defprop.jpg';
	            } else {
	                $photo = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium');
	                $photo = $photo[0];
	            }
	            
	            
			
				
				$terms = get_the_terms( get_the_id(), 'status' );
				if(!empty($terms)){
					foreach ( $terms as $term ) {
		                $term_status = $term->name;
		                $additional_class = $term->slug;
		            }
	            }
				
				if(isset($term_status))$status = $term_status;
				elseif(strtotime($listing->listDate) < strtotime('1 week ago')) $status = 'Just Listed';
			    elseif(isset($listing->mls->area)) $status = $listing->mls->area;
			    else $status = $listing->mls->status; 
			    
			    $listing_mlsid_html = ($listing_mlsid != '')?$listing_mlsid_html = ' ('.$listing_mlsid.')':'';
				$title_html = ($listing_address != '' || $listing_subdivision != '' && $listing_city != '')?$listing_unit.' '.$listing_address.' '. $listing_subdivision.', '.$listing_city.$listing_mlsid_html:get_the_title($post_id);
				
				if($wp_listing = get_page_by_title($property->address->full, OBJECT, 'listing')){
					$inner .= print_r($wp_listing, true);
				} else {
					$inner .= <<<HTML
					<div class="sr-listing-slider-item small_listing_container $additional_class"> 
						<div class="four columns alpha omega listing_thumb">
							<a href="$link" title="$title_html">
								<img src="$photo" alt="$title_html" title="$fullAddress" class="scale-with-grid ">
							</a>
							<div class="four columns alpha omega listing_info">
								<div class="listing_remarks">
									<p>$priceUSD</p>
								</div><p>$subType | $beds Bed | $baths Bath | $area</p>
							</div>
						</div>
						<h3><a href="$link" title="$title_html">$title_html</a></h3>
						<sup class="supersmall">$office</sup>
					</div>
HTML;
	        	}
	        endwhile;
        endif;
        
        foreach($listings as $l) {
            $uid     = $l->mlsId;
            $lid	= $l->listingId;
            $subarea	= $l->mls->area;
            $streetNumber	= $l->address->streetNumber;
            $streetName		= $l->address->streetName;
            $city 			= $l->address->city;
            $unit 			= $l->address->unit;
            $address = $l->address->full;
            $price   = $l->listPrice;
            $photos  = $l->photos;
            $beds    = $l->property->bedrooms;
            $baths   = $l->property->bathsFull;
            $area    = $l->property->area;
            $subType = $l->property->subType;
            $status = $l->mls->status;
            $office = $l->office->name;

			if($subType == 'SingleFamilyResidence')$subType = 'House';
            elseif($subType == 'Apartment')$subType = 'Condo';
            
            $priceUSD = '$' . number_format( $price );

			$fullAddress = $unit.' - '.$streetNumber.' '.$streetName.' '.$city.', '.$subarea;
            // create link to listing
            $vendor = isset($settings['vendor']) ? $settings['vendor'] : '';
            $link = SrUtils::buildDetailsLink(
                $l,
                !empty($vendor) ? array("sr_vendor" => $vendor) : array()
            );

            if( $area == 0 ) {
                $area = 'na';
            } else {
                $area = number_format( $area );
            }

            if( empty( $photos ) ) {
                $photo = RETSURL. 'assets/img/defprop.jpg';
            } else {
                $photo = trim($photos[0]);
                $photo = str_replace("\\", "", $photo);
            }
            
            
			
			
			$sold = ($status != 'Active')?'<div class="sold_sticker_small"></div>':'';
			if($wp_listing = get_page_by_title($property->address->full, OBJECT, 'listing')){
				$inner .= print_r($wp_listing, true);
			} else {
				$inner .= <<<HTML
				<div class="sr-listing-slider-item small_listing_container"> 
					<div class="four columns alpha omega listing_thumb">
						<a href="$link" title="$fullAddress">
							<img src="$photo" alt="$fullAddress" title="$fullAddress" class="scale-with-grid ">
						</a>
						<div class="four columns alpha omega listing_info">
							<div class="listing_remarks">
								<p>$priceUSD</p>
							</div><p>$subType | $beds Bed | $baths Bath | $area</p>
						</div>
						$sold
					</div>
					<h3><a href="$link" title="$fullAddress">$fullAddress ($lid)</a></h3>
					<sup class="supersmall">$office</sup>
				</div>
HTML;
			}
            
        }

        $content = <<<HTML

            <div id="simplyrets-listings-slider" class="sr-listing-carousel">
              $inner
            </div>
HTML;

        return $content;
    }


    /**
     * Listhub Analytics Tracking Code Snippet
     * We'll insert this in the markup if the admin option
     * sr_listhub_analytics is true.
     */
    public static function srListhubAnalytics() {
        $analytics = "(function(l,i,s,t,h,u,b){l['ListHubAnalyticsObject']=h;l[h]=l[h]||function(){ "
            . "(l[h].q=l[h].q||[]).push(arguments)},l[h].d=1*new Date();u=i.createElement(s),"
            . " b=i.getElementsByTagName(s)[0];u.async=1;u.src=t;b.parentNode.insertBefore(u,b) "
            . " })(window,document,'script','//tracking.listhub.net/la.min.js','lh'); ";
        return $analytics;
    }


    public static function srListhubSendDetails( $m, $t, $mlsid, $zip=NULL ) {
        $metrics_id = $m;
        $test       = $t;
        $mlsid      = $mlsid;
        $zipcode    = $zip;

        $lh_send_details = "lh('init', {provider: '$metrics_id', test: $test}); "
            . "lh('submit', 'DETAIL_PAGE_VIEWED', {mlsn: '$mlsid', zip: '$zipcode'});";

        return $lh_send_details;

    }
}
