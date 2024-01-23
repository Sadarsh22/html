<form name="applicationForm" id="applicationForm" method="post" enctype="multipart/form-data" action="">
        <table border="2" bordercolor="orange" align="center">
            <th colspan="2">Application Form</th>
            <tr>
                <td align="middle">First_Name</td>
                <td>
                    <input type="text" name="First_Name" id="First_Name" value="<?php echo $fname; if($mode == 'edit'):?><?php echo $first_name ?><?php endif; ?>" />
                    <br />
                    <span id="SFirst_Name"></span>
                </td>
            </tr>
            <tr>
                <td align="middle">Last_Name</td>
                <td>
                    <input type="text" name="Last_Name" id="Last_Name" value="<?php echo $lname; if($mode == 'edit'):?><?php echo $last_name ?><?php endif; ?>" />
                    <br />
                    <span id="SLast_Name"></span>
                </td>
            </tr>
            <tr>
                <td align="middle" valign="top">Address</td>
                <td>
                    <textarea name="address" id="address"><?php echo $addr; if($mode == 'edit'):?><?php echo trim($address_value) ?><?php endif; ?></textarea>
                    <br />
                    <span id="SAddress"></span>
                </td>
            </tr>
            <tr>
                <td align="middle">Email</td>
                <td>
                    <input type="email" name="email" id="email" value="<?php if($mode == 'edit'):?><?php echo $email_id ?><?php endif; ?>" />
                    <br />
                    <span id="SEmail"><?php print $msg; ?></span>
                </td>
            </tr>
            <tr>
                <td align="middle">Phone</td>
                <td>
                    <input type="text" name="Phone" id="Phone" value="<?php echo $phn; if($mode == 'edit'):?><?php echo $phn_id ?><?php endif; ?>" />
                    <br />
                    <span id="SPhone"></span>
                </td>
            </tr>
            <tr>
                <td align="middle">Gender</td>
                <td>
                    <input type="radio" name="Gender" class="Gender" value="Male" <?php 
                    if($mode == 'edit' || $gndr == 'Male')
                    {
                        if($gndr_id == 'Male' || $gndr == 'Male'):?> checked <?php endif;
                    }
                    ?>  />Male
                    <input type="radio" name="Gender" class="Gender"  value="Female" <?php 
                    if($mode == 'edit' || $gndr == 'Female')
                    {
                        if($gndr_id == 'Female' || $gndr == 'Female'):?> checked <?php endif;
                    } 
                    ?>/>Female
                    <br />
                    <span id="SGender"></span>
                </td>
            </tr>
            <tr>
                <td align="middle">Date of Birth</td>
                <td>
                    <input type="date" id="dob" name="dob" value="<?php echo $dob_id; echo $dob; ?>"/>
                    <br />
                    <span id="SDob"></span>
                </td>
            </tr>
            <tr>
                <td align="middle">Language</td>
                <td>
                    <input type="checkbox" name="Language[]" class="Language" value="English" <?php 
                    if($lng)
                    if(in_array("English",$lng)):?> checked <?php endif;
                    if($mode == 'edit')
                    {
                        foreach($lang_id as $v)
                        if($v == 'English'):?> checked <?php endif; 
                    }
                    ?>/>English
                    <input type="checkbox" name="Language[]" class="Language" value="Hindi" <?php 
                    if($lng)
                    if(in_array("Hindi",$lng)):?> checked <?php endif;
                     if($mode == 'edit')
                    {
                        foreach($lang_id as $v)
                        if($v == 'Hindi'):?> checked <?php endif; 
                    }
                    ?>/>Hindi
                    <input type="checkbox" name="Language[]" class="Language" value="Bengali" <?php 
                    if($lng)
                    if(in_array("Bengali",$lng)):?> checked <?php endif;
                    if($mode == 'edit')
                    {
                        foreach($lang_id as $v)
                        if($v == 'Bengali' || in_array("Bengali",$lng)):?> checked <?php endif;
                    } 
                    ?>/>Bengali
                    <br />
                    <span id="SLanguage"></span>
                </td>
            </tr>
            <tr>
                <td align="middle">Country</td>
                <td>
                    <select name="Country" id='Country'>
                        <?php 
                            if($mode != 'edit')
                            echo("<option  >--Select--</option>");
                            else
                            echo "<option checked='checked' value=$country_id>$country_id</option>";
                        
                            $country_list = array("japan", "india", "nepal", "china", "usa", "canada", "Russia");

                            foreach ($country_list as $item) {
                                if($item == $cnt)
                                echo "<option checked value=$item>$item</option>";
                                else
                                echo "<option checked value=$item>$item</option>";
                            }
                        ?>
                    </select>
                    <br />
                    <span id="SCountry"></span>
                </td>
            </tr>