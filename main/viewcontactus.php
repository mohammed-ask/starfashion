<?php
include './main/function.php';
include './main/conn.php';
$rowpersonal = $obj->selectextrawhere("personal_detail", "status = 11")->fetch_assoc();
ob_flush();
ob_start()
?>
<!-- Map Begin -->
<div class="map">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3683.098830077737!2d75.85772741427824!3d22.71956898511636!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39631ad497d454d1%3A0x9e8a7ceca17564c3!2sIndore%2C%20Madhya%20Pradesh!5e0!3m2!1sen!2sin!4v1597926938024!5m2!1sen!2sin" height="500" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
</div>
<!-- Map End -->

<!-- Contact Section Begin -->
<section class="contact spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="contact__text">
                    <div class="section-title">
                        <span>Information</span>
                        <h2>Contact Us</h2>
                        <p>Your concern is our concern do not hesitate to ask anything, we pay
                            strict attention.</p>
                    </div>
                    <ul>
                        <li>
                            <h4>India</h4>
                            <p><?= $rowpersonal['address_1'] . ' ' . $rowpersonal['address_2'] . ' ' . $rowpersonal['city'] . ' ' . $rowpersonal['pincode'] ?> <br />+<?= $rowpersonal['phone'] ?></p>
                        </li>
                        <!-- <li>
                            <h4>France</h4>
                            <p>109 Avenue Léon, 63 Clermont-Ferrand <br />+12 345-423-9893</p>
                        </li> -->
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="contact__form">
                    <form id="contact" method="post" onsubmit="event.preventDefault();sendForm('', '', 'insertmessage', 'resultid', 'contact');return 0;">
                        <div class="row">
                            <div class="col-lg-6">
                                <input type="text" name="name" placeholder="Name" required>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" name="email" placeholder="Email" required>
                            </div>
                            <div class="col-lg-12">
                                <textarea placeholder="Message" name="message"></textarea>
                                <button type="submit" class="site-btn">Send Message</button>
                            </div>
                            <div id="resultid"></div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
//Assign all Page Specific variables
$pagemaincontent = ob_get_contents();
ob_end_clean();
$pagemeta = "";
$pagetitle = "Star Fashion Contact Us";
$contentheader = "";
$pageheader = "";
include "main/templete.php";
?>