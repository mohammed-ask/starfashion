<?php
include './main/function.php';
include './main/conn.php';
$tablename = $_GET['hakuna'];
$content = $obj->selectfieldwhere($tablename, 'content', 'status =1');
ob_flush();
ob_start()
?>
<section class="blog-details spad" style="margin-top: 50px;">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <!-- <div class="col-lg-12">
                <div class="blog__details__pic">
                    <img src="img/blog/details/blog-details.jpg" alt="">
                </div>
            </div> -->
            <div class="col-lg-8">
                <div class="blog__details__content">
                    <div class="blog__details__share">
                        <span>share</span>
                        <ul>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#" class="twitter"><i style="color:white" class="fa fa-twitter"></i></a></li>
                            <li><a href="#" class="youtube"><i class="fa fa-youtube-play"></i></a></li>
                            <li><a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                    <div class="blog__details__text">
                        <?= $content ?>
                    </div>

                    <div class="blog__details__comment">
                        <h4>Leave A Comment</h4>
                        <form action="#">
                            <div class="row">
                                <div class="col-lg-4 col-md-4">
                                    <input type="text" placeholder="Name">
                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <input type="text" placeholder="Email">
                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <input type="text" placeholder="Phone">
                                </div>
                                <div class="col-lg-12 text-center">
                                    <textarea placeholder="Comment"></textarea>
                                    <button type="submit" class="site-btn">Post Comment</button>
                                </div>
                            </div>
                        </form>
                    </div>
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
$pagetitle = "Star Fashion Homepage";
$contentheader = "";
$pageheader = "";
include "main/templete.php";
?>