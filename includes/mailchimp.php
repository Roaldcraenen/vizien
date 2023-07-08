<?php

// Mailchimp

/**
 * CF7 leads to Mailchimp
 * Hook into CF7 send_mail, after validation
 */
add_action("wpcf7_before_send_mail", "get_lead_info");
function get_lead_info( $contact_form ) {

    $submission = WPCF7_Submission::get_instance();

    if ( $submission ) {
        $posted_data = $submission->get_posted_data();
        $title = $contact_form->title;
    }
  
    if ( 'Inzending RTL5' == $title ) { // Only for this form
        $data = [
            'email'         => $posted_data["email"],
            'status'        => 'subscribed',
            'name'          => $posted_data["naam"],
            'phone'         => $posted_data["tel"],
            'tag'           => 'RTL5campagne-mid2019'
        ];

        syncMailchimp($data);
    }

    if ( 'Veilinglijst' == $title ) { // Only for this form
        $data = [
            'email'         => $posted_data["email"],
            'status'        => 'subscribed',
            'name'          => $posted_data["naam"],
            'phone'         => $posted_data["tel"],
            'tag'           => 'Veilingen'
        ];

        syncMailchimp($data);
    }
}

// Send lead info to Mailchimp
function syncMailchimp($data) {
    $list_id = '2e0660bbc7';
    $authToken = '8c5618d88af182c4c71b2ebf9bccbf3e-us20';
    // $tag = 'RTL5campagne-mid2019';

    $email = $data['email'];
    $name = $data['name'];
    $phone = $data['phone'];
    $tag = $data['tag'];

    // Add contact
    $postData = array(
        "email_address" => "$email", 
        "status" => "subscribed", 
        "merge_fields" => array(
            "NAME"=> "$name",
            "PHONE"=> "$phone",
            "TAG"=> "$tag"
        )
    );

    $ch = curl_init('https://us20.api.mailchimp.com/3.0/lists/'.$list_id.'/members/');
    curl_setopt_array($ch, array(
        CURLOPT_POST => TRUE,
        CURLOPT_RETURNTRANSFER => TRUE,
        CURLOPT_HTTPHEADER => array(
            'Authorization: apikey '.$authToken,
            'Content-Type: application/json'
        ),
        CURLOPT_POSTFIELDS => json_encode($postData)
    ));

    $response = curl_exec($ch);

    // Set tags
    $postData = array(
        'tags' => array(
            array(
                'name' => $tag,
                'status' => 'active'
            )
        )
    );

    $hashed = md5($email);

    $ch = curl_init('https://us20.api.mailchimp.com/3.0/lists/'.$list_id.'/members/'.$hashed.'/tags');
    curl_setopt_array($ch, array(
        CURLOPT_POST => TRUE,
        CURLOPT_RETURNTRANSFER => TRUE,
        CURLOPT_HTTPHEADER => array(
            'Authorization: apikey '.$authToken,
            'Content-Type: application/json'
        ),
        CURLOPT_POSTFIELDS => json_encode($postData)
    ));

    $response = curl_exec($ch);
}
// END MailChimp

?>