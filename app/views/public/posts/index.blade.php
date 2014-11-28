@extends('public.layouts.default')

@section('content')
<div id="content-full">
    <div class="container-fluid cont-main">
        <div id="boxed-area" class="page-content">

            @section('slider')
                <div class="row">
               
                    <div class="topcover">
                        <div class="carousel slide mg1" id="cid_0">
                            <ol class="carousel-indicators">
                                <li data-target="#cid_0" data-slide-to="0" class="active"></li>
                                <li data-target="#cid_0" data-slide-to="1"></li>
                                <li data-target="#cid_0" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="item active">
                                    <img src="http://placehold.it/1170x450/21BAED/ffffff&amp;text=%20" alt="">
                                </div>
                                <div class="item">
                                    <img src="http://placehold.it/1170x450/C0DA2C/ffffff&amp;text=%20" alt="">
                                </div>
                                <div class="item">
                                    <img src="http://placehold.it/1170x450/F7632E/ffffff&amp;text=%20" alt="">
                                </div>
                            </div>
                            <a class="left carousel-control" href="#" data-slide="prev">
                                <span class="icon-prev"></span>
                            </a>
                            <a class="right carousel-control" href="#" data-slide="next">
                                <span class="icon-next"></span>
                            </a>
                        </div>
                    </div>
               
            </div>
            @stop
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="display center">
                        <h2><b>Categries</b></h2>
                    </div>
                </div>
            </div>

            
                <?php foreach ($posts as $post) { ?>
  <div class="row">
                <div class="col-sm-8">
                    <div class="row">
                        <div class="col-sm-4"
                        <a href="<?php echo $post->cover_image_url; ?>" data-gal="prettyPhoto[gallery1]">
                            <img class="img-responsive"  style="width: 300px; height: 200px"src="<?php echo $post->cover_image_url; ?>" alt="" class="mg3">
                        </a>  
                       </div>
                        <div class="col-sm-8">
                            <h4><?php echo $post->title; ?></h4>
                       <h6><?php echo str_limit($post->description, '300', '...')  ; ?></h6>
                        </div>
                    </div>
                </div>
         </div>
            <br><br>
                <?php } ?>
                
         
            
            <div id="sitefooter" class="row">
                <div class="col-lg-12">
                    <hr>
                    <p class="center"><small>© 2014 Your Name</small></p>
                    <p class="social-links center">
                        <a href="https://www.facebook.com/" target="_blank" data-toggle="tooltip" data-placement="top" title="" data-original-title="Facebook"><i class="fa fa-facebook"></i></a> &nbsp; 
                        <a href="https://twitter.com/" target="_blank" data-toggle="tooltip" data-placement="top" title="" data-original-title="Twitter"><i class="fa fa-twitter"></i></a> &nbsp; 
                        <a href="mailto:" target="_blank" data-toggle="tooltip" data-placement="top" title="" data-original-title="Email"><i class="fa fa-envelope-o"></i></a>
                    </p>
                </div>
            </div>

        </div>
    </div>
</div>
@stop